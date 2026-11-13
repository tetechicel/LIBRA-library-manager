<?php

use App\Livewire\Books\BookIndex;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'dashboard')
    ->name('dashboard');



Route::get('/buku', BookIndex::class)->name('books.index');