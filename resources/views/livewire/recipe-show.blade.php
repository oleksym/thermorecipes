<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="md:flex md:space-x-8 mb-6">
                        <div class="md:w-5/6">
                            <h1 class="text-3xl">{{ $recipe->title }}</h1>
                        </div>
                        <div class="md:w-1/6">
                            @can('update', $recipe)
                                <div class="text-right">
                                    @if (!$recipe->published_at)
                                        <div class="text-red-500 mb-4">{{ __('Unpublished') }}</div>
                                    @endif
                                    <a href="{{ $recipe->edit_route }}" class="text-red-500 hover:underline">edit</a>
                                </div>
                            @endcan
                        </div>
                    </div>

                    <div class="md:flex md:space-x-8">
                        <div class="md:w-1/2">
                            <div>Source: {{ $recipe->source }}</div>
                            <div>Duration: {{ $recipe->duration ? "{$recipe->duration} " . __('min') : '-' }}</div>
                            <div>Difficulty: {{ $recipe->difficulty_name }}</div>
                            
                            @if ($recipe->description)
                                <div class="mt-6 py-6 border-t border-dashed">{{ $recipe->description }}</div>
                            @endif

                            @foreach ($recipe->ingredientGroups as $group)
                            <div class="mt-6 py-6 border-t border-dashed">
                                <h4 class="text-lg mb-2 font-bold">{{ $group->title }}</h4>
                                <p>{{ $group->description }}</p>

                                @if ($group->ingredients->isNotEmpty())
                                    <div class="font-bold mt-4">{{ __('Ingredients') }}</div>
                                    @foreach ($group->ingredients as $ingredient)
                                        <x-ingredient-item :ingredient="$ingredient" />
                                    @endforeach
                                @endif

                                @if ($group->recipeSteps->isNotEmpty())
                                    <div class="font-bold mt-4">{{ __('Steps') }}</div>
                                    @foreach ($group->recipeSteps as $step)
                                        <x-recipe-step-item :step="$step" :iteration="$loop->iteration" />
                                    @endforeach
                                @endif
                            </div>
                            @endforeach

                        </div>

                        <div class="md:w-1/2">
                            @if ($recipe->getImageUrl())
                                <img src="{{ $recipe->getImageUrl() }}" title="{{ $recipe->title }}" alt="{{ $recipe->title }}">
                            @else
                                <div class="hidden md:block">
                                    <x-application-logo class="opacity-50 w-1/3 mx-auto" />
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
