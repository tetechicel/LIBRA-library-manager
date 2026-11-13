<?php

use App\Livewire\Books\BookIndex;
use Illuminate\Support\Facades\Route;

Route::livewire('/', 'dashboard')
    ->name('home');

Route::livewire('/dashboard', 'dashboard')
    ->name('dashboard');

Route::get('/books', BookIndex::class)->name('books');
Route::redirect('/addBooks', '/books')->name('add-books');

Route::view('/profile', 'pages.placeholder', ['title' => 'Profile'])
    ->name('profile');

Route::view('/members', 'pages.placeholder', ['title' => 'Members'])
    ->name('members');

Route::view('/borrowing', 'pages.placeholder', ['title' => 'Borrowing'])
    ->name('borrowing');

Route::view('/returns', 'pages.placeholder', ['title' => 'Returns'])    
    ->name('returns');

Route::view('/reports', 'pages.placeholder', ['title' => 'Reports'])
    ->name('reports');

Route::view('/settings', 'pages.placeholder', ['title' => 'Settings'])
    ->name('settings');