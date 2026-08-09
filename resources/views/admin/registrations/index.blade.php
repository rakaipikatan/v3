<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registrations') }}
        </h2>
    </x-slot>

    @php
        $statusLabels = [
            'pending_payment' => __('Pending Payment'),
            'payment_submitted' => __('Payment Submitted'),
            'under_review' => __('Under Review'),
            'verified' => __('Verified'),
            'paid' => __('Paid'),
            'rejected' => __('Rejected'),
            'expired' => __('Expired'),
        ];
    @endphp

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-end">
                <a href="{{ route('admin.registrations.export') }}" class="inline-block px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-md text-sm font-semibold">
                    {{ __('Export CSV') }}
                </a>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.registrations.index') }}" class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusFilter === '' ? 'bg-gray-800 text-white dark:bg-gray-200 dark:text-gray-800' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                    {{ __('All') }}
                </a>
                @foreach ($statusLabels as $value => $label)
                    <a href="{{ route('admin.registrations.index', ['status' => $value]) }}" class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusFilter === $value ? 'bg-gray-800 text-white dark:bg-gray-200 dark:text-gray-800' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                @if ($registrations->isEmpty())
                    <p class="p-6 text-gray-600 dark:text-gray-400">{{ __('No registrations found.') }}</p>
                @else
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-6 py-3">{{ __('Athlete') }}</th>
                                <th class="px-6 py-3">{{ __('Club') }}</th>
                                <th class="px-6 py-3">{{ __('Event') }}</th>
                                <th class="px-6 py-3">{{ __('Status') }}</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($registrations as $registration)
                                @php($payment = $registration->invoice?->payments->first())
                                <tr>
                                    <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $registration->athlete->full_name }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $registration->athlete->club->club_name }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $registration->event->name }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                                            {{ $statusLabels[$payment?->status ?? 'pending_payment'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('admin.registrations.show', $registration) }}" class="text-indigo-600 dark:text-indigo-400 underline">{{ __('Review') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            {{ $registrations->links() }}
        </div>
    </div>
</x-app-layout>
