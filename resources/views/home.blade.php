<x-app-layout>
    <x-recipes-list :title="__('Top recipes')" :recipes="$top_recipes" />

    <x-recipes-list :title="__('New recipes')" :recipes="$new_recipes" />
</x-app-layout>
