<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Recipie;
use App\Models\IngredientGroup;

class RecipieEdition extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    protected $listeners = [
        'deleteGroup' => 'deleteGroup',
        'deleteIngredient' => 'deleteIngredient',
    ];
    public $recipie;
    public $image;
    public $delete_image_flag = false;
    public $temporary_deleted_groups = [];
    public $temporary_deleted_ingredients = [];

    public function rules()
    {
        return [
            'recipie.title' => 'nullable|max:255',
            'recipie.duration' => 'nullable|numeric|min:0|max:10000',
            'recipie.source' => 'nullable|max:2048',
            'recipie.difficulty' => 'nullable|in:' . collect(Recipie::DIFFICULTY_LEVELS)->values()->implode(','),
            'image' => 'nullable|image|max:4096',
            'recipie.description' => 'nullable|max:4000',
        ];
    }

    public function mount(Recipie $recipie)
    {
        $this->authorize('update', $recipie);

        $this->recipie = $recipie;
    }

    public function updatedRecipieDuration($value)
    {
        $this->recipie->duration = $value ?: null;
    }

    public function updatedRecipieDifficulty($value)
    {
        $this->recipie->difficulty = $value ?: null;
    }

    public function updated($prop, $value)
    {
        $this->validateOnly($prop);
    }

    public function deleteGroup($group)
    {
        array_push($this->temporary_deleted_groups, $group['id']);
    }

    public function deleteIngredient($ingredient)
    {
        array_push($this->temporary_deleted_ingredients, $ingredient['id']);
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
        $this->recipie->published_at = null;
        $this->recipie->save();
    }

    public function publish()
    {
        $this->validate();
        $this->recipie->published_at = now();
        $this->recipie->save();
    }

    public function save()
    {
        $this->validate();
        if ($this->delete_image_flag) {
            $this->recipie->deleteImage();
            $this->delete_image_flag = false;
        }
        $this->recipie->ingredientGroups()->whereIn('id', $this->temporary_deleted_groups)->delete();
        $this->recipie->ingredients()->whereIn(\DB::raw('ingredients.id'), $this->temporary_deleted_ingredients)->delete();

        $this->recipie->saveImage($this->image);
        $this->recipie->save();
        $this->image = null;
        $this->emit('saveGroup');
        $this->emit('saveIngredient');
        $this->emit('sendAlert', 'success', __('Saved'));
    }

    public function addNewIngredientGroup()
    {
        $group = new IngredientGroup();
        $group->order = $this->recipie->ingredientGroups()->max('order') + 1;
        $this->recipie->ingredientGroups()->save($group);
    }

    public function render()
    {
        return view('livewire.recipie-edition');
    }
}
