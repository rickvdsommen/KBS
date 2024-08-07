<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')">
                        {{ __('Projecten') }}
                    </x-nav-link>
                    <x-nav-link :href="route('team.index')" :active="request()->routeIs('team.index')">
                        {{ __('Het Team') }}
                    </x-nav-link>
                    <x-nav-link :href="route('agenda.index')" :active="request()->routeIs('agenda.index')">
                        {{ __('Agenda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('availability.index')" :active="request()->routeIs('availability.index')">
                        {{ __('Aanwezigheid') }}
                    </x-nav-link>
                    @role('admin')
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')">
                            {{ __('Gebruikerbeheer') }}
                        </x-nav-link>
                    @endrole
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="60">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center text-lg">
                                {{-- @include('components.status-indicator') --}}
                                @include('components.profile_picture')
                                {{ Auth::user()->name }}
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content" x-show="open" @click.away="open = false">
                        <x-dropdown-link :href="route('profile.edit')" class="text-lg mb-1 block rounded">
                            {{ __('Profiel') }}
                        </x-dropdown-link>

                        <!-- Availability Toggles -->
                        @include('components.availability-toggle')

                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}" class="mt-1 mx-2">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="font-semibold text-red-500 hover:text-red-600 hover:bg-red-100 rounded transition duration-150 ease-in-out text-lg block">
                                {{ __('Uitloggen') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 text-">
            <x-responsive-nav-link class="text-lg font-medium" :href="route('projects.index')" :active="request()->routeIs('projects.index')">
                {{ __('Projecten') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link class="text-lg font-medium" :href="route('team.index')" :active="request()->routeIs('team.index')">
                {{ __('Het Team') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link class="text-lg font-medium" :href="route('agenda.index')" :active="request()->routeIs('agenda.index')">
                {{ __('Agenda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link class="text-lg font-medium" :href="route('availability.index')" :active="request()->routeIs('availability.index')">
                {{ __('Aanwezigheid') }}
            </x-responsive-nav-link>
            @role('admin')
                <x-responsive-nav-link class="text-lg font-medium" :href="route('users.index')" :active="request()->routeIs('users.index')">
                    {{ __('Gebruikerbeheer') }}
                </x-responsive-nav-link>
            @endrole
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4 flex items-center">
                {{-- <div class="font-medium text-base text-gray-800 dark:text-gray-200">@include('components.status-indicator'){{ Auth::user()->name }}</div> --}}
                @include('components.profile_picture')
                <div class="font-medium text-lg text-gray-500">{{ Auth::user()->name }}</div>
            </div>

            <!-- Dark Mode Toggle -->
            {{-- @include('components.darkmode-toggle') --}}

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profiel') }}
                </x-responsive-nav-link>

                @include('components.availability-toggle')

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();"
                        class="font-semibold text-red-500">
                        {{ __('Uitloggen') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('input[name="availability"]').forEach(radio => {
            radio.addEventListener('change', () => {
                document.getElementById('availabilityForm').submit();
            });
        });
    });
</script>