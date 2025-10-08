<?php

use Illuminate\Support\Facades\Route;
use RihabRahman\BulkSmsBD\Http\Controllers\DlrWebhookController;

Route::post('/bulksmsbd/dlr', [DlrWebhookController::class, 'handle']);
