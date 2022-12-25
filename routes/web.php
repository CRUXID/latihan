<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['web', 'cekuser:1']], 
function () {
    Route::get('kategori/data', [KategoriController::class, 'listData'])->name('kategori.data');
    Route::resource('kategori', KategoriController::class);
    Route::get('produk/data', [ProdukController::class, 'listData'])->name('produk.data');
    Route::post('produk/hapus', [ProdukController::class, 'deleteSelected']);
    Route::resource('produk', ProdukController::class);
});

Route::get('produk/data', [ProdukController::class, 'listData'])->name('produk.data');
Route::post('produk/hapus', [ProdukController::class, 'deleteSelected']);
Route::resource('produk', ProdukController::class);
