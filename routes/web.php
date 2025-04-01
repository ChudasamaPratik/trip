<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SliderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.pages.home');
});

Route::get('/about', function () {
    return view('frontend.pages.about');
})->name('about');

Route::get('/auctions', function () {
    return view('frontend.pages.auctions');
})->name('auctions');

Route::get('/tips-and-travels', function () {
    return view('frontend.pages.tips-and-travels');
})->name('tips-and-travels');

Route::get('/bid-on-travel', function () {
    return view('frontend.pages.bid-on-travel');
})->name('bid-on-travel');


Route::get('/faq', function () {
    return view('frontend.pages.faq');
})->name('faq');

Route::get('/contact-us', function () {
    return view('frontend.pages.contact-us');
})->name('contact-us');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/admin/dashboard', function () {
    return view('backend.pages.admin_dashboard');
})->name('admin.dashboard');

Route::get('/user/dashboard', function () {
    return view('backend.pages.user_dashboard');
})->name('user.dashboard');

Route::get('/agent/dashboard', function () {
    return view('backend.pages.agent_dashboard');
})->name('agent.dashboard');
















Route::prefix('admin')->group(function () {
    //Permission
    Route::resource('permissions', PermissionController::class)->only(['index', 'store', 'update']);

    //Role
    Route::resource('roles', RoleController::class)->only(['index', 'store', 'update']);

    //Slider
    Route::get('slider', [SliderController::class, 'sliderIndex'])->name('slider.index');
    Route::get('slider/create', [SliderController::class, 'sliderCreate'])->name('slider.create');
    Route::post('slider/', [SliderController::class, 'sliderStore'])->name('slider.store');
    Route::get('slider/{id}/edit', [SliderController::class, 'sliderEdit'])->name('slider.edit');
    Route::put('slider/{id}', [SliderController::class, 'sliderUpdate'])->name('slider.update');
    Route::delete('slider/{id}/delete', [SliderController::class, 'sliderDelete'])->name('slider.delete');
    Route::post('slider/change-status/{id}', [SliderController::class, 'changeStatus'])->name('slider.change.status');

    //About
    Route::get('about', [AboutController::class, 'index'])->name('about.index');
    Route::get('about/create', [AboutController::class, 'Create'])->name('about.create');
    Route::post('about/', [AboutController::class, 'Store'])->name('about.store');
    Route::get('about/{id}/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about/{id}', [AboutController::class, 'update'])->name('about.update');
    Route::delete('about/{id}/delete', [AboutController::class, 'delete'])->name('about.delete');
    Route::post('about/change-status/{id}', [AboutController::class, 'changeStatus'])->name('about.change.status');
});
