<?php

use Illuminate\Support\Facades\Route;
use Hdelima\AppMax\Controllers\AppMaxNotificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| AppMax web routes
|
*/

Route::apiResource('app-max/notifications', AppMaxNotificationController::class);