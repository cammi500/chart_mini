<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[PageController::class,'index']);
Route::post('/',[PageController::class,'store']);
// Route::get('details',[AdminController::class,'details'])->name('admin#details');
