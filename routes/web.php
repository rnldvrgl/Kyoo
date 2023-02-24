<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/', function () {
	return view('welcome');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/live_queue', function () {
	return view('live_queue');
})->name('live_queue');

Route::get('/frequent_questions', function () {
	return view('frequent-questions');
})->name('faqs_landing');
