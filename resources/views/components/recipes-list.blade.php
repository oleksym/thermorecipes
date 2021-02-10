@props(['recipes', 'title' => 'Recipes'])

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h1 class="text-3xl mb-10">{{ $title }}</h1>
                <div class="grid gap-x-8 gap-y-4 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5">
                    @foreach ($recipes as $recipe)
                        <x-recipe-list-item :recipe="$recipe" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>