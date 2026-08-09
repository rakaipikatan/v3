<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registration Review') }} &mdash; {{ $registration->athlete->full_name }}
        </h2>
    </x-slot>

    @php
        $payment = $registration->invoice->payments->first();
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
            <a href="{{ route('admin.registrations.index') }}" class="text-sm text-gray-600 dark:text-gray-400 underline">&larr; {{ __('Back to list') }}</a>

            @if (session('status'))
                <p class="text-sm text-green-600 dark:text-green-400">{{ __(str_replace('-', ' ', ucfirst(session('status')))) }}</p>
            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-2 text-sm text-gray-700 dark:text-gray-300">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Athlete & Club') }}</h3>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Athlete') }}:</span> {{ $registration->athlete->full_name }} ({{ ucfirst($registration->athlete->gender) }}, {{ $registration->athlete->age }} yo)</p>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Club') }}:</span> {{ $registration->athlete->club->club_name }} &mdash; {{ $registration->athlete->club->city }}</p>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Manager') }}:</span> {{ $registration->athlete->club->manager->full_name }} ({{ $registration->athlete->club->manager->phone }})</p>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Event') }}:</span> {{ $registration->event->name }}</p>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Category') }}:</span> {{ ucfirst($registration->category->group) }} &mdash; {{ $registration->category->name }}</p>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Jersey Size') }}:</span> {{ $registration->jerseySize->label }}</p>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Emergency Contact') }}:</span> {{ $registration->emergency_contact_name }} ({{ $registration->emergency_contact_phone }})</p>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-3 text-sm text-gray-700 dark:text-gray-300">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Competition Numbers & Bib Assignment') }}</h3>
                @foreach ($registration->items as $item)
                    <div class="flex items-center gap-4">
                        <span class="w-40">{{ $item->raceEvent->name }}</span>
                        <form method="post" action="{{ route('admin.race-numbers.store', $item) }}" class="flex items-center gap-2">
                            @csrf
                            <input type="text" name="bib_number" value="{{ old('bib_number', $item->raceNumber?->bib_number) }}" placeholder="{{ __('Bib number') }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md text-sm">
                            <button type="submit" class="text-indigo-600 dark:text-indigo-400 underline text-xs">{{ __('Save') }}</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-2 text-sm text-gray-700 dark:text-gray-300">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Invoice') }} &mdash; {{ $registration->invoice->invoice_number }}</h3>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Registration Fee') }}:</span> Rp{{ number_format($registration->invoice->base_fee, 0, ',', '.') }}</p>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Unique Code') }}:</span> {{ $registration->invoice->unique_code }}</p>
                <p class="font-semibold text-gray-900 dark:text-gray-100">{{ __('Total Transfer') }}: Rp{{ number_format($registration->invoice->total_amount, 0, ',', '.') }}</p>

                <div class="pt-2">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                        {{ $statusLabels[$payment?->status ?? 'pending_payment'] }}
                    </span>
                    @if ($payment?->rejection_reason)
                        <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ __('Rejection reason') }}: {{ $payment->rejection_reason }}</p>
                    @endif
                    @if ($payment?->reviewer)
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            {{ __('Reviewed by') }} {{ $payment->reviewer->name }} {{ __('at') }} {{ $payment->reviewed_at?->format('d M Y H:i') }}
                        </p>
                    @endif
                </div>

                @if ($payment && $payment->proofs->isNotEmpty())
                    <div class="pt-2">
                        <p class="text-gray-500 dark:text-gray-400">{{ __('Payment proof') }}:</p>
                        <ul class="list-disc list-inside">
                            @foreach ($payment->proofs as $proof)
                                <li><a href="{{ route('admin.payment-proofs.show', $proof) }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 underline">{{ $proof->original_filename }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($payment && in_array($payment->status, ['payment_submitted', 'under_review']))
                    <div class="pt-4 flex items-center gap-4">
                        <form method="post" action="{{ route('admin.payments.approve', $payment) }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md text-sm font-semibold">{{ __('Approve & Mark Paid') }}</button>
                        </form>

                        <form method="post" action="{{ route('admin.payments.reject', $payment) }}" x-data="{ open: false }" @submit="if (!open) { $event.preventDefault(); open = true }">
                            @csrf
                            <div x-show="open" class="mb-2">
                                <input type="text" name="rejection_reason" placeholder="{{ __('Rejection reason') }}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md text-sm w-64" required>
                            </div>
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md text-sm font-semibold" x-text="open ? '{{ __('Confirm Reject') }}' : '{{ __('Reject') }}'"></button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
