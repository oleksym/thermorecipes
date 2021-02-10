<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\IngredientGroup;
use App\Models\Ingredient;

class IngredientGroupEdition extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'saveGroup' => 'save'
    ];
    public $group;

    public function rules()
    {
        return [
            'group.title' => 'nullable|max:255',
            'group.type' => 'nullable|in:' . collect(IngredientGroup::GROUP_TYPES)->values()->implode(','),
            'group.description' => 'nullable|max:4000',
        ];
    }

    public function updated($prop, $value)
    {
        $this->validateOnly($prop);
    }

    public function mount(IngredientGroup $group)
    {
        $this->authorize('update', $group->recipie);

        $this->group = $group;
    }

    public function addNewIngredient()
    {
        $ingredient = new Ingredient();
        $ingredient->order = $this->group->ingredients()->max('order') + 1;
        $this->group->ingredients()->save($ingredient);
    }

    public function deleteGroup()
    {
        $this->emitTo('recipie-edition', 'deleteGroup', $this->group);
    }

    public function save()
    {
        $this->group->type = $this->group->type == '' ? null : $this->group->type;
        $this->validate();
        $this->group->save();
    }

    public function render()
    {
        return view('livewire.ingredient-group-edition');
    }
}
