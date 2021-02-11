<?php

namespace App\Library\RecipeStepParser;
use App\Models\RecipeStep;

interface ParserContract
{
    public function __construct(RecipeStep $recipe_step);
    public function parse(?string $text);
}
