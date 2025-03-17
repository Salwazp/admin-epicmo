<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\Admin\AboutController as AboutAdmin;
use App\Http\Controllers\Admin\CareerController as CareerAdmin;
use App\Http\Controllers\Admin\RunningImageController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\WhyController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PreferenceController;
use App\Http\Controllers\Admin\SpesifikasiController;
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

Auth::routes();
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin' , 'as' => 'admin.'], function(){
    Auth::routes();
    Route::middleware('auth:admin')->group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::group(['prefix' => 'banner', 'as' => 'banner.'], function() {
            Route::get('/', [BannerController::class, 'index'])->name('index');
            Route::get('/create', [BannerController::class, 'create'])->name('create');
            Route::post('/store', [BannerController::class, 'store'])->name('store');
            Route::get('/edit/{banner}', [BannerController::class, 'edit'])->name('edit');
            Route::post('/update/{banner}', [BannerController::class, 'update'])->name('update');
            Route::get('/delete/{banner}', [BannerController::class, 'delete'])->name('delete');

            Route::group(['prefix' => 'spesifikasi', 'as' => 'spesifikasi.'], function() {
                Route::get('/{banner}', [SpesifikasiController::class, 'index'])->name('index');
                Route::post('{banner}/store', [SpesifikasiController::class, 'store'])->name('store');
                Route::get('/create/{banner}', [SpesifikasiController::class, 'create'])->name('create');
                
                Route::get('/edit/{spesifikasi}', [SpesifikasiController::class, 'edit'])->name('edit');
                Route::post('/update/{spesifikasi}', [SpesifikasiController::class, 'update'])->name('update');
                Route::get('/delete/{spesifikasi}', [SpesifikasiController::class, 'delete'])->name('delete');
            });
        });
        
        Route::group(['prefix' => 'about-section', 'as' => 'about-section.'], function() {
            Route::get('/', [AboutSectionController::class, 'index'])->name('index');
            Route::get('/create', [AboutSectionController::class, 'create'])->name('create');
            Route::post('/store', [AboutSectionController::class, 'store'])->name('store');
            Route::get('/edit/{about}', [AboutSectionController::class, 'edit'])->name('edit');
            Route::post('/update/{about}', [AboutSectionController::class, 'update'])->name('update');
            Route::get('/delete/{about}', [AboutSectionController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'about', 'as' => 'about.'], function() {
            Route::get('/', [AboutAdmin::class, 'index'])->name('index');
            Route::get('/create', [AboutAdmin::class, 'create'])->name('create');
            Route::post('/store', [AboutAdmin::class, 'store'])->name('store');
            Route::get('/edit/{about}', [AboutAdmin::class, 'edit'])->name('edit');
            Route::post('/update/{about}', [AboutAdmin::class, 'update'])->name('update');
            Route::get('/delete/{about}', [AboutAdmin::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'running_image', 'as' => 'running_image.'], function() {
            Route::get('/', [RunningImageController::class, 'index'])->name('index');
            Route::get('/create', [RunningImageController::class, 'create'])->name('create');
            Route::post('/store', [RunningImageController::class, 'store'])->name('store');
            Route::get('/edit/{running_image}', [RunningImageController::class, 'edit'])->name('edit');
            Route::post('/update/{running_image}', [RunningImageController::class, 'update'])->name('update');
            Route::get('/delete/{running_image}', [RunningImageController::class, 'delete'])->name('delete');
        });


        Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function() {
            Route::get('/', [GalleryController::class, 'index'])->name('index');
            Route::post('/store', [GalleryController::class, 'store'])->name('store');
            Route::post('/update/{gallery}', [GalleryController::class, 'update'])->name('update');

            Route::group(['prefix' => 'image', 'as' => 'image.'], function() {
                Route::post('/update/{gallery_image}', [GalleryImageController::class, 'update'])->name('update');
                Route::get('/edit/{gallery_image}', [GalleryImageController::class, 'edit'])->name('edit');
            });
        });

        Route::group(['prefix' => 'why', 'as' => 'why.'], function() {
            Route::get('/', [WhyController::class, 'index'])->name('index');
            Route::get('/create', [WhyController::class, 'create'])->name('create');
            Route::post('/store', [WhyController::class, 'store'])->name('store');
            Route::get('/edit/{why}', [WhyController::class, 'edit'])->name('edit');
            Route::post('/update/{why}', [WhyController::class, 'update'])->name('update');
            Route::get('/delete/{why}', [WhyController::class, 'delete'])->name('delete');
        });
        
        Route::group(['prefix' => 'career', 'as' => 'career.'], function() {
            Route::get('/', [CareerAdmin::class, 'index'])->name('index');
            Route::get('/create', [CareerAdmin::class, 'create'])->name('create');
            Route::post('/store', [CareerAdmin::class, 'store'])->name('store');
            Route::get('/edit/{career}', [CareerAdmin::class, 'edit'])->name('edit');
            Route::post('/update/{career}', [CareerAdmin::class, 'update'])->name('update');
            Route::get('/delete/{career}', [CareerAdmin::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'contact', 'as' => 'contact.'], function() {
            Route::get('/', [ContactController::class, 'index'])->name('index');
            Route::post('/store', [ContactController::class, 'store'])->name('store');
            Route::post('/update/{contact}', [ContactController::class, 'update'])->name('update');

            Route::group(['prefix' => 'form', 'as' => 'form.'], function() {
                Route::get('/', [ContactController::class, 'list'])->name('list');
                Route::get('/export', [ContactController::class, 'export'])->name('export');
            });
        });

        Route::group(['prefix' => 'preference', 'as' => 'preference.'], function() {
            Route::get('/', [PreferenceController::class, 'index'])->name('index');
            Route::post('/store', [PreferenceController::class, 'store'])->name('store');
            Route::post('/update/{preference}', [PreferenceController::class, 'update'])->name('update');
        });

    });
});

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/career', [CareerController::class, 'index'])->name('career');
Route::get('/{banner}/{slug}', [HomeController::class, 'spesifikasi'])->name('spesifikasi');
Route::get('/store', [HomeController::class, 'store'])->name('store');
