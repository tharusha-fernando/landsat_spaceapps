<?php

use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('tect-email',[TestController::class,'index']);