<?php

use App\Http\Controllers\ClientKeyController;
use Illuminate\Support\Facades\Route;

Route::get('/client-key', [ClientKeyController::class, 'index']);
