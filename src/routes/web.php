<?php

use App\Http\Controllers\Appercamel;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [Appercamel::class, 'index']);
Route::post('/contacts/confirm', [Appercamel::class, 'confirm']);
Route::post('/contacts/edit', [Appercamel::class, 'edit']);
Route::post('/contacts', [Appercamel::class, 'store']);

Route::get('/admin', [Appercamel::class, 'admin'])->middleware('auth')->name('admin');
Route::get('/admin/export', [Appercamel::class, 'export'])->middleware('auth')->name('admin.export');
Route::redirect('/home', '/admin');
