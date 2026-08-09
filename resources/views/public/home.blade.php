<x-public-layout :title="$event?->name ?? config('app.name')">
    {{-- Hero --}}
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-8 text-center">
        <p class="text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">
            {{ __('National Roller Sport Competition') }}
        </p>
        <h1 class="mt-4 text-5xl sm:text-7xl font-black tracking-tighter leading-none">
            V3<br><span class="text-indigo-600 dark:text-indigo-400">OPEN</span>
        </h1>

        @if ($event)
            <p class="mt-6 text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">{{ __('Mark the date') }}</p>
            <div class="mt-2 inline-block px-5 py-2 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold text-sm sm:text-base">
                {{ strtoupper($event->start_date->format('M j')) }}
                @if ($event->end_date && ! $event->end_date->eq($event->start_date))
                    &ndash; {{ strtoupper($event->end_date->format('j, Y')) }}
                @else
                    , {{ $event->start_date->format('Y') }}
                @endif
            </div>
        @endif
    </section>

    {{-- Venue banner --}}
    @if ($event?->location)
        <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <div class="rounded-3xl overflow-hidden shadow-xl border border-gray-100 dark:border-gray-800">
                <div class="h-40 sm:h-56 bg-gradient-to-br from-gray-900 via-indigo-900 to-indigo-600 flex items-center justify-center">
                    <span class="text-white/70 text-xs font-bold uppercase tracking-widest">{{ $event->name }}</span>
                </div>
                <div class="bg-white dark:bg-gray-900 p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">{{ __('Venue') }}</p>
                        <p class="mt-1 font-bold text-lg">{{ $event->location }}</p>
                    </div>
                    <a
                        href="https://www.google.com/maps/search/?api=1&query={{ urlencode($event->location) }}"
                        target="_blank"
                        rel="noopener"
                        class="shrink-0 px-5 py-2.5 rounded-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold text-xs uppercase tracking-wide text-center"
                    >
                        {{ __('View in Google Maps') }}
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- Bento quick-access grid --}}
    <section class="bg-white dark:bg-gray-900 border-y border-gray-100 dark:border-gray-800 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading :eyebrow="__('Navigate')" :title="__('Event')" :accent="__('Hub')" />

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Register + countdown --}}
                <a href="{{ route('register') }}" class="sm:col-span-2 rounded-3xl bg-gray-900 dark:bg-gray-800 text-white p-6 flex items-center justify-between gap-4 hover:opacity-90 transition">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-widest text-gray-400">{{ __('Registration') }}</p>
                        <p class="mt-1 text-2xl font-black">{{ __('Register Now') }}</p>
                        @if ($event?->registration_closes_at)
                            <div
                                x-data="{
                                    target: new Date('{{ $event->registration_closes_at->toIso8601String() }}').getTime(),
                                    remaining: '',
                                    tick() {
                                        const diff = this.target - Date.now();
                                        if (diff <= 0) { this.remaining = '{{ __('Registration closed') }}'; return; }
                                        const d = Math.floor(diff / 86400000);
                                        const h = Math.floor((diff % 86400000) / 3600000);
                                        const m = Math.floor((diff % 3600000) / 60000);
                                        this.remaining = d + 'd ' + h + 'h ' + m + 'm ' + '{{ __('left to register') }}';
                                    }
                                }"
                                x-init="tick(); setInterval(() => tick(), 30000)"
                                class="mt-2 text-xs font-mono text-gray-300"
                                x-text="remaining"
                            ></div>
                        @endif
                    </div>
                    <svg class="w-8 h-8 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </a>

                <a href="{{ route('public.handbook') }}" class="rounded-3xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-6">
                    <span class="inline-flex w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                    </span>
                    <p class="mt-4 font-black text-lg">{{ __('Technical Handbook') }}</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Rules, categories, and judging.') }}</p>
                </a>

                <a href="{{ route('public.schedule') }}" class="rounded-3xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-6">
                    <span class="inline-flex w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900 text-amber-600 dark:text-amber-300 items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </span>
                    <p class="mt-4 font-black text-lg">{{ __('Schedule') }}</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Key dates and deadlines.') }}</p>
                </a>

                <a href="{{ route('public.categories') }}" class="rounded-3xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-6">
                    <span class="inline-flex w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900 text-emerald-600 dark:text-emerald-300 items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                    </span>
                    <p class="mt-4 font-black text-lg">{{ __('Categories') }}</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Beginner, Standard, Speed.') }}</p>
                </a>

                <a href="{{ route('public.results') }}" class="rounded-3xl bg-indigo-600 text-white p-6">
                    <span class="inline-flex w-10 h-10 rounded-xl bg-white/20 items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    </span>
                    <p class="mt-4 font-black text-lg">{{ __('Results') }}</p>
                    <p class="mt-1 text-sm text-white/80">{{ __('Published after competition.') }}</p>
                </a>
            </div>
        </div>
    </section>

    {{-- Fee & competition highlights --}}
    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-section-heading :eyebrow="__('Highlights')" :title="__('Compete')" :accent="__('& Register')" />

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">{{ __('Competition Numbers') }}</p>
                    <p class="mt-2 font-black text-2xl">{{ __('Max 3 per athlete') }}</p>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('7 events: Time Trial, Sprint, Point, Elimination, Relay, Team Sprint.') }}</p>
                    <a href="{{ route('public.competition-numbers') }}" class="mt-4 inline-block text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ __('See all numbers') }} &rarr;</a>
                </div>
                <div class="rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">{{ __('Registration Fee') }}</p>
                    <p class="mt-2 font-black text-2xl">{{ __('From Rp450.000') }}</p>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ __('Beginner, Standard, and Speed categories.') }}</p>
                    <a href="{{ route('public.fees') }}" class="mt-4 inline-block text-sm font-bold text-indigo-600 dark:text-indigo-400">{{ __('See fee breakdown') }} &rarr;</a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
