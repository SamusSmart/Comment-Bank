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

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

Route::get('/unverified-crud', function () {
    return view('unverified-crud');
});


use App\Http\Controllers\AjaxCommentController; 

Route::get('ajax-comment-crud', [AjaxCommentController::class, 'index'])->middleware(['auth','verified'])->name('dashboard');

Route::post('save-comment', [AjaxCommentController::class, 'store']); 

Route::get('fetch-comments', [AjaxCommentController::class, 'fetchComments']); 

Route::get('edit-comment/{id}', [AjaxCommentController::class, 'edit']); 

Route::put('update-comment/{id}', [AjaxCommentController::class, 'update']); 

Route::delete('delete-comment/{id}', [AjaxCommentController::class, 'destroy']);

require __DIR__.'/auth.php';
