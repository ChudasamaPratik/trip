<?php

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


Route::get('/admin', function () {
    return view('backend.pages.admin_dashboard');
})->name('admin.dashboard');

Route::get('/user', function () {
    return view('backend.pages.user_dashboard');
})->name('user.dashboard');

Route::get('/agent', function () {
    return view('backend.pages.agent_dashboard');
})->name('agent.dashboard');
