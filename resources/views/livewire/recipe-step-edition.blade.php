<div>
    <div class="md:flex md:space-x-2 w-full" x-data="{ show: true }" x-show="show">
        <div class="md:w-10/12">
            <x-textarea wire:model.lazy="step.description" id="step.description" class="block mt-1 w-full" :placeholder="__('Step description')">{{ $step->description }}</x-textarea>

            <x-validation-error class="mb-4" :errors="$errors->get('step.description')" />
        </div>

        <div class="md:w-1/6">
            <x-button type="button" wire:click.prevent="deleteStep" class="mt-2 bg-red-400" @click="show = false">
                {{ __('X') }}
            </x-button>
        </div>
    
    </div>
</div>
