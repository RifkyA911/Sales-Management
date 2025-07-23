<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Djual;
use App\Models\Jual;
use App\Http\Requests\DjualRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class DjualController extends Controller
{
    public function index(Request $request, $no_faktur): View|JsonResponse
    {
        // Ambil semua detail dengan No_Faktur tertentu, pastikan relasi barang ikut di-load
        $details = Djual::with('barang')->where('No_Faktur', $no_faktur)->get();

        if ($request->ajax() || request()->wantsJson()) {
            return response()->json(['data' => $details]);
        }

        // Ambil header jual untuk tampilan
        $jual = Jual::findOrFail($no_faktur);

        return view('djuals.index', compact('jual', 'details'));
    }

    public function getAvailableBarangs($no_faktur)
    {
        $usedBarangs = Djual::where('No_Faktur', $no_faktur)
            ->pluck('Kode_Barang')
            ->toArray();

        $availableBarangs = Barang::whereNotIn('Kode_Barang', $usedBarangs)->get();

        return response()->json($availableBarangs);
    }



    public function store(DjualRequest $request): JsonResponse
    {
        $data = $request->validated();

        $djual = Djual::create($data);

        $jual = $djual->jual;
        $jual->recalculateTotals();

        $availableBarangs = Barang::whereNotIn('Kode_Barang', function ($query) use ($jual) {
            $query->select('Kode_Barang')
                ->from('T_DJual')
                ->where('No_Faktur', $jual->No_Faktur);
        })->get(['Kode_Barang', 'Nama_Barang']);

        $djual->jual->recalculateTotals();
        return response()->json([
            'success' => true,
            'message' => 'Detail penjualan berhasil ditambahkan',
            'data' => [
                'Total_Bruto' => 'Rp ' . number_format($djual->jual->Total_Bruto, 2, ',', '.'),
                'Total_Diskon' => $djual->jual->Total_Diskon,
                'Total_Jumlah' => 'Rp ' . number_format($djual->jual->Total_Jumlah, 2, ',', '.'),
                'availableBarangs' => $availableBarangs,
            ]
        ]);
    }

    public function edit($no_faktur, $kodeBarang): View|JsonResponse
    {
        $djual = Djual::where('No_Faktur', $no_faktur)
            ->where('Kode_Barang', $kodeBarang)
            ->firstOrFail();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['data' => $djual]);
        }

        return view('djuals.edit', compact('djual'));
    }

    public function update(DjualRequest $request, $no_faktur, $kodeBarang): JsonResponse
    {
        $djual = Djual::where('No_Faktur', $no_faktur)
            ->where('Kode_Barang', $kodeBarang)
            ->firstOrFail();

        $djual->update($request->validated()); // eloquent
        $djual->jual->recalculateTotals();

        $availableBarangs = Barang::whereNotIn('Kode_Barang', function ($query) use ($no_faktur) {
            $query->select('Kode_Barang')
                ->from('T_DJual')
                ->where('No_Faktur', $no_faktur);
        })->get(['Kode_Barang', 'Nama_Barang']);

        return response()->json([
            'success' => true,
            'message' => 'Detail penjualan berhasil diperbarui',
            'data' => [
                'Total_Bruto' => 'Rp ' . number_format($djual->jual->Total_Bruto, 2, ',', '.'),
                'Total_Diskon' => $djual->jual->Total_Diskon,
                'Total_Jumlah' => 'Rp ' . number_format($djual->jual->Total_Jumlah, 2, ',', '.'),
                'availableBarangs' => $availableBarangs,
            ]
        ]);
    }

    public function destroy($no_faktur, $kodeBarang): JsonResponse
    {
        Djual::where('No_Faktur', $no_faktur)
            ->where('Kode_Barang', $kodeBarang)
            ->delete();

        $jual = Jual::where('No_Faktur', $no_faktur)->first();
        $jual->recalculateTotals();

        $availableBarangs = Barang::whereNotIn('Kode_Barang', function ($query) use ($no_faktur) {
            $query->select('Kode_Barang')
                ->from('T_DJual')
                ->where('No_Faktur', $no_faktur);
        })->get(['Kode_Barang', 'Nama_Barang']);

        return response()->json([
            'success' => true,
            'message' => 'Detail penjualan berhasil dihapus',
            'data' => [
                'Total_Bruto' => 'Rp ' . number_format($jual->Total_Bruto, 2, ',', '.'),
                'Total_Diskon' => $jual->Total_Diskon,
                'Total_Jumlah' => 'Rp ' . number_format($jual->Total_Jumlah, 2, ',', '.'),
                'availableBarangs' => $availableBarangs,
            ]
        ]);
    }

    public function exportCsv($no_faktur): StreamedResponse
    {
        $filename = "djuals_{$no_faktur}.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($no_faktur) {
            $handle = fopen('php://output', 'w');

            // Header kolom
            fputcsv($handle, ['Kode Barang', 'Nama Barang', 'Harga', 'Qty', 'Diskon', 'Bruto', 'Jumlah']);

            // Ambil data
            $details = \App\Models\Djual::with('barang')
                ->where('No_Faktur', $no_faktur)
                ->get();

            foreach ($details as $detail) {
                fputcsv($handle, [
                    $detail->Kode_Barang,
                    $detail->barang->Nama_Barang ?? '-',
                    $detail->Harga,
                    $detail->Qty,
                    $detail->Diskon,
                    $detail->Bruto,
                    $detail->Jumlah,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
