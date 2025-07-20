<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;

Route::get('/', function () {
    return view('welcome');
});
// Route::livewire('/', 'post.index')->name('post.index');

Route::get('/counter', Counter::class);
