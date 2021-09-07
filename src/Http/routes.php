<?php

use Weiwait\DcatEasySms\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('dcat-easy-sms', Controllers\DcatEasySmsController::class.'@index');