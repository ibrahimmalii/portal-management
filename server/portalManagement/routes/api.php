<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\LiabilityController;
use App\Http\Controllers\Api\LiabilityDatesController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SubCompaniesController;
use App\Http\Controllers\Api\UserController;
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
Route::get('/companies/{company}/users', [CompanyController::class, 'getUsers']);
Route::get('/companies/{company}/sub_companies', [CompanyController::class, 'getRelatedSubCompanies']);
Route::post('/companies', [CompanyController::class, 'store']);
Route::get('/companies/{company}', [CompanyController::class, 'show']);
Route::delete('/companies/{company}', [CompanyController::class, 'delete']);
Route::post('/companies/{company}', [CompanyController::class, 'update']);

Route::get('/subCompanies/{subCompany}/users', [SubCompaniesController::class, 'getUsers']);
Route::get('/subCompanies/dropdown', [SubCompaniesController::class, 'getDropDown']);
Route::resource('subCompanies', SubCompaniesController::class);

Route::get('users/supervisors/dropdown', [UserController::class, 'getSupervisorsDropDown']);
Route::get('users/dropdown', [UserController::class, 'getEmployeesDropdown']);

Route::post('users/change-password', [UserController::class, 'changePassword']);
Route::resource('users', UserController::class);

Route::resource('liabilities', LiabilityController::class);
Route::resource('products', ProductController::class);
Route::resource('liability-dates', LiabilityDatesController::class);

Route::get('/getAvaliableUsers/{company}', [CompanyController::class, 'getAvaliableUsersInCompany'])->name('getAvaliableUsers');
