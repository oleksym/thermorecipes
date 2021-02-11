<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecipeStep extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $description_parser;

    public function ingredientGroup()
    {
        return $this->belongsTo(IngredientGroup::class);
    }

    public function getParsedDescription()
    {
        $text = $this->description;

        foreach (app('RecipeStepParser') as $parser_class) {
            $parser = new $parser_class($this);
            $text = $parser->parse($text);
        }

        return $text;
    }
}
