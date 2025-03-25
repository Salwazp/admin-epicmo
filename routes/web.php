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
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MomentController;
use App\Http\Controllers\Admin\MomentButtonController;
use App\Http\Controllers\Admin\MediaYoutubeController;
use App\Http\Controllers\Admin\TitleRunningImageController;

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
        });

        Route::group(['prefix' => 'event', 'as' => 'event.'], function() {
            Route::get('/', [EventController::class, 'index'])->name('index');
            Route::get('/create', [EventController::class, 'create'])->name('create');
            Route::post('/store', [EventController::class, 'store'])->name('store');
            Route::get('/edit/{event}', [EventController::class, 'edit'])->name('edit');
            Route::post('/update/{event}', [EventController::class, 'update'])->name('update');
            Route::get('/delete/{event}', [EventController::class, 'delete'])->name('delete');

            Route::group(['prefix' => 'category', 'as' => 'category.'], function() {
                Route::get('/create', [EventCategoryController::class, 'create'])->name('create');
                Route::post('/store', [EventCategoryController::class, 'store'])->name('store');
                Route::get('/edit/{eventCategory}', [EventCategoryController::class, 'edit'])->name('edit');
                Route::post('/update/{eventCategory}', [EventCategoryController::class, 'update'])->name('update');
                Route::get('/delete/{eventCategory}', [EventCategoryController::class, 'delete'])->name('delete');
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

        Route::group(['prefix' => 'title_running_image', 'as' => 'title_running_image.'], function() {
            Route::get('/', [TitleRunningImageController::class, 'index'])->name('index');
            Route::get('/create', [TitleRunningImageController::class, 'create'])->name('create');
            Route::post('/store', [TitleRunningImageController::class, 'store'])->name('store');
            Route::get('/edit/{running_image}', [TitleRunningImageController::class, 'edit'])->name('edit');
            Route::post('/update/{running_image}', [TitleRunningImageController::class, 'update'])->name('update');
            Route::get('/delete/{running_image}', [TitleRunningImageController::class, 'delete'])->name('delete');
        });


        Route::group(['prefix' => 'gallery', 'as' => 'gallery.'], function() {
            Route::get('/', [GalleryController::class, 'index'])->name('index');
            Route::get('/create', [GalleryController::class, 'create'])->name('create');
            Route::post('/store', [GalleryController::class, 'store'])->name('store');
            Route::get('/edit/{gallery}', [GalleryController::class, 'edit'])->name('edit');
            Route::post('/update/{gallery}', [GalleryController::class, 'update'])->name('update');
            Route::get('/delete/{gallery}', [GalleryController::class, 'delete'])->name('delete');

            Route::group(['prefix' => 'image', 'as' => 'image.'], function() {
                Route::get('/create', [GalleryImageController::class, 'create'])->name('create');
                Route::post('/store', [GalleryImageController::class, 'store'])->name('store');
                Route::get('/edit/{gallery_image}', [GalleryImageController::class, 'edit'])->name('edit');
                Route::post('/update/{gallery_image}', [GalleryImageController::class, 'update'])->name('update');
                Route::get('/delete/{gallery_image}', [GalleryImageController::class, 'delete'])->name('delete');
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

        Route::group(['prefix' => 'media', 'as' => 'media.'], function() {
            Route::get('/', [MediaController::class, 'index'])->name('index');
            Route::get('/create', [MediaController::class, 'create'])->name('create');
            Route::post('/store', [MediaController::class, 'store'])->name('store');
            Route::get('/edit/{media}', [MediaController::class, 'edit'])->name('edit');
            Route::post('/update/{media}', [MediaController::class, 'update'])->name('update');
            Route::get('/delete/{media}', [MediaController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'media_youtube', 'as' => 'media_youtube.'], function() {
            Route::get('/', [MediaYoutubeController::class, 'index'])->name('index');
            Route::get('/create', [MediaYoutubeController::class, 'create'])->name('create');
            Route::post('/store', [MediaYoutubeController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [MediaYoutubeController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [MediaYoutubeController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [MediaYoutubeController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'moment', 'as' => 'moment.'], function() {
            Route::get('/', [MomentController::class, 'index'])->name('index');
            Route::get('/create', [MomentController::class, 'create'])->name('create');
            Route::post('/store', [MomentController::class, 'store'])->name('store');
            Route::get('/edit/{moment}', [MomentController::class, 'edit'])->name('edit');
            Route::post('/update/{moment}', [MomentController::class, 'update'])->name('update');
            Route::delete('/delete/{moment}', [MomentController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'button_moment', 'as' => 'button_moment.'], function() {
            Route::get('/', [MomentButtonController::class, 'index'])->name('index');
            Route::get('/create', [MomentButtonController::class, 'create'])->name('create');
            Route::post('/store', [MomentButtonController::class, 'store'])->name('store');
            Route::get('/edit/{moment}', [MomentButtonController::class, 'edit'])->name('edit');
            Route::post('/update/{moment}', [MomentButtonController::class, 'update'])->name('update');
            Route::delete('/delete/{moment}', [MomentButtonController::class, 'delete'])->name('delete');
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