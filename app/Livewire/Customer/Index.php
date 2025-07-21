<?php

namespace App\Livewire\Customer;

use App\Models\Customer; // Pastikan ini mengarah ke model Customer Anda
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // Properti untuk pencarian
    public string $search = '';

    // Properti untuk pesan sukses setelah aksi
    public string $message = '';

    // Untuk memastikan pagination reset saat search berubah
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    // Method untuk menampilkan daftar customer
    public function render(): \Illuminate\View\View
    {
        $customers = Customer::where('Nama_Customer', 'like', '%' . $this->search . '%')
            ->orWhere('Kode_Customer', 'like', '%' . $this->search . '%')
            ->paginate(10); // Menampilkan 10 data per halaman

        return view('livewire.customer.index', [
            'customers' => $customers,
        ]);
    }

    // Method untuk menghapus customer
    public function delete(Customer $customer): void
    {
        $customer->delete();
        $this->message = 'Customer ' . $customer->Nama_Customer . ' berhasil dihapus!';
    }
}
