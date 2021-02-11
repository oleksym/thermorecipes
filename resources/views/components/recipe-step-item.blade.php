@props(['step', 'iteration'])

<div class="flex space-x-2 w-full mb-4 border-b border-dashed" {{ $attributes }}>
    <div class="w-1/12">
        {{ $iteration }}
    </div>

    <div class="w-11/12">
        {!! $step->getParsedDescription() !!}
    </div>
</div>