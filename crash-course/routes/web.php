<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\welcomeconroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[welcomeconroller::class,'welcome'])->name('welcome');

Route::resource('note',NoteController::class);
