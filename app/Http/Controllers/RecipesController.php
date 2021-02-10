<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Auth;

class RecipesController extends Controller
{
    public function create(Request $request)
    {
        $recipe = new Recipe();
        $request->user()->recipes()->save($recipe);

        return redirect()->to($recipe->edit_route);
    }

    public function showRecipeImage(Recipe $recipe, $dynamic_filename)
    {
        ($recipe->image_filename && $recipe->makeDynamicImageFilename() == $dynamic_filename) || abort(404);

        return $recipe->getImageContent();
    }

    public function home(Request $request)
    {
        return view('home', [
            'top_recipes' => [],// TODO
            'new_recipes' => Recipe::whereNotNull('published_at')->orderby('created_at', 'desc')->limit(10)->get(),
        ]);
    }

    public function indexMy(Request $request)
    {
        return view('recipes', [
            'title' => 'My recipes',
            'recipes' => Recipe::where('user_id', $request->user()->id)->get(),
        ]);
    }

    public function index(Request $request)
    {
        return view('recipes', [
            'title' => 'All recipes',
            'recipes' => Recipe::whereNotNull('published_at')->get(),
        ]);
    }
}
