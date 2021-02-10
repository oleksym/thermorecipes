@props(['recipe'])

<div {{ $attributes->merge(['class' => 'rounded-lg border-b border-l border-r hover:bg-gray-200 ' . ($recipe->published_at ? '' : 'opacity-60')]) }}>
    <a href="{{ $recipe->preview_route }}"><img src="{{ $recipe->getImageUrl() }}" class="rounded-t-lg" title="{{ $recipe->title }}" alt="{{ $recipe->title }}"></a>
    <div class="px-2 py-2">
        <h3 class="text-xl font-bold"><a href="{{ $recipe->preview_route }}">{{ $recipe->title ?? __('Untitled') }}</a></h3>
        <div>Duration: {{ $recipe->duration }} {{ __('min') }}</div>
        <div>Difficulty: {{ $recipe->difficulty_name }}</div>
        @if (!$recipe->published_at)
            <div class="text-red-500">{{ __('Unpublished') }}</div>
        @endif

        @can('update', $recipe)
            <div class="text-right">
                <a href="{{ $recipe->edit_route }}" class="text-red-500 hover:underline">edit</a>
            </div>
        @endcan
    </div>
</div>