<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Authentication\LoginController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::method('alamat', function(){});
Route::get('/', [PageController::class, 'homepage'])->name('home');
Route::get('/contact', [PageController::class, 'contactPage'])->name('contact');

// Buatkan routing untuk halaman login // password reset
Route::get('/dashboard', DashboardController::class);

Route::get('/profile', function() {
    return view('template-profile');
});

// IT Performance routes
Route::get('/it', function() {
    return view('it.template-index');
})->name('it.index');

Route::get('/it/create', function() {
    return view('it.template-create');
})->name('it.create');

Route::post('/it', function() {
    // Handle store logic here
    return redirect('/it')->with('success', 'Server berhasil ditambahkan!');
})->name('it.store');

Route::get('/it/{id}/edit', function($id) {
    // You can pass the server data here
    return view('it.template-edit', compact('id'));
})->name('it.edit');

Route::put('/it/{id}', function($id) {
    // Handle update logic here
    return redirect('/it')->with('success', 'Server berhasil diperbarui!');
})->name('it.update');

Route::delete('/it/{id}', function($id) {
    // Handle delete logic here
    return redirect('/it')->with('success', 'Server berhasil dihapus!');
})->name('it.destroy');

// Import Data routes
Route::get('/import/data-investor', function() {
    return view('import.data-investor');
})->name('import.data-investor');

Route::post('/import/data-investor', function() {
    // Handle import logic here
    return redirect('/import/data-investor')->with('success', 'Data investor berhasil diimport!');
})->name('import.data-investor.store');


// Route::method('alamat', function(){});
// Route get login ini digunakan untuk paparkan borang login
Route::get('/login', [LoginController::class, 'paparBorangLogin'])->name('login');
// Route post login ini digunakan untuk mengambil data login dan proseskan authentication
Route::post('/login', [LoginController::class, 'prosesDataLogin'])->name('login.proses');




// Authentication routes
Route::post('/logout', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');