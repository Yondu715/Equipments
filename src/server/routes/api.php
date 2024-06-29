<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\EquipmentController;
use App\Http\Controllers\Api\V1\EquipmentTypeController;

Route::patterns([
    'equipment' => '[0-9]+'
]);

Route::apiResource('equipments', EquipmentController::class);

Route::prefix('equipment-types')->group(function () {
    Route::get('/', [EquipmentTypeController::class, 'index']);
});
