<x-public-layout title="{{ __('Technical Handbook') }}">
    <x-page-header :eyebrow="__('Rules & Regulations')" :title="__('Technical')" :accent="__('Handbook')" />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-8 text-center">
            <span class="inline-flex w-14 h-14 rounded-2xl bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 items-center justify-center mx-auto">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
            </span>
            <p class="mt-4 text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                {{ __('The technical handbook (rules, categories, judging) will be published here before registration closes.') }}
            </p>
        </div>
    </div>
</x-public-layout>
