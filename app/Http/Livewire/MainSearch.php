<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MainSearch extends Component
{
    public $search = '';

    public function render()
    {
        $this->emit('usedMainSearch', $this->search);

        return view('livewire.main-search');
    }
}
