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

Route::get('appmax/notifications', [ AppMaxNotificationController::class, 'index' ] );

Route::post('appmax/notifications', [ AppMaxNotificationController::class, 'store' ] );