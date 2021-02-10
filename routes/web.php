<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipesController;
use App\Http\Livewire\RecipeEdition;
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

Route::get('/recipes/create', [RecipesController::class, 'create'])->middleware(['auth'])->name('recipes.create');
Route::get('/recipes/{recipe}/edit', RecipeEdition::class)->middleware(['auth'])->name('recipes.edit');
Route::get('/images/recipes/{recipe}/{dynamic_filename}', [RecipesController::class, 'showRecipeImage'])->middleware(['auth'])->name('recipes-images.show');

require __DIR__ . '/auth.php';
