<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Ingredient;
use App\Models\Unit;

class IngredientEdition extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'saveIngredient' => 'save'
    ];

    public $ingredient;

    public function rules()
    {
        return [
            'ingredient.name' => 'nullable|max:255',
            'ingredient.amount' => 'nullable|max:255',
            'ingredient.unit_id' => 'nullable|exists:units,id',
            'ingredient.description' => 'nullable|max:4000',
        ];
    }

    public function mount(Ingredient $ingredient)
    {
        $this->authorize('update', $ingredient->ingredientGroup->recipie);

        $this->ingredient = $ingredient;
    }

    public function updated($prop, $value)
    {
        $this->validateOnly($prop);
    }

    public function deleteIngredient()
    {
        $this->emitTo('recipie-edition', 'deleteIngredient', $this->ingredient);
    }

    public function save()
    {
        $this->ingredient->unit_id = $this->ingredient->unit_id == '' ? null : $this->ingredient->unit_id;
        $this->validate();
        $this->ingredient->save();
    }

    public function render()
    {
        return view('livewire.ingredient-edition', [
            'units' => Unit::all(),
        ]);
    }
}
