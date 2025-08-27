<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::method('alamat', function(){});
Route::get('/', function() {
    return view('welcome');
});

// slug = e.g: internet-connection
// Route parameter required
// Route::get('/category/{slug}', function($slug) {

//     // Database query
//     // DB::table('category')->where('slug', $slug)->get();
//     return 'Ini adalah category: ' . $slug;
    
// });

// Route parameter optional
Route::get('/category/{aaaaa?}', function($aaaaa = null) {

    // Database query
    // DB::table('category')->where('slug', $slug)->get();

    if (is_null($aaaaa)) {
        return 'Ini adalah halaman utama category';
    }

    return 'Ini adalah category jenis: ' . $aaaaa;
    
});

// Buatkan routing untuk halaman login // password reset
Route::get('/dashboard', function() {

    $pageTitle = '<script>alert("User List Dashboard");</script>';

    $senaraiUsers = [
        ['id' => 1, 'name' => 'John Doe', 'email' => 'john.doe@example.com', 'role' => 'Staff'],
        ['id' => 2, 'name' => 'Jane Doe', 'email' => 'jane.doe@example.com', 'role' => 'Admin'],
        ['id' => 3, 'name' => 'Bob Smith', 'email' => 'bob.smith@example.com', 'role' => 'Staff'],
    ];

    // Cara 1 attach data kepada template menggunakan kaedah with()
    // return view('template-dashboard')->with('senaraiUsers', $senaraiUsers)->with('pageTitle', $pageTitle);

    // Cara 2 attach data kepada template menggunakan kaedah array()
    // return view('template-dashboard', ['senaraiUsers' => $senaraiUsers, 'pageTitle' => $pageTitle]);

    // Cara 3 attach data kepada template menggunakan kaedah compact()
    return view('template-dashboard', compact('senaraiUsers', 'pageTitle'));

});

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

// Authentication routes
Route::post('/logout', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');