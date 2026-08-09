<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registration') }} &mdash; {{ $registration->athlete->full_name }}
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
            @if (session('status') === 'registration-created')
                <p class="text-sm text-green-600 dark:text-green-400">{{ __('Registration submitted. Please complete payment below.') }}</p>
            @elseif (session('status') === 'proof-uploaded')
                <p class="text-sm text-green-600 dark:text-green-400">{{ __('Payment proof uploaded. Awaiting admin review.') }}</p>
            @endif

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-2 text-sm text-gray-700 dark:text-gray-300">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Details') }}</h3>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Event') }}:</span> {{ $registration->event->name }}</p>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Category') }}:</span> {{ ucfirst($registration->category->group) }} &mdash; {{ $registration->category->name }}</p>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Jersey Size') }}:</span> {{ $registration->jerseySize->label }}</p>
                <p>
                    <span class="text-gray-500 dark:text-gray-400">{{ __('Competition Numbers') }}:</span>
                    {{ $registration->items->pluck('raceEvent.name')->join(', ') }}
                </p>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Emergency Contact') }}:</span> {{ $registration->emergency_contact_name }} ({{ $registration->emergency_contact_phone }})</p>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg space-y-2 text-sm text-gray-700 dark:text-gray-300">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Invoice') }} &mdash; {{ $registration->invoice->invoice_number }}</h3>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Registration Fee') }}:</span> Rp{{ number_format($registration->invoice->base_fee) }}</p>
                <p><span class="text-gray-500 dark:text-gray-400">{{ __('Unique Code') }}:</span> {{ $registration->invoice->unique_code }}</p>
                <p class="font-semibold text-gray-900 dark:text-gray-100">
                    {{ __('Total Transfer') }}: Rp{{ number_format($registration->invoice->total_amount) }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    {{ __('Transfer the exact total amount (including the unique code) to the committee\'s bank account, then upload proof below.') }}
                </p>

                <div class="pt-2">
                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                        {{ $statusLabels[$payment?->status ?? 'pending_payment'] }}
                    </span>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">{{ __('Upload Payment Proof') }}</h3>

                <form method="post" action="{{ route('registrations.payment-proof.store', $registration) }}" enctype="multipart/form-data" class="space-y-4 max-w-md">
                    @csrf
                    <div>
                        <input type="file" name="proof" accept=".pdf,.jpg,.jpeg,.png" required class="block w-full text-sm text-gray-700 dark:text-gray-300">
                        <x-input-error class="mt-2" :messages="$errors->get('proof')" />
                    </div>
                    <x-primary-button>{{ __('Upload') }}</x-primary-button>
                </form>

                @if ($payment && $payment->proofs->isNotEmpty())
                    <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">
                        {{ __('Uploaded files') }}: {{ $payment->proofs->pluck('original_filename')->join(', ') }}
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
