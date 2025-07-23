<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View; // Import untuk tipe kembalian View
use Illuminate\Http\RedirectResponse; // Import untuk tipe kembalian RedirectResponse

class CustomerController extends Controller // Ubah nama kelas jika Anda mengubah nama file
{
    /**
     * Display a listing of the resource.
     * Mengambil daftar customer dan selalu mengembalikan View.
     */
    public function index(): View|JsonResponse
    {
        $customers = Customer::all()->sortBy('Nama_Customer')->values();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['data' => $customers]);
        }

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('juals.index'), 'active' => false, 'icon' => 'fa-home'],
            ['label' => 'Daftar Customer', 'url' => route('customers.index'), 'active' => true, 'icon' => 'fa-users']
        ];
        return view('customers.index', compact('customers', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request): RedirectResponse
    {
        abort_if(
            Customer::where('Kode_Customer', $request->input('Kode_Customer'))->exists(),
            400,
            'Kode Customer sudah ada.'
        );

        try {
            Customer::create($request->validated());

            return redirect()
                ->route('customers.index')
                ->with('success', 'Customer berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()
                ->route('customers.create')
                ->with('error', 'Terjadi kesalahan saat menambahkan customer: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $kode_customer): View
    {
        $customer = Customer::find($kode_customer)->first();

        if (!$customer) {
            abort(404, 'Customer tidak ditemukan'); // Langsung abort 404 jika tidak ditemukan
        }

        return view('customers.show', compact('customer')); // Asumsi Anda akan membuat view show.blade.php
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kode_customer): View
    {
        $customer = Customer::findOrFail($kode_customer);

        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('juals.index'), 'active' => false, 'icon' => 'fa-home'],
            ['label' => 'Edit Customer', 'url' => route('customers.index'), 'active' => true, 'icon' => 'fa-users']
        ];
        return view('customers.edit', compact('customer', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $kode_customer): RedirectResponse
    {
        $customer = Customer::find($kode_customer);

        if (!$customer) {
            abort(404, 'Customer tidak ditemukan');
        }

        $customer->update($request->validated());
        return redirect()->route('customers.index')->with('success', 'Customer berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_customer): RedirectResponse
    {
        $customer = Customer::find($kode_customer);

        if (!$customer) {
            abort(404, 'Customer tidak ditemukan');
        }

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer berhasil dihapus!');
    }
}
