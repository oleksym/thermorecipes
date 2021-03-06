<div>
    <form wire:submit.prevent="save" id="recipe-form">

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <div class="flex space-x-8">
                            <div class="w-1/2">
                                {{-- Title --}}
                                <div>
                                    <x-label for="title" :value="__('Title')" />

                                    <x-input wire:model.lazy="recipe.title" id="title" class="block mt-1 w-full" type="text" :value="$recipe->title" autofocus />

                                    <x-validation-error class="mb-4" :errors="$errors->get('recipe.title')" />
                                </div>

                                {{-- Language --}}

                                {{-- Duration --}}
                                <div class="mt-4">
                                    <x-label for="duration" :value="__('Duration')" />

                                    <x-input wire:model.lazy="recipe.duration" id="duration" class="block mt-1 w-full" type="text" :value="$recipe->duration" placeholder="(in minutes)" />

                                    <x-validation-error class="mb-4" :errors="$errors->get('recipe.duration')" />
                                </div>

                                {{-- Source --}}
                                <div class="mt-4">
                                    <x-label for="source" :value="__('Source')" />

                                    <x-input wire:model.lazy="recipe.source" id="source" class="block mt-1 w-full" type="text" :value="$recipe->source" placeholder="https://... or name of cook book or other" />

                                    <x-validation-error class="mb-4" :errors="$errors->get('recipe.source')" />
                                </div>

                                {{-- Difficulty --}}
                                <div class="mt-4">
                                    <x-label for="difficulty" :value="__('Difficulty')" />

                                    <x-select wire:model.lazy="recipe.difficulty" id="difficulty" class="block mt-1 w-full">
                                        <option></option>
                                        @foreach (App\Models\Recipe::DIFFICULTY_LEVELS as $difficulty_name => $difficulty_value)
                                            <option value="{{ $difficulty_value }}">{{ $difficulty_name }}</option>
                                        @endforeach
                                    </x-select>

                                    <x-validation-error class="mb-4" :errors="$errors->get('recipe.difficulty')" />
                                </div>
                            </div>

                            <div class="w-1/2">

                                <div class="flex items-center justify-end mt-4">
                                    @if ($recipe->published_at)
                                        <x-button type="button" wire:click.prevent="unpublish" class="bg-red-400">
                                            {{ __('Unpublish') }}
                                        </x-button>
                                    @else
                                        <x-button type="button" wire:click.prevent="publish" class="bg-red-400">
                                            {{ __('Publish') }}
                                        </x-button>
                                    @endif
                                </div>

                                {{-- Image --}}
                                <div class="mt-4">
                                    <x-label for="image" :value="__('Image')" />

                                    <x-input wire:model="image" id="image" class="mt-1 w-full" type="file" />
                                    @if ($image)
                                        <img src="{{ $image->temporaryUrl() }}">
                                        <x-button type="button" class="bg-red-400" wire:click.prevent="deleteFutureImage">delete temporary image</x-button>
                                    @elseif (!$delete_image_flag && $recipe->image_filename)
                                        <img src="{{ $recipe->getImageUrl() }}">
                                        <x-button type="button" class="bg-red-400" wire:click.prevent="deleteImage">delete image</x-button>
                                    @endif

                                    <x-validation-error class="mb-4" :errors="$errors->get('image')" />
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="mt-4">
                            <x-label for="description" :value="__('Description')" />

                            <x-textarea wire:model.lazy="recipe.description" id="description" class="block mt-1 w-full">{{ $recipe->description }}</x-textarea>

                            <x-validation-error class="mb-4" :errors="$errors->get('recipe.description')" />
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- ingredient groups --}}
    @foreach ($recipe->ingredientGroups()->whereNotIn('id', $temporary_deleted_groups)->orderby('order', 'asc')->get() as $ingredient_group)
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <livewire:ingredient-group-edition :group="$ingredient_group" :key="'group'.$ingredient_group->id" />
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex items-center justify-start mt-4">
                <x-button type="button" wire:click.prevent="addNewIngredientGroup" class="bg-red-400">
                    {{ __('Add ingredient group') }}
                </x-button>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3" form="recipe-form">
                    {{ __('Save') }}
                </x-button>
            </div>
        </div>
    </div>

</div>
