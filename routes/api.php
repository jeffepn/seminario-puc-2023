<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SaleController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    });

Route::post('/sanctum/token', function () {
    request()->validate(
        [
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required']
        ]
    );
    /** @var User */
    $user = User::where('email', request()->input('email'))->first();
    if (
        Hash::check(
            request()->input('password'),
            $user->password
        )
    ) {
        return response([
            'message' => 'Ok',
            'token' => $user->createToken('default')->plainTextToken,
        ]);

    }

    return response(['message' => 'Os dados são inválidos.'], Response::HTTP_UNAUTHORIZED);
})->name('login-api');


Route::middleware('auth:sanctum')->group(function () {
    // Versão simplificado
    Route::apiResources([
        'users' => UserController::class,
        'sales' => SaleController::class,
        'products' => ProductController::class,
    ]);
});

/*Route::post('users', [UserController::class, 'store']);
Route::get('users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::delete('users/{user}', [UserController::class, 'destroy']);
Route::patch('users/{user}', [UserController::class, 'update']);*/
