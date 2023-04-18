<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\frontend\HomeController;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', function () {
        return view('frontend.home');
    });
    Route::get('/clear-cache', function() {
        Artisan::call('cache:clear');
        return "Cache is cleared";
    });
    Route::get('/category', function() {
        return view('frontend.category');
    });
    Route::get('/media', function() {
        return view('frontend.media');
    });
//    Route::group(['middleware' => 'locale'], function() {
        Route::get('change-language/{language}', [HomeController::class,'changeLanguage'])->name('frontend.change-language');
//    });

Route::get('resize/{size}/{path}', [\App\Http\Controllers\Admin\TinyController::class,'resize'])->where('path', '(.*)')->name('resize');



