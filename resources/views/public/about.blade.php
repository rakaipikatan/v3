<x-public-layout title="{{ __('About') }}">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-4">
        <h1 class="text-3xl font-bold">{{ __('About the Championship') }}</h1>

        @if ($event)
            <p class="text-gray-700 dark:text-gray-300">{{ $event->description }}</p>
            <dl class="grid grid-cols-2 gap-4 text-sm mt-6">
                <div>
                    <dt class="text-gray-500 dark:text-gray-400">{{ __('Date') }}</dt>
                    <dd>{{ $event->start_date->format('d M Y') }}@if ($event->end_date && ! $event->end_date->eq($event->start_date)) &ndash; {{ $event->end_date->format('d M Y') }}@endif</dd>
                </div>
                <div>
                    <dt class="text-gray-500 dark:text-gray-400">{{ __('Location') }}</dt>
                    <dd>{{ $event->location }}</dd>
                </div>
            </dl>
        @else
            <p class="text-gray-500 dark:text-gray-400">{{ __('Championship details will be announced soon.') }}</p>
        @endif
    </div>
</x-public-layout>
