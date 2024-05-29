<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profiel beheren') }}
        </h2>
    </x-slot>

    <div class="pb-12 pt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Kennis en Vaardigheden bijwerken') }}
                    </h2>
            
                    <p class="mt-1 mb-4 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Werk je kennis, vaardigheden en opleidingen bij!") }}
                    </p>
                </header>
                <div class="max-w-full flex flex-wrap gap-4">
                    <div class="flex-1 min-w-[250px]">
                        @include('profile.partials.update-skills-form')
                    </div>
                    <div class="flex-1 min-w-[250px]">
                        @include('profile.partials.update-courses-form')
                    </div>
                    <div class="flex-1 min-w-[250px]">
                        @include('profile.partials.update-degrees-form')
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-700 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
