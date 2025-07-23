<?php

namespace App\Http\Controllers;

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

    public function store(DjualRequest $request): JsonResponse
    {
        $data = $request->validated();

        $djual = Djual::create($data);

        // Update total di header jual
        $djual->jual->recalculateTotals();

        return response()->json(['success' => true, 'message' => 'Detail penjualan berhasil ditambahkan']);
    }

    public function update(DjualRequest $request, $no_faktur, $kodeBarang): JsonResponse
    {
        $djual = Djual::where('No_Faktur', $no_faktur)
            ->where('Kode_Barang', $kodeBarang)
            ->firstOrFail();

        $djual->update($request->validated());
        $djual->jual->recalculateTotals();

        return response()->json(['success' => true, 'message' => 'Detail penjualan berhasil diperbarui']);
    }

    public function destroy($no_faktur, $kodeBarang): JsonResponse
    {
        $djual = Djual::where('No_Faktur', $no_faktur)
            ->where('Kode_Barang', $kodeBarang)
            ->firstOrFail();

        $jual = $djual->jual;
        $djual->delete();
        $jual->recalculateTotals();

        return response()->json(['success' => true, 'message' => 'Detail penjualan berhasil dihapus']);
    }
}
