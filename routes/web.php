<?php

use App\Http\Controllers\RedirectController;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
})->name('welcome');

Route::get('/aviso', function () {
    return view('aviso');
}); 

Route::get('/login', function () {
    return view('login_empresa');
});


Route::group(['middleware' => ['auth']], function(){

    Route::controller(RedirectController::class)->group(function(){
        Route::get('/dados-empresa',  'dados_empresa')->name('dados_empresa');
        Route::get('/grau-de-inovação',  'questionario_g_inovacao')->name('questionario_g_inovacao');
    });
});
