<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function ingredientGroup()
    {
        return $this->belongsTo(IngredientGroup::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class)->withDefault();
    }
}
