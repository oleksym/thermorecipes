<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecipeStep extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function ingredientGroup()
    {
        return $this->belongsTo(IngredientGroup::class);
    }
}
