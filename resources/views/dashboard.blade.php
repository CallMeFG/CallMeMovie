<x-app-layout>
    <x-slot name="title">
        Dashboard
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Kita gunakan Alpine.js untuk mengontrol tab yang aktif --}}
    <div x-data="{ tab: 'dashboard' }" class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 border-b border-gray-200 dark:border-gray-700">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    <a href="#" @click.prevent="tab = 'dashboard'"
                        :class="{
                           'border-indigo-500 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400': tab === 'dashboard',
                           'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': tab !== 'dashboard'
                       }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Dashboard
                    </a>

                    <a href="#" @click.prevent="tab = 'profile'"
                        :class="{
                           'border-indigo-500 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400': tab === 'profile',
                           'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-600': tab !== 'profile'
                       }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        Profile
                    </a>
                </nav>
            </div>
            <div x-show="tab === 'dashboard'" x-cloak>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>

            <div x-show="tab === 'profile'" x-cloak class="space-y-6">
                {{-- Form untuk Update Profile Information --}}
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        {{-- Kita tetap harus passing data user ke partial ini --}}
                        @include('profile.partials.update-profile-information-form', ['user' => Auth::user()])
                    </div>
                </div>

                {{-- Form untuk Update Password --}}
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- Tombol untuk Delete Account --}}
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>