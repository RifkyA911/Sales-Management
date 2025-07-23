<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BarangController extends Controller
{
    public function index(): View|JsonResponse
    {
        $barangs = Barang::all();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['data' => $barangs]);
        }
        return view('barangs.index', compact('barangs'));
    }

    public function create(): View
    {
        return view('barangs.create');
    }

    public function store(BarangRequest $request): RedirectResponse
    {
        abort_if(
            Barang::where('Kode_Barang', $request->input('Kode_Barang'))->exists(),
            400,
            'Kode Barang sudah ada.'
        );

        try {
            Barang::create($request->validated());
            return redirect()
                ->route('barangs.index')
                ->with('success', 'Barang berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()
                ->route('barangs.create')
                ->with('error', 'Terjadi kesalahan saat menambahkan Barang: ' . $e->getMessage());
        }

    }

    public function show(string $kode_barang): View|JsonResponse
    {
        $barang = Barang::where('Kode_Barang', $kode_barang)->firstOrFail();

        if (!$barang) {
            abort(404, 'Barang tidak ditemukan');
        }

        if (request()->ajax()) {
            return response()->json(['data' => $barang]);
        }

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('barangs.index'), 'active' => false, 'icon' => 'fa-home'],
            ['label' => 'Detail Barang', 'url' => route('barangs.show', $kode_barang), 'active' => true, 'icon' => 'fa-eye']
        ];

        return view('barangs.show', compact('barang', 'breadcrumbs'));
    }

    public function edit(string $kode_barang): View
    {
        return view('barangs.edit', [
            'barang' => Barang::where('Kode_Barang', $kode_barang)->firstOrFail()
        ]);
    }

    public function update(BarangRequest $request, string $kode_barang): RedirectResponse|JsonResponse
    {
        // dd($request->all(), $kode_barang);
        if (!$kode_barang) {
            return back()->with('error', 'Kode Barang kosong, tidak bisa update.');
        }

        $barang = Barang::find($kode_barang);

        if (!$barang) {
            abort(404, 'Barang tidak ditemukan');
        }

        $barang->update($request->validated());

        if ($request->ajax()) {
            return response()->json($barang);
        }

        return redirect()->route('barangs.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy(string $kode_barang): RedirectResponse
    {
        $barang = Barang::find($kode_barang);

        if (!$barang) {
            abort(404, 'Barang tidak ditemukan');
        }

        $barang->delete();
        return redirect()->route('barangs.index')->with('success', 'Barang berhasil hapus!');
    }
}
