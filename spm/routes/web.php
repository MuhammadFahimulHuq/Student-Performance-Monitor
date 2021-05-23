<?php

use App\Http\Controllers\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Registration;
use App\Http\Controllers\Student_D;
use App\Http\Controllers\Faculty_D;
use App\Http\Controllers\HigerO_D;
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

//Registration
Route::get('/dd', [Registration::class,'deadCall'])->name('dd');
Route::get('/registration', [Registration::class, 'reg'])->name('registraton');
Route::POST('/valideteReg', [Registration::class, 'validating'])->name('validationReg');
Route::get('/populate', [Registration::class, 'populateDatabase'])->name('populate');

// Login
Route::get('/', [Login::class, 'login'])->name('login');
Route::POST('/', [Login::class, 'validation'])->name('validationLogin');
Route::get('/dashboard', [Login::class, 'index'])->name('dashboard');

// Student
Route::get('/studentD/{id}/d', [Student_D::class, 'index']);
Route::get('/student', [Student_D::class, 'showH']);
Route::get('/overallReport/{id}/d', [Student_D::class, 'oR']);
Route::get('/overallReport', [Student_D::class, 'showOR']);

// Faculty
Route::get('/facultyD/{id}/d', [Faculty_D::class, 'index']);
Route::get('/faculty', [Faculty_D::class, 'showH']);
Route::get('/studentReport/{id}/d', [Faculty_D::class, 'sR']);
Route::get('/studentReport', [Faculty_D::class, 'showsR']);
Route::get('/courseReport/{id}/d', [Faculty_D::class, 'cR']);
Route::get('/courseReport', [Faculty_D::class, 'showcR']);
Route::POST('/hsr/{id}/d', [Faculty_D::class, 'hsr'])->name('hsr');
Route::POST('/hsg/{id}/d', [Faculty_D::class, 'hsg'])->name('hsg');
Route::POST('/hcr/{id}/d', [Faculty_D::class, 'hcr'])->name('hcr');

//higerOfficial
Route::get('/HigherO/{id}/d', [HigerO_D::class, 'index']);
Route::get('/HigherO', [HigerO_D::class, 'showH']);
Route::get('/studentReportO/{id}/d', [HigerO_D::class, 'sR']);
Route::get('/studentReportO', [HigerO_D::class, 'showsR']);
Route::get('/schoolEnrollment', [HigerO_D::class, 'showsE']);
Route::get('/schoolEnrollment/{id}/d', [HigerO_D::class, 'sE']);
Route::get('/departmentEnrollment', [HigerO_D::class, 'showdE']);
Route::get('/departmentEnrollment/{id}/d', [HigerO_D::class, 'dE']);


Route::get('/schoolcgpa/{id}/d', [HigerO_D::class, 'sC']);
Route::get('/schoolcgpa', [HigerO_D::class, 'showsC']);
Route::POST('/hsc/{id}/d', [HigerO_D::class, 'hsc'])->name('hsc');

Route::get('/departmentcgpa/{id}/d', [HigerO_D::class, 'dC']);
Route::get('/departmentcgpa', [HigerO_D::class, 'showdC']);
Route::POST('/hdc/{id}/d', [HigerO_D::class, 'hdc'])->name('hdc');

Route::get('/programcgpa/{id}/d', [HigerO_D::class, 'pC']);
Route::get('/programcgpa', [HigerO_D::class, 'showpC']);
Route::POST('/hpc/{id}/d', [HigerO_D::class, 'hpc'])->name('hpc');


Route::get('/VCcgpa/{id}/d', [HigerO_D::class, 'VC']);
Route::get('/VCcgpa', [HigerO_D::class, 'showVC']);
Route::POST('/hVc/{id}/d', [HigerO_D::class, 'hVc'])->name('hVc');

Route::get('/DEANcgpa/{id}/d', [HigerO_D::class, 'DC']);
Route::get('/DEANcgpa', [HigerO_D::class, 'showDC']);
Route::POST('/hDc/{id}/d', [HigerO_D::class, 'hDc'])->name('hDc');

Route::get('/HEADcgpa/{id}/d', [HigerO_D::class, 'HC']);
Route::get('/HEADcgpa', [HigerO_D::class, 'showHC']);
Route::POST('/hHc/{id}/d', [HigerO_D::class, 'hHc'])->name('hHc');



Route::get('/programEnrollment', [HigerO_D::class, 'showpE']);
Route::get('/programEnrollment/{id}/d', [HigerO_D::class, 'pE']);
Route::get('/courseReportO/{id}/d', [HigerO_D::class, 'cR']);
Route::get('/courseReportO', [HigerO_D::class, 'showcR']);
Route::POST('/hsrO/{id}/d', [HigerO_D::class, 'hsr'])->name('hsr');
Route::POST('/hcrO/{id}/d', [HigerO_D::class, 'hcr'])->name('hcr');
Route::POST('/hse/{id}/d', [HigerO_D::class, 'hse'])->name('hse');
Route::POST('/hde/{id}/d', [HigerO_D::class, 'hde'])->name('hde');
Route::POST('/hpe/{id}/d', [HigerO_D::class, 'hpe'])->name('hpe');





// Higer Official

// Route::get('/edit', function () {
//     return view('pages/student/overallReport');
// });

// Route::get('/edit', function () {
//     return view('pages/faculty/studentreport');
// });

Route::get('/test', function () {
    return view('pages/test');
});
// Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
