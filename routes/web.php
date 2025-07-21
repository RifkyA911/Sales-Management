<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Customer\Index as CustomerIndex; // Alias untuk Index
use App\Livewire\Customer\Create as CustomerCreate; // Alias untuk Create
use App\Livewire\Customer\Edit as CustomerEdit; // Alias untuk Edit
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', function (Request $request) {
    $token = $request->session()->token();

    $token = csrf_token();

    dd($token);
});

Route::resource('customers', CustomerController::class)->parameters([
    'customers' => 'kode_customer'
]);

Route::resource('barangs', BarangController::class)->parameters([
    'barangs' => 'kode_barang'
]);



// ============================================ Livewire ============================================
Route::get('/counter', Counter::class);
// Route::prefix('customers')->name('customers.')->group(function () {
//     Route::get('/', CustomerIndex::class)->name('index');
//     Route::get('/create', CustomerCreate::class)->name('create');
//     Route::get('/{customer}/edit', CustomerEdit::class)->name('edit'); // Gunakan {customer} untuk route model binding
//     // Route show tidak diperlukan karena biasanya detail ditampilkan di halaman edit atau index
// });

