<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/thankyou', [App\Http\Controllers\HomeController::class, 'thankyou'])->name('thankyou');

//Contacts

Route::get('/add_contact', [App\Http\Controllers\HomeController::class, 'contact_form'])->name('add_contact');
Route::post('/save_contact/{id?}', [App\Http\Controllers\HomeController::class, 'save_contact'])->name('save_contact');
Route::get('/edit_contact/{id}', [App\Http\Controllers\HomeController::class, 'contact_form'])->name('edit_contact');
Route::get('/search_contact', [App\Http\Controllers\HomeController::class, 'search_contact'])->name('search_contact');
Route::get('/delete_contact/{id}', [App\Http\Controllers\HomeController::class, 'delete_contact'])->name('delete_contact');