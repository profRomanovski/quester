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
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login-action', [AuthController::class, 'loginAction'])->name('login.action');
Route::post('/register-action', [AuthController::class, 'registerAction'])->name('register.action');
Route::get('/', [HomeController::class, 'general'])->name('general');

Route::middleware('auth:web')->group(function () {
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/test-view', [TestController::class, 'testView'])->name('test.view');
    Route::get('/test-create', [TestController::class, 'testCreate'])->name('test.create');
    Route::post('/test-create-action', [TestController::class, 'testCreateAction'])->name('test.create.action');
    Route::get('/test-edit', [TestController::class, 'testEdit'])->name('test.edit');
    Route::post('/test-edit-action', [TestController::class, 'testEditAction'])->name('test.edit.action');
    Route::get('/test-result', [TestController::class, 'testResult'])->name('test.result');
    Route::post('/test-result-action', [TestController::class, 'testResultAction'])->name('test.result.action');
    Route::get('/test-complete', [TestController::class, 'testComplete'])->name('test.complete');
    Route::post('/test-complete-action', [TestController::class, 'testCompleteAction'])->name('test.complete.action');
    Route::get('/test-complete-result', [TestController::class, 'testCompleteResult'])->name('test.complete.result');
    Route::get('/test-statistic', [TestController::class, 'testStatistic'])->name('test.statistic');
    Route::get('/test-statistic-delete', [TestController::class, 'testStatisticDelete'])->name('test.statistic.delete');
    Route::post('/test-statistic-search', [TestController::class, 'testStatisticSearch'])->name('test.statistic.search');
    Route::post('/test-search', [HomeController::class, 'testSearch'])->name('test.search');
    Route::get('/test-delete', [TestController::class, 'testDelete'])->name('test.delete');
    Route::get('/user-statistic', [TestController::class, 'userStatistic'])->name('user.statistic');
    Route::get('/user-statistic-delete', [TestController::class, 'userStatisticDelete'])->name('user.statistic.delete');

});
