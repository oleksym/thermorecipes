<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipie;
use Auth;

class RecipiesController extends Controller
{
    public function create(Request $request)
    {
        $recipie = new Recipie();
        $request->user()->recipies()->save($recipie);

        return redirect()->to($recipie->edit_route);
    }

    public function showRecipieImage(Recipie $recipie, $dynamic_filename)
    {
        ($recipie->image_filename && $recipie->makeDynamicImageFilename() == $dynamic_filename) || abort(404);

        return $recipie->getImageContent();
    }
}
