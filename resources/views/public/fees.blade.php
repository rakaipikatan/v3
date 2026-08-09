<x-public-layout title="{{ __('Registration Fees') }}">
    <x-page-header eyebrow="{{ __('One Fee Table') }}" title="{{ __('Registration') }}" accent="{{ __('Fees') }}" />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @foreach ($categories as $group => $groupCategories)
                <div class="rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-6 text-center">
                    <p class="text-xs font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 capitalize">{{ $group }}</p>
                    <p class="mt-2 text-2xl font-black text-indigo-600 dark:text-indigo-400">Rp{{ number_format($groupCategories->first()->fee, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>

        <div class="rounded-2xl bg-gray-100 dark:bg-gray-800 p-5 text-sm text-gray-600 dark:text-gray-400">
            {{ __('A unique 3-digit code is added to the fee for each invoice to make bank transfers easy to match (e.g. Rp470.000 + 127 = Rp470.127).') }}
        </div>
    </div>
</x-public-layout>
