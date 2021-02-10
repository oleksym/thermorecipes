<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IngredientGroup extends Model
{
    use HasFactory;
    use SoftDeletes;

    const GROUP_TYPES = [
        'OTHER' => 0,
        'DOUGH' => 1,
        'CREAM' => 2,
        'SAUCE' => 3,
    ];

    public function recipie()
    {
        return $this->belongsTo(Recipie::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
