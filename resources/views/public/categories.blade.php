<x-public-layout title="{{ __('Categories') }}">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-8">
        <h1 class="text-3xl font-bold">{{ __('Categories') }}</h1>

        @foreach ($categories as $group => $groupCategories)
            <div>
                <h2 class="text-xl font-semibold capitalize">{{ $group }}</h2>
                <ul class="mt-2 flex flex-wrap gap-2">
                    @foreach ($groupCategories as $category)
                        <li class="px-3 py-1 rounded-full text-sm bg-gray-100 dark:bg-gray-800">{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</x-public-layout>
