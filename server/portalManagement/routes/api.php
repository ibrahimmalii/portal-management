<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\SubCompaniesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);

Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/dropdown', [CompanyController::class, 'getDropDown']);
Route::post('/companies', [CompanyController::class, 'store']);
Route::get('/companies/{company}', [CompanyController::class, 'show']);
Route::delete('/companies/{company}', [CompanyController::class, 'delete']);
Route::post('/companies/{company}', [CompanyController::class, 'update']);

Route::resource('subCompanies', SubCompaniesController::class);

Route::get('/getAvaliableUsers/{company}', [CompanyController::class, 'getAvaliableUsersInCompany'])->name('getAvaliableUsers');
