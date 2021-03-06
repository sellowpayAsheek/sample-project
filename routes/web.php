<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\EmailCheckController;
use App\Http\Controllers\MailCheckController;
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
    return view('welcome');
});

Route::get('/index',[CommonController::class,"index"])->name('check.index');

Route::post('/mail',[MailCheckController::class,"sendMail"])->name('mail.sent');
Route::post('email',[EmailCheckController::class,"sendEmail"])->name('email.sent');

Route::get('/record',[CommonController::class,"getRecords"])->name('check.record');

Route::get('/list',[CommonController::class,"getCheckList"])->name('check.list');

Route::post('/void/{id}',[CommonController::class,"voidCheck"])->name('check.void');
Route::get('/view/{id}',[CommonController::class,"viewCheck"])->name('check.view');
Route::get('/print/{id}',[CommonController::class,"printCheck"])->name('check.print');

Route::webhooks('webhook-receiving-url');
