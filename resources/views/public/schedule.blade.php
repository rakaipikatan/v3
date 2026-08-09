<x-public-layout title="{{ __('Schedule') }}">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-4">
        <h1 class="text-3xl font-bold">{{ __('Schedule') }}</h1>

        @if ($event)
            <p class="text-gray-700 dark:text-gray-300">
                {{ $event->name }} &mdash; {{ $event->start_date->format('d M Y') }}
                @if ($event->end_date && ! $event->end_date->eq($event->start_date))
                    &ndash; {{ $event->end_date->format('d M Y') }}
                @endif
            </p>
        @endif

        <p class="text-gray-500 dark:text-gray-400">{{ __('The detailed race-day schedule will be published closer to the event.') }}</p>
    </div>
</x-public-layout>
