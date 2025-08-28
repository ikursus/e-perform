<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\InternetConnectionController;
use App\Http\Controllers\CyberAttackController;
use App\Http\Controllers\DigitalizationController;
use App\Http\Controllers\UserHoldingController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Route::method('alamat', function(){});
Route::get('/', [PageController::class, 'homepage'])->name('home');
Route::get('/contact', [PageController::class, 'contactPage'])->name('contact');


// Route::method('alamat', function(){});
// Route get login ini digunakan untuk paparkan borang login
Route::get('/login', [LoginController::class, 'paparBorangLogin'])->name('login');
// Route post login ini digunakan untuk mengambil data login dan proseskan authentication
Route::post('/login', [LoginController::class, 'prosesDataLogin'])->name('login.proses');


// Buatkan routing untuk halaman login // password reset
Route::middleware('auth')->group(function() {

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

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

    // User Management routes
    Route::resource('users', UserController::class);

    // Service Module routes
    Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
    
    // Internet Connections routes
    Route::resource('internet-connections', InternetConnectionController::class);
    
    // Cyber Attacks routes
    Route::resource('cyber-attacks', CyberAttackController::class);
    
    // Digitalizations routes
    Route::resource('digitalizations', DigitalizationController::class);

    // Investor Holdings routes
    Route::resource('investor-holdings', UserHoldingController::class);
    Route::get('/investor-holdings/import', [UserHoldingController::class, 'showImportForm'])->name('investor-holdings.import');
    Route::post('/investor-holdings/import', [UserHoldingController::class, 'import'])->name('investor-holdings.import.process');
    Route::get('/investor-holdings/download-template', [UserHoldingController::class, 'downloadTemplate'])->name('investor-holdings.download-template');

    // Test route for template-induk2
    Route::get('/template-test', function() {
        return view('template-test');
    })->name('template.test');

    // Authentication routes
    Route::post('/logout', LogoutController::class)->name('logout');

});