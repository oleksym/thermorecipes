<div>
    <div class="md:flex md:space-x-2 w-full" x-data="{ show: true }" x-show="show">
        <div class="md:w-1/2">
            <x-input wire:model.lazy="ingredient.name" id="ingredient.name" class="block mt-1 w-full" type="text" :value="$ingredient->name" :placeholder="__('Ingredient')" />

            <x-validation-error class="mb-4" :errors="$errors->get('ingredient.name')" />
        </div>

        <div class="md:w-2/6">
            <x-input wire:model.lazy="ingredient.amount" id="ingredient.amount" class="block mt-1 w-full" type="text" :value="$ingredient->amount" :placeholder="__('Amount')" />

            <x-validation-error class="mb-4" :errors="$errors->get('ingredient.amount')" />
        </div>

        <div class="md:w-3/6">
            <x-select wire:model.lazy="ingredient.unit_id" id="ingredient.unit_id" class="block mt-1 w-full" type="text" :value="$ingredient->unit_id">
                <option></option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                @endforeach
            </x-select>

            <x-validation-error class="mb-4" :errors="$errors->get('ingredient.unit_id')" />
        </div>

        <div class="md:w-1/6">
            <x-button type="button" wire:click.prevent="deleteIngredient" class="mt-2 bg-red-400" @click="show = false">
                {{ __('X') }}
            </x-button>
        </div>
    
    </div>
</div>
