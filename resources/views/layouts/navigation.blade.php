<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" class="hidden lg:flex text-2xl font-bold">
                        {{ config('app.name') }}
                    </x-nav-link>

                    <x-nav-link :href="route('recipes.index')" class="text-xl" :active="request()->routeIs('recipes.index')">
                        {{ __('All recipes') }}
                    </x-nav-link>

                    {{-- <x-nav-link :href="route('tmp')" class="text-xl" :active="request()->routeIs('tmp')">
                        {{ __('Top recipes') }}
                    </x-nav-link>

                    <x-nav-link :href="route('tmp')" class="text-xl" :active="request()->routeIs('tmp')">
                        {{ __('New recipes') }}
                    </x-nav-link> --}}
                </div>
            </div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <div class="hidden space-x-4 lg:-my-px lg:ml-10 sm:flex mr-6">
                        <x-nav-link :href="route('recipes.index.my')" class="hidden xl:flex text-xl" :active="request()->routeIs('recipes.index.my')">
                            {{ __('My recipes') }}
                        </x-nav-link>

                        <x-nav-link :href="route('recipes.create')" class="hidden xl:flex text-xl" :active="request()->routeIs('recipes.create')">
                            {{ __('Add new') }}
                        </x-nav-link>

{{--                         <x-nav-link :href="route('tmp')" class="text-xl" :active="request()->routeIs('tmp')">
                            {{ __('Lang') }}
                        </x-nav-link> --}}
                    </div>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div class="text-xl">{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('recipes.index.my')" class="block xl:hidden text-xl">{{ __('My recipes') }}</x-dropdown-link>
                                <x-dropdown-link :href="route('recipes.create')" class="block xl:hidden text-xl">{{ __('Add new') }}</x-dropdown-link>

                                {{-- <x-dropdown-link :href="route('logout')" class="text-xl">{{ __('Profile') }}</x-dropdown-link> --}}

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();" class="text-xl">
                                    {{ __('Logout') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

                @guest
                    <div class="hidden space-x-4 lg:-my-px lg:ml-10 sm:flex mr-6">
                        <x-nav-link :href="route('login')" class="text-xl" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>

                        <x-nav-link :href="route('register')" class="text-xl" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-nav-link>

                        {{-- <x-nav-link :href="route('tmp')" class="text-xl" :active="request()->routeIs('tmp')">
                            {{ __('Lang') }}
                        </x-nav-link> --}}
                    </div>
                @endguest
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('tmp')" :active="request()->routeIs('tmp')">
                {{ __('All recipes') }}
            </x-responsive-nav-link>

            {{-- <x-responsive-nav-link :href="route('tmp')" :active="request()->routeIs('tmp')">
                {{ __('Top recipes') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('tmp')" :active="request()->routeIs('tmp')">
                {{ __('New recipes') }}
            </x-responsive-nav-link> --}}

            @auth
                <x-responsive-nav-link :href="route('recipes.index.my')" :active="request()->routeIs('recipes.index.my')">
                    {{ __('My recipes') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('recipes.create')" :active="request()->routeIs('recipes.create')">
                    {{ __('Add new') }}
                </x-responsive-nav-link>
            @endauth

            @guest
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
            @endguest

            {{-- <x-responsive-nav-link :href="route('tmp')" :active="request()->routeIs('tmp')">
                {{ __('Lang') }}
            </x-responsive-nav-link> --}}
        </div>

        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>

                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        {{-- <x-responsive-nav-link :href="route('tmp')" :active="request()->routeIs('tmp')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link> --}}

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Logout') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
