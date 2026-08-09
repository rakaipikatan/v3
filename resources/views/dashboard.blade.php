<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">
                    @if (auth()->user()->manager)
                        <p>{{ __('Manager profile complete.') }}</p>
                        <a href="{{ route('manager.edit') }}" class="text-indigo-600 dark:text-indigo-400 underline">
                            {{ __('Edit manager profile') }}
                        </a>
                    @else
                        <p>{{ __('Complete your manager profile before registering a club or athlete.') }}</p>
                        <a href="{{ route('manager.edit') }}" class="inline-block px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-md text-sm font-semibold">
                            {{ __('Complete Manager Profile') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
