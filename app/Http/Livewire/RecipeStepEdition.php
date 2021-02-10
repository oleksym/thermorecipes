<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\RecipeStep;

class RecipeStepEdition extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'saveStep' => 'save'
    ];

    public $step;

    public function rules()
    {
        return [
            'step.description' => 'nullable|max:4000',
        ];
    }

    public function mount(RecipeStep $step)
    {
        $this->authorize('update', $step->ingredientGroup->recipe);

        $this->step = $step;
    }

    public function updated($prop, $value)
    {
        $this->validateOnly($prop);
    }

    public function deleteStep()
    {
        $this->emitTo('recipe-edition', 'deleteStep', $this->step);
    }

    public function addTag($id)
    {
        $this->step->description .= " [ingredient:{$id}]";
    }

    public function save()
    {
        $this->validate();
        $this->step->save();
    }

    public function render()
    {
        return view('livewire.recipe-step-edition');
    }
}
