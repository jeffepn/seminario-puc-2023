<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function () {
    request()->validate(
        [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]
    );
    //Auth::attempt();
    $authenticated = auth()->attempt(request()->only(['email', 'password']));

    if (!$authenticated) {
        return redirect()->back()->with('error', 'Dados inválidos.')->withInput();
    }

    return redirect()->route('dashboard-teste');

})->name('login-authentication');
Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('login');
})->name('logout');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')
    ->name('dashboard-teste');
