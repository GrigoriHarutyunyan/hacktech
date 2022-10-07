<?php

use App\Http\Controllers\ShortLinkController;
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


Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/add-short-link', function () {
        return view('link.add-short-link');
    })->name('short-link');
    Route::get('/import-csv', function () {
        return view('link.import-csv');
    })->name('import');

    Route::controller(ShortLinkController::class)->group(function () {
        Route::post('link/store', 'store')->name('link.store');
        Route::get('/', 'index')->name('dashboard');
        Route::post('/import/csv', 'importCsv')->name('import.csv');
    });

    Route::get('/custom/{shortURLKey}', '\AshAllenDesign\ShortURL\Controllers\ShortURLController')->name('custom');
});
require __DIR__ . '/auth.php';
