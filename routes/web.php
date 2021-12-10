<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AcademicLevelController;

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

Route::view('/login', 'layouts.master');

Route::view('test-view', 'test.test');
Route::view('bill-print', 'test.bill-print');
Route::view('mark-print', 'test.mark-print');
Route::get('academic-level-create', [AcademicLevelController::class, 'createAcademicLevel']);

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return "Cache is cleared";
});

/* Auth::routes(); */

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/helper-url', 'HomeController@helperURL')->name('helper-url');

Route::get('/load-test-student', [\App\Http\Controllers\API\AdmissionController::class, 'testStudentDataTable']);

Route::get('{any}', function () {
    return view('layouts.master');
})->where('any', '[\/\w\.-]*');

/* Route::get('{path}','HomeController@index')->where('path','[\/\w\.-]*'); */
