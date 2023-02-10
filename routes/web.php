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
    return view('frontend/home');
});
Route::get('/home', function () {
    return view('frontend/home');
});
Route::get('/authors', function () {
    return view('frontend/authors');
});
Route::get('/publishers', function () {
    return view('frontend/publishers');
});



//user
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    
    Route::get('/dashboard', [HomeController::class, 'redirectUser'])->name('dashboard');

    
});


//admin
Route::prefix('admin')->middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','role:admin'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('backend/approveList');
    })->name('admin.dashboard');

    Route::get('/issueList', function () {
        return view('backend/issueList');
    });
    Route::get('/createBook', function () {
        return view('backend/createBook');
    });

});



