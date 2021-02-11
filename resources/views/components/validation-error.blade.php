@props(['errors'])

@if ($errors)
    <div {{ $attributes }}>
        <div class="text-sm text-red-600">
            {{ $errors[0] }}
        </div>
    </div>
@endif
