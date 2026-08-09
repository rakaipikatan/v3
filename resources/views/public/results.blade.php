<x-public-layout title="{{ __('Results') }}">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-4">
        <h1 class="text-3xl font-bold">{{ __('Results') }}</h1>
        <p class="text-gray-500 dark:text-gray-400">
            @if ($event)
                {{ __('Results for :event will be published here after the competition.', ['event' => $event->name]) }}
            @else
                {{ __('Results will be published here after the competition.') }}
            @endif
        </p>
    </div>
</x-public-layout>
