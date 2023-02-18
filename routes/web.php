<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
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
Route::get('/category/all', function () {
    return view('frontend/categories');
});
Route::get('/category/{id}', [BookController::class, 'category']);

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
        return redirect('/admin/approvelist');
    })->name('admin.dashboard');

    Route::get('/issueList', function () {
        return view('backend/issueList');
    });
    Route::get('/createBook', function () {
        return view('backend/createBook');
    });

    Route::get('/createCat',  [CategoryController::class, 'index']);
    Route::post('/createCat', [CategoryController::class, 'createCat']);

    Route::resource('/book', BookController::class);

    //book issue request-list for approval
    Route::get('/approvelist', [IssueController::class, 'approvelist'])->name('approvelist');
    //approve 
    Route::get('/issue/{id}/approve', [IssueController::class, 'approve']);
    //deny 
    Route::get('/issue/{id}/deny', [IssueController::class, 'deny']);

    // issue-list
    Route::get('/issuelist', [IssueController::class, 'issuelist'])->name('issuelist');
    // renew
    Route::get('/issue/{id}/renew', [IssueController::class, 'renew']);
    // receive
    Route::get('/issue/{id}/receive', [IssueController::class, 'receive']);

});



// Request 
Route::get('/userrequest', function () {
    return view('frontend/userRequest');
});