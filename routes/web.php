<?php

use App\Http\Controllers\CareerApplicationController;
use App\Http\Controllers\ContactInquiryController;
use App\Http\Controllers\CoworkingInquiryController;
use App\Http\Controllers\PublicSiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicSiteController::class, 'home'])->name('home');
Route::get('/about', [PublicSiteController::class, 'about'])->name('about');
Route::get('/services', [PublicSiteController::class, 'services'])->name('services');
Route::get('/engagements', [PublicSiteController::class, 'engagements'])->name('engagements');
Route::get('/contact', [PublicSiteController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactInquiryController::class, 'store'])->name('contact.store');
Route::get('/careers', [PublicSiteController::class, 'careers'])->name('careers');
Route::get('/co-working', [PublicSiteController::class, 'coWorking'])->name('co-working');
Route::post('/co-working', [CoworkingInquiryController::class, 'store'])->name('co-working.store');
Route::get('/careers/{jobPosting}', [PublicSiteController::class, 'showCareer'])->name('careers.show');
Route::post('/careers/{jobPosting}/apply', [CareerApplicationController::class, 'store'])->name('careers.apply');
