<x-public-layout title="{{ __('Results') }}">
    <x-page-header eyebrow="{{ __('After the Race') }}" title="{{ __('Results') }}" />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-8 text-center">
            <p class="text-gray-500 dark:text-gray-400">
                @if ($event)
                    {{ __('Results for :event will be published here after the competition.', ['event' => $event->name]) }}
                @else
                    {{ __('Results will be published here after the competition.') }}
                @endif
            </p>
        </div>
    </div>
</x-public-layout>
