<x-public-layout title="{{ __('Registration Fees') }}">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-6">
        <h1 class="text-3xl font-bold">{{ __('Registration Fees') }}</h1>

        <table class="w-full text-sm text-left border-t border-gray-200 dark:border-gray-700">
            <thead>
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <th class="py-3">{{ __('Group') }}</th>
                    <th class="py-3">{{ __('Fee') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($categories as $group => $groupCategories)
                    <tr>
                        <td class="py-3 capitalize">{{ $group }}</td>
                        <td class="py-3">Rp{{ number_format($groupCategories->first()->fee, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="text-xs text-gray-500 dark:text-gray-400">
            {{ __('A unique 3-digit code is added to the fee for each invoice to make bank transfers easy to match (e.g. Rp470.000 + 127 = Rp470.127).') }}
        </p>
    </div>
</x-public-layout>
