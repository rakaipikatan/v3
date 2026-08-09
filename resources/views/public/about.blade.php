<x-public-layout title="{{ __('About') }}">
    <x-page-header eyebrow="{{ __('The Championship') }}" title="{{ __('About') }}" accent="{{ __('V3 Open') }}" />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-8">
            @if ($event)
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $event->description }}</p>
                <dl class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">{{ __('Date') }}</dt>
                        <dd class="mt-1 font-bold text-lg">
                            {{ $event->start_date->format('d M Y') }}@if ($event->end_date && ! $event->end_date->eq($event->start_date)) &ndash; {{ $event->end_date->format('d M Y') }}@endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">{{ __('Location') }}</dt>
                        <dd class="mt-1 font-bold text-lg">{{ $event->location }}</dd>
                    </div>
                </dl>
            @else
                <p class="text-gray-500 dark:text-gray-400">{{ __('Championship details will be announced soon.') }}</p>
            @endif
        </div>
    </div>
</x-public-layout>
