<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;

Route::get('/', function () {
    return redirect()->route('equipment.index');
});

Route::resource('equipment', EquipmentController::class);
Route::get('/equipment/create', [EquipmentController::class, 'create'])->name('equipment.create');
Route::post('/equipment', [EquipmentController::class, 'store'])->name('equipment.store');
