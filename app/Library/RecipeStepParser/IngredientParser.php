<?php

namespace App\Library\RecipeStepParser;
use App\Models\RecipeStep;

class IngredientParser implements ParserContract
{
    const TAG = '[ingredient:__INGREDIENT_ID__]';

    protected $recipe_step;

    public function __construct(RecipeStep $recipe_step)
    {
        $this->recipe_step = $recipe_step;
    }

    public function parse(?string $text): string
    {
        if (is_null($text)) {
            return '';
        }
    
        $ingredients = $this->recipe_step->ingredientGroup->ingredients()->with('unit')->get();
        foreach ($ingredients as $ing) {
            $tag = str_replace('__INGREDIENT_ID__', $ing->id, self::TAG);
            $text = str_ireplace($tag, '<span class="inline-block px-1 bg-red-500 text-white"> ' . $ing->name . ' (' . $ing->amount . ' ' . $ing->unit->name . ')</span>', $text);
        }

        return preg_replace('/' . str_replace('__INGREDIENT_ID__', '(\d+)', preg_quote(self::TAG, '/')) . '/i', '', $text);
    }
}
