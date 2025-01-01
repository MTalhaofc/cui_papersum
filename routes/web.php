<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PastPaperController;
use App\Http\Controllers\FileController;
use App\Providers\AzureBlobStorageServiceProvider;

use App\Http\Controllers\DepartmentController;


Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('throttle:2,1');
    Route::get('register', [AuthController::class, 'register_view'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register')->middleware('throttle:2,1');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [AuthController::class, 'home'])->name('home');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('pastpapers/createpaper', [PastPaperController::class, 'create'])->name('pastpapers.createpaper');
    Route::post('pastpapers', [PastPaperController::class, 'store'])->name('pastpapers.store');
    Route::get('pastpapers/{pastpaper}/edit', [PastPaperController::class, 'edit'])->name('pastpapers.edit');
    Route::put('pastpapers/{pastpaper}', [PastPaperController::class, 'update'])->name('pastpapers.update');
    Route::delete('pastpapers/{pastpaper}', [PastPaperController::class, 'destroy'])->name('pastpapers.destroy');
Route::delete('pastpapers/{pastpaper}/images/{image}', [PastPaperController::class, 'deleteImage'])->name('pastpapers.delete_image');
Route::get('/pastpapersshow_home', [PastPaperController::class, 'pastPapersShow'])->name('pastpapersshow_home');


});

Route::get('/', [PastPaperController::class, 'index'])->name('landing');
Route::get('pastpapers/{pastpaper}', [PastPaperController::class, 'show'])->name('pastpapers.show');
// Route::get('pastpapers/{pastpaper}/download', [PastPaperController::class, 'download'])->name('pastpapers.download'); // Add this line
// Route::get('/pastpapers/{pastpaper}/download', [PastPaperController::class, 'download'])->name('pastpapers.download');
Route::get('/images/{image}/download', [PastPaperController::class, 'downloadImage'])->name('images.download');
Route::resource('pastpapers', PastPaperController::class);
Route::get('/download/{file_path}', [PastPaperController::class, 'download'])->name('download');



Route::get('/departments/{department}', [DepartmentController::class, 'show'])->name('departments.show');
Route::get('/pastpapersearch', [PastPaperController::class, 'search'])->name('pastpapersshow');

Route::get('/pastpapers/department/{department}', [PastPaperController::class, 'indexByDepartment'])->name('pastpapers.indexbydepartment');
// Route::get('/download', [PastPaperController::class, 'download'])->name('download');
