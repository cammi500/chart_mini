<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/',[PageController::class,'index']);
// Route::get('details',[AdminController::class,'details'])->name('admin#details');
