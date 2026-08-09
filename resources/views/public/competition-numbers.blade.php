<x-public-layout title="{{ __('Competition Numbers') }}">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-4">
        <h1 class="text-3xl font-bold">{{ __('Competition Numbers') }}</h1>
        <p class="text-gray-600 dark:text-gray-400">{{ __('Each athlete may select a maximum of 3 competition numbers.') }}</p>

        <ul class="divide-y divide-gray-200 dark:divide-gray-700 border-t border-b border-gray-200 dark:border-gray-700">
            @foreach ($raceEvents as $raceEvent)
                <li class="py-3 flex justify-between text-sm">
                    <span>{{ $raceEvent->name }}</span>
                    @if ($raceEvent->distance_meters)
                        <span class="text-gray-500 dark:text-gray-400">{{ number_format($raceEvent->distance_meters, 0, ',', '.') }} m</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</x-public-layout>
