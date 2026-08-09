<x-public-layout title="{{ __('Schedule') }}">
    <x-page-header :eyebrow="__('Mark the Date')" :title="__('Event')" :accent="__('Schedule')" />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-4">
        @if ($event)
            <div class="rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 divide-y divide-gray-100 dark:divide-gray-700 overflow-hidden">
                <div class="p-5 flex items-center gap-4">
                    <span class="w-3 h-3 rounded-full bg-indigo-500 shrink-0"></span>
                    <div>
                        <p class="font-bold">{{ __('Competition Days') }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $event->start_date->format('d M Y') }}
                            @if ($event->end_date && ! $event->end_date->eq($event->start_date))
                                &ndash; {{ $event->end_date->format('d M Y') }}
                            @endif
                            &middot; {{ $event->location }}
                        </p>
                    </div>
                </div>

                @if ($event->registration_opens_at)
                    <div class="p-5 flex items-center gap-4">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 shrink-0"></span>
                        <div>
                            <p class="font-bold">{{ __('Registration Opens') }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $event->registration_opens_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @endif

                @if ($event->registration_closes_at)
                    <div class="p-5 flex items-center gap-4">
                        <span class="w-3 h-3 rounded-full bg-amber-500 shrink-0"></span>
                        <div>
                            <p class="font-bold">{{ __('Registration Closes') }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $event->registration_closes_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('The detailed race-day heat schedule will be published here closer to the event.') }}</p>
    </div>
</x-public-layout>
