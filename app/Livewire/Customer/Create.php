<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\Validate; // Untuk Livewire 3 validation attributes

class Create extends Component
{
    #[Validate('required|string|size:4|unique:T_Customer,Kode_Customer')]
    public string $kode_customer = '';

    #[Validate('required|string|max:40')]
    public string $nama_customer = '';

    public function render(): \Illuminate\View\View
    {
        return view('livewire.customer.create');
    }

    public function save(): void
    {
        $this->validate(); // Jalankan validasi

        Customer::create([
            'Kode_Customer' => $this->kode_customer,
            'Nama_Customer' => $this->nama_customer,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        session()->flash('message', 'Customer berhasil ditambahkan!');
        $this->redirectRoute('customers.index', navigate: true); // navigate: true untuk SPA-like navigation
    }
}
