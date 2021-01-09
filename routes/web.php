<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ConsumptionController;

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
Route::get('/clear-cache', function () {
    try {
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('config:cache');
        return 'DONE'; //Return anything
    } catch (Throwable $th) {
        //throw $th;
    }
});

Route::get('storage/{folder}/{filename}', function ($folder, $filename) {
    try {
        $path = storage_path() . '/app/' . $folder . '/' . $filename;

        //si no se encuentra lanzamos un error 404.
        if (!Storage::exists($folder . '/' . $filename)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
});

Route::middleware(['auth:sanctum', 'verified'])->get('/', [TruckController::class, "index"])->name('dashboard');

Route::get('trucks/preview/{id}', [TruckController::class, 'preview'])->name('trucks.preview');
Route::post('trucks/datatable', [TruckController::class, 'datatable'])->name('trucks.datatables');
Route::resource('trucks', TruckController::class)->middleware(['auth:sanctum', 'verified']);

Route::post('consumptions/datatable', [ConsumptionController::class, 'datatable'])->name('consumptions.datatables');
Route::resource('consumptions', ConsumptionController::class)->middleware(['auth:sanctum', 'verified']);

Route::resource('posts', PostController::class)->middleware(['auth:sanctum', 'verified']);

Route::resource('contacts', ContactController::class);
Route::get('contacto', function () {
    return view('emails.contact');
});



