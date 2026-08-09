<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-2 sm:grid-cols-5 gap-4">
                <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-center">
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $clubCount }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Clubs') }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-center">
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $athleteCount }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Athletes') }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-center">
                    <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $registrationCount }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Registrations') }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-center">
                    <p class="text-2xl font-semibold text-amber-600 dark:text-amber-400">{{ $pendingReviewCount }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Pending Review') }}</p>
                </div>
                <div class="p-4 bg-white dark:bg-gray-800 shadow sm:rounded-lg text-center">
                    <p class="text-2xl font-semibold text-green-600 dark:text-green-400">{{ $paidCount }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Paid') }}</p>
                </div>
            </div>

            <a href="{{ route('admin.registrations.index') }}" class="inline-block px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-md text-sm font-semibold">
                {{ __('View All Registrations') }}
            </a>

            @if ($pendingReviewCount > 0)
                <a href="{{ route('admin.registrations.index', ['status' => 'payment_submitted']) }}" class="inline-block px-4 py-2 bg-amber-600 text-white rounded-md text-sm font-semibold">
                    {{ __('Review Pending Payments') }}
                </a>
            @endif
        </div>
    </div>
</x-app-layout>
