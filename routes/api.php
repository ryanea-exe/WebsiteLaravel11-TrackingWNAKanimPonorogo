<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DummyWNAController;

Route::post('/dummy/wna', [DummyWNAController::class, 'generate']);

Route::get('/test', function () {
    return 'API OK';
});