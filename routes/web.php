<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainController;
use App\Http\Controllers\PublicController;

Route::get('/', [PublicController::class, 'index'])->name('trains.index');

Route::get('/TrainStatus', [PublicController::class, 'getTrainStatus'])->name('trains.data');

Route::get('/SaveTrains', [TrainController::class, 'index'])->name('save.trains');

Route::post('/trains/save', [TrainController::class, 'store']);

Route::delete('/train/destroy/{train}', [TrainController::class, 'destroy'])->name('train.destroy');

Route::delete('/trains/deleteAll', [TrainController::class, 'deleteAll'])->name('train.deleteAll');
