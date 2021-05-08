<?php

use App\Http\Controllers\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registration;
use App\Http\Controllers\Student_D;
use Illuminate\Support\Facades\Auth;

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
//     return view('pages.test');
// });

Route::get('/dd', [Registration::class,'deadCall'])->name('dd');
Route::get('/registration', [Registration::class, 'reg'])->name('registraton');
Route::POST('/valideteReg', [Registration::class, 'validating'])->name('validationReg');
Route::get('/populate', [Registration::class, 'populateDatabase'])->name('populate');

Route::get('/', [Login::class, 'login'])->name('login');
Route::POST('/', [Login::class, 'validation'])->name('validationLogin');
Route::get('/dashboard', [Login::class, 'index'])->name('dashboard');


Route::get('/studentD/{id}/d', [Student_D::class, 'index']);
Route::get('/overallReport/{id}/d', [Student_D::class, 'oR']);
Route::get('/overallReport', [Student_D::class, 'showOR']);
Route::get('/student', [Student_D::class, 'showH']);

// Route::get('/edit', function () {
//     return view('pages/student/overallReport');
// });

Route::get('/edit', function () {
    return view('pages/faculty/studentreport');
});
// Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
