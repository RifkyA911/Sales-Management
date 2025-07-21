<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public Customer $customer; // Properti untuk model Customer yang akan di-edit

    // Atribut untuk validasi. Unique rule perlu diabaikan untuk instance saat ini.
    // Pastikan nama kolom di tabel benar (Kode_Customer)
    #[Validate('required|string|size:4')] // Kode_Customer tidak diubah
    public string $kode_customer;

    #[Validate('required|string|max:40')]
    public string $nama_customer;

    // Method mount() akan dipanggil saat komponen diinisialisasi
    public function mount(Customer $customer): void
    {
        $this->customer = $customer;
        $this->kode_customer = $customer->Kode_Customer;
        $this->nama_customer = $customer->Nama_Customer;
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.customer.edit');
    }

    public function update(): void
    {
        // Validasi input
        // Untuk unique rule pada update, kita perlu mengabaikan Kode_Customer dari instance saat ini
        $this->validate([
            'nama_customer' => 'required|string|max:40',
        ]);

        $this->customer->update([
            'Nama_Customer' => $this->nama_customer,
        ]);

        session()->flash('message', 'Customer berhasil diperbarui!');
        $this->redirectRoute('customers.index', navigate: true);
    }
}
