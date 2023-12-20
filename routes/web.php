<?php

use App\Livewire\Parameter;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => "user"], function () {
    Route::get('/spc/login', function () {
        return view('login');
    })->name('login');
    Route::get('/spc/register', function () {
        return view('register');
    })->name('register');
    Route::get('/spc/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/spc/chart', function () {
        return view('chart');
    })->name('chart');
    Route::get('/spc/logger', function () {
        return view('logger');
    })->name('logger');
    Route::get('/spc/parameter', function () {
        return view('parameter');
    })->name('parameter');
    Route::get('/spc/setting', function () {
        return view('setting');
    })->name('setting');
    Route::get('/spc/approve', function () {
        return view('approve');
    })->name('approve');
    Route::get('/spc/request', function () {
        return view('request');
    })->name('request');
});


