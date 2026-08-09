@props(['title' => null])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100">
    <nav x-data="{ open: false }" class="sticky top-0 z-30 bg-white/90 dark:bg-gray-950/90 backdrop-blur border-b border-gray-100 dark:border-gray-800">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-black tracking-tight text-lg">
                <span class="w-8 h-8 rounded-lg bg-gray-900 dark:bg-white text-white dark:text-gray-900 flex items-center justify-center text-sm">V3</span>
                <span>OPEN</span>
            </a>

            <div class="hidden lg:flex items-center gap-6 text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-400">
                <a href="{{ route('public.about') }}" class="hover:text-gray-900 dark:hover:text-white">{{ __('About') }}</a>
                <a href="{{ route('public.categories') }}" class="hover:text-gray-900 dark:hover:text-white">{{ __('Categories') }}</a>
                <a href="{{ route('public.competition-numbers') }}" class="hover:text-gray-900 dark:hover:text-white">{{ __('Numbers') }}</a>
                <a href="{{ route('public.fees') }}" class="hover:text-gray-900 dark:hover:text-white">{{ __('Fees') }}</a>
                <a href="{{ route('public.schedule') }}" class="hover:text-gray-900 dark:hover:text-white">{{ __('Schedule') }}</a>
                <a href="{{ route('public.handbook') }}" class="hover:text-gray-900 dark:hover:text-white">{{ __('Handbook') }}</a>
                <a href="{{ route('public.sponsors') }}" class="hover:text-gray-900 dark:hover:text-white">{{ __('Sponsors') }}</a>
                <a href="{{ route('public.results') }}" class="hover:text-gray-900 dark:hover:text-white">{{ __('Results') }}</a>
            </div>

            <div class="hidden lg:flex items-center gap-3 text-sm">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-semibold text-xs uppercase tracking-wide">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">{{ __('Log in') }}</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-indigo-600 text-white font-semibold text-xs uppercase tracking-wide hover:bg-indigo-700">{{ __('Register') }}</a>
                @endauth
            </div>

            <button @click="open = ! open" class="lg:hidden p-2 -mr-2 text-gray-600 dark:text-gray-300">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ hidden: open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ hidden: ! open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div x-show="open" x-cloak class="lg:hidden border-t border-gray-100 dark:border-gray-800 px-4 py-4 space-y-3 text-sm font-semibold uppercase tracking-wide text-gray-600 dark:text-gray-400">
            <a href="{{ route('public.about') }}" class="block">{{ __('About') }}</a>
            <a href="{{ route('public.categories') }}" class="block">{{ __('Categories') }}</a>
            <a href="{{ route('public.competition-numbers') }}" class="block">{{ __('Competition Numbers') }}</a>
            <a href="{{ route('public.fees') }}" class="block">{{ __('Fees') }}</a>
            <a href="{{ route('public.schedule') }}" class="block">{{ __('Schedule') }}</a>
            <a href="{{ route('public.handbook') }}" class="block">{{ __('Technical Handbook') }}</a>
            <a href="{{ route('public.sponsors') }}" class="block">{{ __('Sponsors') }}</a>
            <a href="{{ route('public.results') }}" class="block">{{ __('Results') }}</a>
            <div class="pt-3 border-t border-gray-100 dark:border-gray-800 flex flex-col gap-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 text-center">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}" class="text-center">{{ __('Log in') }}</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-indigo-600 text-white text-center">{{ __('Register') }}</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="mt-16 border-t border-gray-100 dark:border-gray-800 py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row justify-between gap-4 text-sm text-gray-500 dark:text-gray-400">
            <span class="font-black tracking-tight text-gray-900 dark:text-white">V3 OPEN</span>
            <span>&copy; {{ date('Y') }} V3 Open Roller Sport Championship. {{ __('All rights reserved.') }}</span>
        </div>
    </footer>
</body>
</html>
