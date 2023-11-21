<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TriviaController;

Route::get('/', function () { return view('index'); })->name('index'); // index page
Route::get('/list', function () { return view('list'); })->name('list'); // list page

Route::post('/',[TriviaController::class,'store'])->name('store'); // store

