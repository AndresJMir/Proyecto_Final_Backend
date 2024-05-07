<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TokenController;

use App\Http\Controllers\Api\ChargingPointController;
use App\Http\Controllers\Api\ProposalController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Middleware\EnsureUserHasAnyRole;
use App\Models\Role;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Agrega las siguientes rutas para el TokenController
// Route::post('/register', [TokenController::class, 'register']);
// Route::post('/login', [TokenController::class, 'login']);
// Route::post('/logout', [TokenController::class, 'logout'])->middleware('auth:sanctum');
// Route::get('/user-info', [TokenController::class, 'user'])->middleware('auth:sanctum');

// Route::middleware('guest')->group(function () {
//     // usuarios sin autenticar
//     Route::post('/register', [TokenController::class, 'register']);
//     Route::post('/login', [TokenController::class, 'login']);
// });

// Route::middleware('auth:sanctum')->group(function () {
//     // Token
//     Route::get('user', [TokenController::class, 'user']);
//     Route::post('logout', [TokenController::class, 'logout']);
//     // ChargingPoints, Proposals, Ratings

// });

// usuarios sin autenticar
Route::middleware('guest')->group(function () {
    // Token
    Route::post('register', [TokenController::class, 'register']);
    Route::post('login', [TokenController::class, 'login']);
    // ChargingPoints (sin login, solo lectura)
    Route::get('charging-points', [ChargingPointController::class, 'index']);
    Route::get('charging-points/{chargingPoint}', [ChargingPointController::class, 'show']);
});

//Usuarios autenticados
Route::middleware('auth:sanctum')->group(function () {
    // Token
    Route::get('user', [TokenController::class, 'user']);
    Route::post('logout', [TokenController::class, 'logout']);
    // ChargingPoints (con login, CRUD completo)
    // Route::post('charging-points', [ChargingPointController::class, 'store']);
    Route::put('charging-points/{chargingPoint}', [ChargingPointController::class, 'update']);
    Route::delete('charging-points/{chargingPoint}', [ChargingPointController::class, 'destroy']);
    // Route::post('charging-points/{chargingPoint}/proposals', 'propose')
    //     ->name('charging-points.propose');
    // Route::delete('charging-points/{chargingPoint}/proposals', 'unpropose')
    //     ->name('charging-points.unpropose');

    // // Proposals (con login, CRUD completo)
    // Route::apiResource('proposals', ProposalController::class);
    // Route::controller(ProposalController::class)->group(function () {
    //     Route::post('proposals/{proposal}', 'update_workaround')
    //         ->name('proposals.update_proposal');
    // });

    // Ratings (con login, CRUD completo)
    Route::apiResource('charging-points.ratings', RatingController::class);

    // Route::post('/charging-points', [ChargingPointController::class, 'store'])
    // 
    Route::post('/charging-points', [ChargingPointController::class, 'store'])
        ->middleware(['role:' . implode(',', [Role::ADMIN, Role::EDITOR])]);
        //->middleware(EnsureUserHasAnyRole::class, [Role::ADMIN, Role::EDITOR]);
        // Estaba mal devido a que debes pasar el array como un parámetro adicional al middleware

    
});


// Route::apiResource('charging-points', ChargingPointController::class);
// Route::apiResource('proposals', ProposalController::class);
// Route::apiResource('ratings', RatingController::class);

