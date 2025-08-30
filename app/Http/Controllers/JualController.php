<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;

use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\Jual;
use App\Http\Requests\JualRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class JualController extends Controller
{
    public function index(): View|JsonResponse
    {
        $juals = Jual::with(['customer', 'jen', 'details'])->get();

        if (request()->ajax()) {
            return response()->json(['data' => $juals]);
        }

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('juals.index'), 'active' => true, 'icon' => 'fa-home']
        ];
        return view('juals.index', compact('juals', 'breadcrumbs'));
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('juals.index'), 'active' => false, 'icon' => 'fa-home'],
            ['label' => 'Tambah Jual', 'url' => route('juals.create'), 'active' => true, 'icon' => 'fa-plus']
        ];
        return view('juals.create', compact('breadcrumbs'));
    }

    public function store(JualRequest $request): RedirectResponse
    {
        Jual::create($request->validated());
        return redirect()->route('juals.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show($no_faktur): View|JsonResponse
    {
        $jual = Jual::with(['customer', 'jen', 'details'])->findOrFail($no_faktur);

        if (!$jual) {
            abort(404, 'Penjualan tidak ditemukan');
        }

        if (request()->ajax()) {
            return response()->json(['data' => $jual]);
        }

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('juals.index'), 'active' => false, 'icon' => 'fa-home'],
            ['label' => 'Detail Jual', 'url' => route('juals.show', $no_faktur), 'active' => true, 'icon' => 'fa-eye']
        ];

        return view('juals.show', compact('jual', 'breadcrumbs'));
    }

    public function edit($no_faktur): View
    {
        $jual = Jual::findOrFail($no_faktur);
        // dd($jual);
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('juals.index'), 'active' => false, 'icon' => 'fa-home'],
            ['label' => 'Edit Jual', 'url' => route('juals.edit', $no_faktur), 'active' => true, 'icon' => 'fa-pen']
        ];
        // $jual->Total_Bruto = 'Rp ' . number_format($jual->Total_Bruto, 2, ',', '.');
        // $jual->Total_Diskon = 'Rp ' . number_format($jual->Total_Diskon, 2, ',', '.');
        // $jual->Total_Jumlah = 'Rp ' . number_format($jual->Total_Jumlah, 2, ',', '.');
        return view('juals.edit', compact('jual', 'breadcrumbs'));
    }

    public function update(JualRequest $request, $id): RedirectResponse|JsonResponse
    {
        $jual = Jual::findOrFail($id);
        $jual->update($request->validated());

        if ($request->ajax()) {
            return response()->json($jual);
        }
        return redirect()->route('juals.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id): RedirectResponse|JsonResponse
    {
        $jual = Jual::findOrFail($id);

        if ($jual->details()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak bisa menghapus, masih ada detail penjualan untuk No Faktur ini.'
            ], 400);
        }


        $jual->delete();

        return redirect()->route('juals.index')->with('success', 'Data berhasil dihapus.');
    }

    public function print($no_faktur)
    {
        $jual = \App\Models\Jual::with('details.barang')->findOrFail($no_faktur);

        $pdf = Pdf::loadView('juals.partials.print', compact('jual'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('invoice-' . $no_faktur . '.pdf');
    }

    public function exportCsv()
    {
        $fileName = 'juals-' . date('Y-m-d') . '.csv';

        $juals = \App\Models\Jual::with('customer')->get();

        $response = new StreamedResponse(function () use ($juals) {
            $handle = fopen('php://output', 'w');

            // Header CSV
            fputcsv($handle, ['No Faktur', 'Tanggal', 'Customer', 'Total Jumlah', 'Total Diskon', 'Total Bruto']);

            // Data
            foreach ($juals as $jual) {
                fputcsv($handle, [
                    $jual->No_Faktur,
                    $jual->Tgl_Faktur,
                    $jual->customer->Nama_Customer ?? '-',
                    $jual->Total_Jumlah,
                    $jual->Total_Diskon,
                    $jual->Total_Bruto,
                ]);
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        return $response;
    }
}
