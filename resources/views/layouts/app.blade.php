<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css?v=' . (\App::environment('prod') ? '101' : time())) }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js?v=' . (\App::environment('prod') ? '101' : time())) }}" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <livewire:main-search />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <livewire:alert-message />
                <livewire:main-search-results />

                {{ $slot }}
            </main>

            <footer class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200 text-center">
                            <div>Icons made by <a href="https://www.freepik.com" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        @livewireScripts

        <script>
function hideIngredients(obj) {
    var hints_box = $(obj).find('.ingredient-hints').html('');
}

function showIngredients(obj) {
    $(obj).find('.ingredient-hints').html('');
    $(obj).parents('.ingredient-group').find('.ingredient-input').map(function() {
        var id = $(this).data('id');
        var el = $('<button @click="$wire.addTag(' + id + ')" class="mr-2 inline-flex items-center px-2 py-1 bg-yellow-400 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" data-tag="[ingredient:' + $(this).data('id') + ']">' + $(this).val() + '</button>');
        $(obj).find('.ingredient-hints').append(el);
    });
}
</script>

    </body>
</html>
