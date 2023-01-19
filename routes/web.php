<?php

declare(strict_types=1);

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [EmployeeController::class, 'login']);
