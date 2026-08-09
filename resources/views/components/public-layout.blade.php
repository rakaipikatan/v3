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
<body class="antialiased bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <nav class="border-b border-gray-100 dark:border-gray-700">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
            <a href="{{ route('home') }}" class="font-bold text-lg">V3 Open</a>

            <div class="hidden md:flex items-center gap-6 text-sm">
                <a href="{{ route('public.about') }}" class="hover:underline">{{ __('About') }}</a>
                <a href="{{ route('public.categories') }}" class="hover:underline">{{ __('Categories') }}</a>
                <a href="{{ route('public.competition-numbers') }}" class="hover:underline">{{ __('Competition Numbers') }}</a>
                <a href="{{ route('public.fees') }}" class="hover:underline">{{ __('Fees') }}</a>
                <a href="{{ route('public.schedule') }}" class="hover:underline">{{ __('Schedule') }}</a>
                <a href="{{ route('public.handbook') }}" class="hover:underline">{{ __('Handbook') }}</a>
                <a href="{{ route('public.sponsors') }}" class="hover:underline">{{ __('Sponsors') }}</a>
                <a href="{{ route('public.results') }}" class="hover:underline">{{ __('Results') }}</a>
            </div>

            <div class="flex items-center gap-3 text-sm">
                @auth
                    <a href="{{ route('dashboard') }}" class="underline">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}" class="underline">{{ __('Log in') }}</a>
                    <a href="{{ route('register') }}" class="px-3 py-1.5 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 rounded-md font-semibold">{{ __('Register') }}</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="mt-16 border-t border-gray-100 dark:border-gray-700 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} V3 Open Roller Sport Championship.
        </div>
    </footer>
</body>
</html>
