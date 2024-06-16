<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\EquipmentController;
use App\Http\Controllers\Api\V1\EquipmentTypeController;

Route::patterns([
    'equipmentId' => '[0-9]+'
]);

Route::prefix('equipments')->group(function () {
    Route::get('/', [EquipmentController::class, 'index']);
});

Route::prefix('equipment-types')->group(function () {
    Route::get('/', [EquipmentTypeController::class, 'index']);
});
