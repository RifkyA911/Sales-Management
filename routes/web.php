<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DjualController;
use App\Http\Controllers\JenController;
use App\Http\Controllers\JualController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Customer\Index as CustomerIndex; // Alias untuk Index
use App\Livewire\Customer\Create as CustomerCreate; // Alias untuk Create
use App\Livewire\Customer\Edit as CustomerEdit; // Alias untuk Edit
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('juals.index');
});

Route::resource('customers', CustomerController::class)->parameters([
    'customers' => 'kode_customer'
]);

Route::resource('jens', JenController::class)->parameters([
    'jens' => 'kode_tjen'
]);

Route::resource('barangs', BarangController::class)->parameters([
    'barangs' => 'kode_barang'
]);

Route::resource('juals', JualController::class)->parameters([
    'juals' => 'no_faktur'
]);
Route::get('/juals/{no_faktur}/print', [JualController::class, 'print'])->name('juals.print');
Route::get('/juals/export/csv', [JualController::class, 'exportCsv'])
    ->name('juals.export.csv');

Route::get('djuals/', [DjualController::class, 'index'])->name('djuals.index');
Route::get('djuals/{no_faktur}/available-barangs', [DjualController::class, 'getAvailableBarangs'])
    ->name('djuals.available-barangs');
Route::get('djuals/{no_faktur}', [DjualController::class, 'index'])->name('djuals.index');
Route::get('djuals/{no_faktur}/{kodeBarang}/edit', [DjualController::class, 'edit'])->name('djuals.edit');
Route::get('djuals/{no_faktur}/export/csv', [DjualController::class, 'exportCsv'])
    ->name('djuals.export.csv');

Route::post('djuals', [DjualController::class, 'store'])->name('djuals.store');

Route::put('djuals/{no_faktur}/{kodeBarang}', [DjualController::class, 'update'])->name('djuals.update');

Route::delete('djuals/{no_faktur}/{kodeBarang}', [DjualController::class, 'destroy'])->name('djuals.destroy');


// ============================================ Livewire ============================================
Route::get('/token', function (Request $request) {
    $token = $request->session()->token();

    $token = csrf_token();

    dd($token);
});


Route::get('/counter', Counter::class);
// Route::prefix('customers')->name('customers.')->group(function () {
//     Route::get('/', CustomerIndex::class)->name('index');
//     Route::get('/create', CustomerCreate::class)->name('create');
//     Route::get('/{customer}/edit', CustomerEdit::class)->name('edit'); // Gunakan {customer} untuk route model binding
//     // Route show tidak diperlukan karena biasanya detail ditampilkan di halaman edit atau index
// });

