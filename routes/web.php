<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, "index"])->name("home");
Route::get('/kawasan', [App\Http\Controllers\HomeController::class, "kawasan"])->name("kawasan");
Route::get('/cobaDjitra', [App\Http\Controllers\HomeController::class, "cobaDjitra"])->name("cobaDjitra");
Route::get('/itkimap', [App\Http\Controllers\HomeController::class, "itkimap"])->name("itkimap");

Route::get('peta', function () {
  $path = storage_path('app/public/PETA SOETOMO.png');

  $file = File::get($path);
  $type = File::mimeType($path);
  $response = Response::make($file, 200);
  $response->header("Content-Type", $type);
  return $response;
})->name('peta');

Route::get('peta-kawasan', function () {
    $path = storage_path('app/public/LAYOUT KAWASAN-Model_1.jpg');

    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
  })->name('peta-kawasan');

Route::get('itki1', function () {
    $path = storage_path('app/public/TRIAL 1 - ITKI Lt 1.png');

    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
  })->name('itki1');

  Route::get('itki2', function () {
    $path = storage_path('app/public/TRIAL 1 - ITKI LT 2.png');

    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
  })->name('itki2');
