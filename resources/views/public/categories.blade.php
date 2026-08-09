<x-public-layout title="{{ __('Categories') }}">
    <x-page-header :eyebrow="__('Age Groups & Classes')" :title="__('Categories')" />

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-6">
        @foreach ($categories as $group => $groupCategories)
            <div class="rounded-3xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 p-6">
                <h2 class="text-xl font-black capitalize">{{ $group }}</h2>
                <ul class="mt-4 flex flex-wrap gap-2">
                    @foreach ($groupCategories as $category)
                        <li class="px-4 py-1.5 rounded-full text-sm font-semibold bg-gray-100 dark:bg-gray-700">{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</x-public-layout>
