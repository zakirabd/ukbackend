<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EducationLabelsController;
use App\Http\Controllers\EducationServicesController;
use App\Http\Controllers\EducationSubServicesController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PartnersController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\TourismServicesController;
use App\Http\Controllers\UserController;
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

Route::prefix('v1')->group(function () {
    Route::resource('user', UserController::class);
    Route::post('login', [loginController::class, 'login']);
    Route::group(['middleware'=> ['auth:sanctum']], function(){
        Route::resource('about', AboutController::class);
        Route::resource('partners', PartnersController::class);
        Route::resource('teams', TeamsController::class);
        Route::resource('news', NewsController::class);
        Route::resource('services', ServicesController::class);
        Route::resource('contact', ContactController::class);
        Route::resource('tourism-services', TourismServicesController::class);
        Route::resource('education-services', EducationServicesController::class);
        Route::resource('education-sub-services', EducationSubServicesController::class);
        Route::resource('education-label', EducationLabelsController::class);
    });
    Route::get('public-about', [AboutController::class, 'index']);
    Route::get('public-teams', [TeamsController::class, 'index']);
    Route::get('public-partners', [PartnersController::class, 'index']);
    Route::get('public-news', [NewsController::class, 'index']);
    Route::get('public-news/{id}', [NewsController::class, 'getNewsData']);
    Route::get('public-services', [ServicesController::class, 'index']);
    Route::get('public-contact', [ContactController::class, 'index']);
    Route::post('public-insurance', [InsuranceController::class, 'store']);
    Route::get('public-tourism-services', [TourismServicesController::class, 'index']);
    Route::post('public-tourism-user', [TourismServicesController::class, 'addUserTourismServices']);
    Route::get('public-education-services', [EducationServicesController::class, 'getFullEducationServices']);
    // addUserTourismServices
});