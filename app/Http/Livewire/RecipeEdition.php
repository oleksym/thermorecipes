<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\IngredientGroup;
use App\Models\RecipeStep;

class RecipeEdition extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    protected $listeners = [
        'deleteGroup' => 'deleteGroup',
        'deleteIngredient' => 'deleteIngredient',
        'deleteStep' => 'deleteStep',
    ];
    public $recipe;
    public $image;
    public $delete_image_flag = false;
    public $temporary_deleted_groups = [];
    public $temporary_deleted_ingredients = [];
    public $temporary_deleted_steps = [];

    public function rules()
    {
        return [
            'recipe.title' => 'nullable|max:255',
            'recipe.duration' => 'nullable|numeric|min:0|max:10000',
            'recipe.source' => 'nullable|max:2048',
            'recipe.difficulty' => 'nullable|in:' . collect(Recipe::DIFFICULTY_LEVELS)->values()->implode(','),
            'image' => 'nullable|image|max:4096',
            'recipe.description' => 'nullable|max:4000',
        ];
    }

    public function mount(Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        $this->recipe = $recipe;
    }

    public function updatedRecipeDuration($value)
    {
        $this->recipe->duration = $value ?: null;
    }

    public function updatedRecipeDifficulty($value)
    {
        $this->recipe->difficulty = $value ?: null;
    }

    public function updated($prop, $value)
    {
        $this->validateOnly($prop);
    }

    public function deleteGroup(IngredientGroup $group)
    {
        array_push($this->temporary_deleted_groups, $group->id);
    }

    public function deleteIngredient(Ingredient $ingredient)
    {
        array_push($this->temporary_deleted_ingredients, $ingredient->id);
    }

    public function deleteStep(RecipeStep $step)
    {
        array_push($this->temporary_deleted_steps, $step->id);
    }

    public function deleteFutureImage()
    {
        $this->image = null;
    }

    public function deleteImage()
    {
        $this->delete_image_flag = true;
    }
    public function unpublish()
    {
        $this->validate();
        $this->recipe->published_at = null;
        $this->recipe->save();
    }

    public function publish()
    {
        $this->validate();
        $this->recipe->published_at = now();
        $this->recipe->save();
    }

    public function save()
    {
        $this->validate();
        if ($this->delete_image_flag) {
            $this->recipe->deleteImage();
            $this->delete_image_flag = false;
        }
        $this->recipe->ingredientGroups()->whereIn('id', $this->temporary_deleted_groups)->delete();
        $this->recipe->ingredients()->whereIn(\DB::raw('ingredients.id'), $this->temporary_deleted_ingredients)->delete();
        $this->recipe->steps()->whereIn(\DB::raw('recipe_steps.id'), $this->temporary_deleted_steps)->delete();

        $this->recipe->saveImage($this->image);
        $this->recipe->save();
        $this->image = null;
        $this->emit('saveGroup');
        $this->emit('saveIngredient');
        $this->emit('saveStep');
        $this->emit('sendAlert', 'success', __('Saved'));
    }

    public function addNewIngredientGroup()
    {
        $group = new IngredientGroup();
        $group->order = $this->recipe->ingredientGroups()->max('order') + 1;
        $this->recipe->ingredientGroups()->save($group);
    }

    public function render()
    {
        return view('livewire.recipe-edition');
    }
}
