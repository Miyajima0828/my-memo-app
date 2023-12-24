<nav x-data="{ open: false }" class="bg-white border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="hidden lg:flex lg:items-center ">
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                <img class="w-8" src="{{ asset('logo.png')}}" >
                </a>
            </div>
            <!-- Settings Dropdown -->
            <div class="ml-3 relative">
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                                alt="{{ Auth::user()->name }}" />
                        </button>
                        @else
                        <span class="inline-flex rounded-md">
                            <button type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{ Auth::user()->name }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>

        <!-- Hamburger -->
        <div class="-me-2 flex items-center lg:hidden">

            <button id="button" type="button" class="fixed z-20 top-3 right-6">
                <i id="bars" class="fa-solid fa-bars fa-2x"></i>
            </button>
            <ul id="menu"
                class="fixed w-full h-full overflow-y-scroll top-0 right-0 z-10 mb-12 pb-12 translate-x-full bg-teal-500 text-white text-center text-xl font-bold transition-all ease-linear">
                <div class="flex w-full justify-end bg-white">
                    <li class="py-2">
                        <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Home') }}
                        </x-responsive-nav-link>
                    </li>
                    <li class="py-2"><x-responsive-nav-link href="{{ route('profile.show') }}"
                            :active="request()->routeIs('profile.show')">
                            {{ __('Profile') }}
                        </x-responsive-nav-link></li>
                    <li class="py-2 mr-16">
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </li>
                </div>
                @if(Request::is('dashboard'))
                    @if(!empty($userMain))
                    <div class="p-2">
                    @livewire('category-side', ['userMain' => $userMain, 'mainIdArray' => $mainIdArray, 'userSub' =>
                    $userSub])
                    </div>
                    @else
                        <div class="p-2">
                            @livewire('main-create')
                        </div>
                    @endif
                @endif
            </ul>

        </div>
    </div>


</nav>