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

Route::webhooks('webhook-receiving-url');
