<x-public-layout title="{{ __('Competition Numbers') }}">
    <x-page-header
        eyebrow="{{ __('Choose Your Events') }}"
        title="{{ __('Competition') }}"
        accent="{{ __('Numbers') }}"
        description="{{ __('Each athlete may select a maximum of 3 competition numbers.') }}"
    />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach ($raceEvents as $raceEvent)
                <div class="rounded-2xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-5 flex items-center justify-between">
                    <span class="font-bold">{{ $raceEvent->name }}</span>
                    @if ($raceEvent->distance_meters)
                        <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">{{ number_format($raceEvent->distance_meters, 0, ',', '.') }} m</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-public-layout>
