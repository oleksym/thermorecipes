<div class="ingredient-group">
    <h2 class="text-xl">Ingredient group</h2>

    <div class="flex space-x-8">
        <div class="w-1/2">
            {{-- Title --}}
            <div>
                <x-label for="group.title" :value="__('Title')" />

                <x-input wire:model.lazy="group.title" class="block mt-1 w-full" type="text" :value="$group->title" />

                <x-validation-error class="mb-4" :errors="$errors->get('group.title')" />
            </div>

            {{-- Type --}}
            <div class="mt-4">
                <x-label for="group.type" :value="__('Type')" />

                <x-select wire:model.lazy="group.type" class="block mt-1 w-full">
                    <option></option>
                    @foreach (App\Models\IngredientGroup::GROUP_TYPES as $group_name => $group_value)
                        <option value="{{ $group_value }}">{{ $group_name }}</option>
                    @endforeach
                </x-select>

                <x-validation-error class="mb-4" :errors="$errors->get('group.type')" />
            </div>

            <div class="mt-4">
                <x-label for="group.description" :value="__('Description')" />

                <x-textarea wire:model.lazy="group.description" class="block mt-1 w-full">{{ $group->description }}</x-textarea>

                <x-validation-error class="mb-4" :errors="$errors->get('group.description')" />
            </div>

            <div class="mt-4">
                <span>Ingredients:</span>

                @foreach ($group->ingredients()->orderby('order', 'asc')->get() as $ingredient)
                    <livewire:ingredient-edition :ingredient="$ingredient" :key="'ingredient'.$ingredient->id" />
                @endforeach

                <div class="flex items-center justify-start mt-4">
                    <x-button type="button" wire:click.prevent="addNewIngredient" class="bg-red-400">
                        {{ __('Add ingredient') }}
                    </x-button>
                </div>
            </div>
        </div>

        <div class="w-1/2">
            <div class="flex items-center justify-end mt-4">
                <x-button type="button" wire:click.prevent="deleteGroup" class="bg-red-400">
                    {{ __('Delete group') }}
                </x-button>
            </div>

            <div class="mt-4">
                <span>Steps:</span>

                @foreach ($group->recipeSteps()->orderby('order', 'asc')->get() as $step)
                    <livewire:recipe-step-edition :step="$step" :key="'step'.$step->id" />
                @endforeach

                <div class="flex items-center justify-start mt-4">
                    <x-button type="button" wire:click.prevent="addNewStep" class="bg-red-400">
                        {{ __('Add step') }}
                    </x-button>
                </div>
            </div>
        </div>

    </div>

</div>
