<?php

use Illuminate\Http\Request;
use App\Http\Controllers\GenericController;

Route::apiResource('generics', GenericController::class);