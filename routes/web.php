<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
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
    return view('layouts.main');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-action', [AuthController::class, 'loginAction'])->name('login.action');

Route::middleware('auth:web')->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/test-view', [TestController::class, 'testView'])->name('test.view');
    Route::get('/test-create', [TestController::class, 'testCreate'])->name('test.create');
    Route::post('/test-create-action', [TestController::class, 'testCreateAction'])->name('test.create.action');
    Route::get('/test-edit', [TestController::class, 'testEdit'])->name('test.edit');
    Route::post('/test-edit-action', [TestController::class, 'testEditAction'])->name('test.edit.action');
    Route::get('/test-result', [TestController::class, 'testResult'])->name('test.result');
    Route::post('/test-result-action', [TestController::class, 'testResultAction'])->name('test.result.action');


});
