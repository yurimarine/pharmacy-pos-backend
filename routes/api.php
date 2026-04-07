<?php

use Illuminate\Http\Request;
use App\Http\Controllers\GenericController;
use App\Http\Controllers\SupplierController;

Route::apiResource('generics', GenericController::class);
Route::apiResource('suppliers', SupplierController::class);