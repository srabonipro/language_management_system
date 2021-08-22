<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('set-language/{code}', [LanguageController::class, 'changeLanguage'])->name('language.change');

Route::resource('language', LanguageController::class);
Route::get('lang/{language}', [LanguageController::class, 'langView'])->name('language.view');
Route::post('translation/update', [LanguageController::class, 'transUpdate'])->name('translation.update');
Route::get('set-language/{code}', [LanguageController::class, 'setLanguage'])->name('set.language');

// Route::get('test', function () {
//     app()->setLocale('bn');

//     if (app()->isLocale('bn')) {
//         dd(app()->getLocale());
//     } else {
//         dd('something else');
//     }
// });
