<x-public-layout :title="$event?->name ?? config('app.name')">
    <div class="bg-gradient-to-b from-gray-900 to-gray-700 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            <p class="uppercase tracking-widest text-sm text-gray-300">{{ __('V3 Roller Sport') }}</p>
            <h1 class="mt-4 text-4xl sm:text-5xl font-bold">{{ $event->name ?? __('V3 Open') }}</h1>

            @if ($event)
                <p class="mt-4 text-lg text-gray-200">
                    {{ $event->start_date->format('d M Y') }}
                    @if ($event->end_date && ! $event->end_date->eq($event->start_date))
                        &ndash; {{ $event->end_date->format('d M Y') }}
                    @endif
                    @if ($event->location)
                        &middot; {{ $event->location }}
                    @endif
                </p>

                <div
                    x-data="{
                        target: new Date('{{ $event->start_date->format('Y-m-d') }}T00:00:00').getTime(),
                        remaining: '',
                        tick() {
                            const diff = this.target - Date.now();
                            if (diff <= 0) { this.remaining = '{{ __('The championship has started!') }}'; return; }
                            const d = Math.floor(diff / 86400000);
                            const h = Math.floor((diff % 86400000) / 3600000);
                            const m = Math.floor((diff % 3600000) / 60000);
                            const s = Math.floor((diff % 60000) / 1000);
                            this.remaining = d + 'd ' + h + 'h ' + m + 'm ' + s + 's';
                        }
                    }"
                    x-init="tick(); setInterval(() => tick(), 1000)"
                    class="mt-8 text-2xl font-mono"
                    x-text="remaining"
                ></div>
            @endif

            <div class="mt-10 flex flex-wrap justify-center gap-3">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-gray-900 rounded-md font-semibold">{{ __('Register') }}</a>
                <a href="{{ route('public.handbook') }}" class="px-6 py-3 border border-white rounded-md font-semibold">{{ __('Technical Handbook') }}</a>
                <a href="{{ route('public.schedule') }}" class="px-6 py-3 border border-white rounded-md font-semibold">{{ __('Schedule') }}</a>
                <a href="{{ route('public.results') }}" class="px-6 py-3 border border-white rounded-md font-semibold">{{ __('Results') }}</a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 grid sm:grid-cols-3 gap-6 text-center">
        <a href="{{ route('public.categories') }}" class="p-6 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-500">
            <h3 class="font-semibold">{{ __('Categories') }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('Beginner, Standard, Speed') }}</p>
        </a>
        <a href="{{ route('public.competition-numbers') }}" class="p-6 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-500">
            <h3 class="font-semibold">{{ __('Competition Numbers') }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('7 events, max 3 per athlete') }}</p>
        </a>
        <a href="{{ route('public.fees') }}" class="p-6 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-gray-400 dark:hover:border-gray-500">
            <h3 class="font-semibold">{{ __('Registration Fees') }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('See fee breakdown') }}</p>
        </a>
    </div>
</x-public-layout>
