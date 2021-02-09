<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipiesController;
use App\Http\Livewire\RecipieEdition;
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
    return view('home');
})->name('home');

Route::get('/1', function () {
    // TODO
})->name('tmp');

Route::get('/recipies/create', [RecipiesController::class, 'create'])->middleware(['auth'])->name('recipies.create');
Route::get('/recipies/{recipie}/edit', RecipieEdition::class)->middleware(['auth'])->name('recipies.edit');
Route::get('/images/recipies/{recipie}/{dynamic_filename}', [RecipiesController::class, 'showRecipieImage'])->middleware(['auth'])->name('recipies-images.show');

require __DIR__ . '/auth.php';
