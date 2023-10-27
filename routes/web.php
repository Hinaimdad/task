<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
   Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
   Route::get('/feedback/show', [FeedbackController::class, 'show'])->name('feedback.show');
   Route::post('/feedback/{id}/upvote', [FeedbackController::class,'upvote'])->name('feedback.upvote');

   Route::post('/comment/create', [CommentController::class, 'create']);
   Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');


 });

Route::middleware('admin')->group(function () {

   Route::get('/feedback/index', [FeedbackController::class, 'index'])->name('feedback.index');
   Route::delete('/feedback/destroy/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');

   Route::get('/comment/index', [CommentController::class, 'index'])->name('comment.index');
   Route::post('/comment/confirm/{id}', [CommentController::class, 'confirm'])->name('comment.approve');

   Route::get('/user/index', [AdminController::class, 'index'])->name('user.index');
   Route::delete('/user/destroy/{id}', [AdminController::class, 'destroy'])->name('user.destroy');
   Route::get('/get-users', [CommentController::class, 'getUsers']);
});





require __DIR__.'/auth.php';
