<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\backend\AuthController;
    use App\Http\Controllers\backend\AdminController;

    use App\Http\Controllers\backend\TinyController;
    use App\Http\Controllers\backend\RoleController;

    use App\Http\Controllers\backend\GateWayController;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\NodeController;
    use App\Http\Controllers\backend\SensorController;



    
    // TinyController
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
    Route::group(['middleware'=>'guest'], function() {
        Route::get('/login', function () {
            return view('backend.authenticate.login');
        })->name('login');
        Route::post('/login', [AuthController::class,'login'])->name('action-login');
    });


    Route::group(['middleware'=>'auth'], function() {
        Route::post("/logout",[AuthController::class,'logout'])->name("logout");
        // Route::get('/', function () {
        //     return view('backend.home');
        // })->name('admin');
        Route::get('/', [HomeController::class,'index'])->name('admin');

        Route::get('/list-account', [AdminController::class,'index'])->name('account-list');
        Route::get('/add-account', [AdminController::class,'create'])->name('account-add');
        Route::post('/add-account', [AdminController::class,'createAccount'])->name('account-post');
        Route::get('/edit-account/{id}', [AdminController::class,'edit'])->name('account-edit')->where(['id' => '[0-9]+']);
        Route::post('/edit-account/{id}', [AdminController::class,'postEdit'])->name('post-account-edit')->where(['id' => '[0-9]+']);
        Route::group(['prefix'=>'role'], function() {
            Route::get('/list-role', [RoleController::class,'index'])->name('list-role');
            Route::get('/create-role', [RoleController::class,'create'])->name('create-role');
            Route::post('/create-role', [RoleController::class,'createPost'])->name('add-role');
            // Route::get('/update-post/{slug}/{id}', [RoleController::class,'editPost'])->name('edit-role')
            //     ->where(['slug' => '.*?','id' => '[0-9]+']);
            // Route::post('/update-post', [RoleController::class,'update'])->name('update-role');
        });
        Route::group(['prefix'=>'sensor'], function () {
            Route::get('list',[SensorController::class,'index'])->name('sensor-list');
            Route::post('create',[SensorController::class,'create'])->name('sensor-create');
            Route::post('store',[SensorController::class,'store'])->name('sensor-store');            
            Route::get('edit/{id}',[SensorController::class,'edit'])->name('edit-sensor')->where(['id' => '[0-9]+']);
            Route::post('update/{id}',[SensorController::class,'update'])->name('update-sensor');
            Route::get('/delete/{id}', [SensorController::class,'destroy'])->name('delete-sensor')->where(['id' => '[0-9]+']);
        });
        Route::group(['prefix'=>'gateway'], function () {
            Route::get('list',[GateWayController::class,'index'])->name('gateway-list');
            Route::post('create',[GateWayController::class,'create'])->name('gateway-create');
            Route::post('store',[GateWayController::class,'store'])->name('gateway-store');            
            Route::get('edit/{id}',[GateWayController::class,'edit'])->name('edit-gateway')->where(['id' => '[0-9]+']);
            Route::post('update/{id}',[GateWayController::class,'update'])->name('update-gateway');
            Route::get('/delete/{id}', [GateWayController::class,'destroy'])->name('delete-gateway')->where(['id' => '[0-9]+']);
            Route::get('detail/{id}',[GateWayController::class,'detail'])->name('detail-gateway')->where(['id' => '[0-9]+']);

        });
        Route::group(['prefix'=>'node'], function () {
            Route::get('list',[NodeController::class,'index'])->name('node-list');
            Route::post('create',[NodeController::class,'create'])->name('node-create');
            Route::post('store',[NodeController::class,'store'])->name('node-store');            
            Route::get('edit/{id}',[NodeController::class,'edit'])->name('edit-node')->where(['id' => '[0-9]+']);
            Route::post('update/{id}',[NodeController::class,'update'])->name('update-node');
            Route::get('/delete/{id}', [NodeController::class,'destroy'])->name('delete-node')->where(['id' => '[0-9]+']);
        });

        Route::group(['prefix' => 'editor'], function () {
            Route::get('box-tho', function () {
                return view('backend.tinymce.box_tho');
            })->name('box-tho');
            Route::get('info-editor', function () {
                return view('backend.tinymce.info');
            })->name('info-editor');
            Route::get('live-content', function () {
                return view('backend.tinymce.live');
            })->name('live-content');
            Route::get('quote-box', function () {
                return view('backend.tinymce.quote-box');
            })->name('quote-box');
            Route::get('quote', function () {
                return view('backend.tinymce.quote');
            })->name('quote');
            Route::get('preview', function () {
                return view('backend.tinymce.preview');
            })->name('preview');
            Route::get('pdf', function () {
                return view('backend.tinymce.pdf');
            })->name('pdf');
            Route::get('attack', function () {
                return view('backend.tinymce.pdf');
            })->name('pdf');
            Route::post('pdf',[TinyController::class,'pdf'])->name('post.pdf');
            Route::get('attack',[TinyController::class,'attack'])->name('editor.attack');
            Route::post('attack',[TinyController::class,'attack'])->name('post.attack');
            Route::get('image', [TinyController::class, 'image'])->name('images');
            Route::post('image', [TinyController::class, 'image'])->name('images-action');
            Route::get('video', [TinyController::class, 'video'])->name('video');
            Route::post('video', [TinyController::class, 'video'])->name('video-action');
            Route::get('setcover', [TinyController::class, 'setcover'])->name('set-cover');
            Route::get('insert-video', [TinyController::class, 'insertVideo'])->name('insert-video');
            Route::get('link', [TinyController::class, 'link'])->name('link');
            Route::get('editimage', [TinyController::class, 'editimage'])->name('editimage');
    
        });

    });

