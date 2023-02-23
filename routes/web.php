<?php

use Illuminate\Support\Facades\Route;
use App\Models\News;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AccessController;

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
    return view('welcome');
});

Route::get('news', [NewsController::class, 'index']);

Route::get('news/category/{categoryId}', [NewsController::class, 'getNewsFiltered'])->name('news-category');

Route::get('news/{id}', [NewsController::class, 'getNews'])->name('news-detail');

Route::get('login', [AccessController::class, 'getLogin'])->name('login');

Route::get('register', [AccessController::class, 'getRegister'])->name('register');

Route::post('doRegister', [AccessController::class, 'doRegister'])->name('doRegister');

Route::post('doLogin', [AccessController::class, 'doLogin'])->name('doLogin');