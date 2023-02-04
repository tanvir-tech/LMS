<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('pages/home');
});
Route::get('/home', function () {
    return view('pages/home');
});
Route::get('/authors', function () {
    return view('pages/authors');
});
Route::get('/publishers', function () {
    return view('pages/publishers');
});


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    
    Route::get('/dashboard', [HomeController::class, 'redirectUser'])->name('dashboard');

    
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:admin'])->group(function () {
    
    Route::get('/admin/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');

});
