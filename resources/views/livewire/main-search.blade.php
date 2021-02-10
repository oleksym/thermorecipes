<div>
    <x-input wire:model.debounce.500ms="search" class="block mt-1 w-full" type="text" :autofocus="!request()->routeIs('login', 'register', 'recipes.edit') ? true : false" placeholder="Search for..." />
</div>
