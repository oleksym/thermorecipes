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
}
