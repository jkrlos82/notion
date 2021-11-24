<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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

Route::get('/', [BlogController::class, 'index'])->name('home');

Route::get('/dashboard', [BlogController::class, 'userPosts'])->middleware(['auth'])->name('dashboard');

Route::get('/dashboard/post', [BlogController::class, 'create'])->name('post.create');
Route::post('/dashboard/post', [BlogController::class, 'store'])->name('post.save');

require __DIR__.'/auth.php';
