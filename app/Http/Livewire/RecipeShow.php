<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Recipe;

class RecipeShow extends Component
{
    public $recipe;

    public function mount(Recipe $recipe_full)
    {
        $this->recipe = $recipe_full;
    }

    public function render()
    {
        return view('livewire.recipe-show');
    }
}
