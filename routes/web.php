<?php

    use Illuminate\Support\Facades\Route;
    
    

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
    if (App::environment('production')) {
        URL::forceScheme('https');
    }
    // if (App::environment('local')) {
    //     URL::forceScheme('https');
    // }

    // Route::get('/', function () {
    //     return view('frontend.home');
    // })->name('home-FE');


    Route::get('/category', function() {
        return view('frontend.category');
    });





