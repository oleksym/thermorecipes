<div class="flex space-x-2 w-full border-b border-dashed">
    <div class="w-3/5">
        {{ $ingredient->name }}
    </div>

    <div class="w-1/5">
        {{ $ingredient->amount }}
    </div>

    <div class="w-1/5">
        {{ $ingredient->unit->name }}
    </div>
</div>