<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Recipe;

class MainSearchResults extends Component
{
    protected $listeners = ['usedMainSearch' => 'search'];

    public $query = '';
    public $recipes = [];

    public function search($query)
    {
        $this->query = $query;
        $this->recipes = Recipe::whereNotNull('published_at')->where('title', 'like', '%' . $this->query . '%')->limit(20)->get();
    }
    public function render()
    {
        if (!$this->query) {
            return '<div></div>';
        }
        return view('livewire.main-search-results');
    }
}
