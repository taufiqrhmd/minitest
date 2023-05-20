<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Author;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('author/dashboard');
})->name('dashboard');

Route::get('/daftarartikel', function () {
    return view('author/daftarArtikel');
})->name('daftarArtikel');

Route::get('/tulisartikel', function () {
    return view('author/tulisArtikel');
})->name('tulisArtikel');




Route::get('/admin', function () {
    return view('admin/home');
})->name('home');





