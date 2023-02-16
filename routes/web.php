<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IssueController;

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

Route::get('/messagepage', function () {
    return view('includes/messagepage');
});
Route::get('/authors', function () {
    return view('frontend/authors');
});
Route::get('/publishers', function () {
    return view('frontend/publishers');
});
Route::get('/categories', function () {
    return view('frontend/categories');
});
Route::get('/', [BookController::class, 'index']);
Route::get('/home', [BookController::class, 'index']);
Route::get('/search',[BookController::class,'search']);
Route::get('/latest', [BookController::class, 'latestBooks']);

//user
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', [HomeController::class, 'redirectUser'])->name('dashboard');

    //borrow by book id
    Route::get('/book/{id}/borrow', [IssueController::class, 'create'])->name('borrow');
});


//admin
Route::prefix('admin')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'role:admin'])->group(function () {

    Route::get('/dashboard', function () {
        return view('backend/approveList');
    })->name('admin.dashboard');

    Route::get('/issueList', function () {
        return view('backend/issueList');
    });
    Route::get('/createBook', function () {
        return view('backend/createBook');
    });

    Route::resource('/book', BookController::class);

    //book issue request-list for approval
    Route::get('/approvelist', [IssueController::class, 'index'])->name('approve.request');
    //approve 
    // Route::get('/issue/approve', [IssueController::class, 'index'])->name('issue.request');
    //deny 
    // Route::get('/issue/deny', [IssueController::class, 'index'])->name('issue.request');

    // issuelist
    Route::get('/issuelist', [IssueController::class, 'issuelist'])->name('issuelist');
});



// Request 
Route::get('/userrequest', function () {
    return view('frontend/userRequest');
});