<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Recipie;

class RecipieEdition extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    public $recipie;
    public $image;
    public $delete_image_flag = false;

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

    public function mount(Recipie $recipie)
    {
        $this->authorize('update', $recipie);

        $this->recipie = $recipie;
    }

    public function deleteFutureImage()
    {
        $this->image = null;
    }

    public function deleteImage()
    {
        $this->delete_image_flag = true;
    }

    public function save()
    {
        $this->validate();
        if ($this->delete_image_flag) {
            $this->recipie->deleteImage();
            $this->delete_image_flag = false;
        }
        $this->recipie->saveImage($this->image);
        $this->recipie->save();
        $this->image = null;
        $this->emit('sendAlert', 'success', __('Saved'));
    }

    public function render()
    {
        return view('livewire.recipie-edition');
    }
}
