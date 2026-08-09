<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Register for Competition') }} &mdash; {{ $athlete->full_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('registrations.store', [$club, $athlete]) }}" class="space-y-6" x-data="{ selected: {{ json_encode(old('race_event_ids', [])) }} }">
                        @csrf

                        <div>
                            <x-input-label for="event_id" :value="__('Event')" />
                            <select id="event_id" name="event_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <option value="">{{ __('Select event') }}</option>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}" @selected(old('event_id') == $event->id)>
                                        {{ $event->name }} ({{ $event->start_date->format('d M Y') }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('event_id')" />
                        </div>

                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <option value="">{{ __('Select category') }}</option>
                                @foreach ($categories->groupBy('group') as $group => $groupCategories)
                                    <optgroup label="{{ ucfirst($group) }}">
                                        @foreach ($groupCategories as $category)
                                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                                {{ $category->name }} &mdash; Rp{{ number_format($category->fee) }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        <div>
                            <x-input-label for="jersey_size_id" :value="__('Jersey Size')" />
                            <select id="jersey_size_id" name="jersey_size_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                                <option value="">{{ __('Select jersey size') }}</option>
                                @foreach ($jerseySizes as $jerseySize)
                                    <option value="{{ $jerseySize->id }}" @selected(old('jersey_size_id') == $jerseySize->id)>{{ $jerseySize->label }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('jersey_size_id')" />
                        </div>

                        <div>
                            <x-input-label :value="__('Competition Numbers (max 3)')" />
                            <div class="mt-2 space-y-2">
                                @foreach ($raceEvents as $raceEvent)
                                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                                        <input
                                            type="checkbox"
                                            name="race_event_ids[]"
                                            value="{{ $raceEvent->id }}"
                                            x-model="selected"
                                            :disabled="selected.length >= 3 && !selected.includes('{{ $raceEvent->id }}')"
                                            class="rounded border-gray-300 dark:border-gray-700"
                                        >
                                        {{ $raceEvent->name }}
                                    </label>
                                @endforeach
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400" x-text="selected.length + ' / 3 selected'"></p>
                            <x-input-error class="mt-2" :messages="$errors->get('race_event_ids')" />
                        </div>

                        <div>
                            <x-input-label for="emergency_contact_name" :value="__('Emergency Contact Name')" />
                            <x-text-input id="emergency_contact_name" name="emergency_contact_name" type="text" class="mt-1 block w-full" :value="old('emergency_contact_name')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_name')" />
                        </div>

                        <div>
                            <x-input-label for="emergency_contact_phone" :value="__('Emergency Contact Phone')" />
                            <x-text-input id="emergency_contact_phone" name="emergency_contact_phone" type="text" class="mt-1 block w-full" :value="old('emergency_contact_phone')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('emergency_contact_phone')" />
                        </div>

                        <div class="space-y-2">
                            <label class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                                <input type="checkbox" name="data_declaration_agreed" value="1" class="mt-1 rounded border-gray-300 dark:border-gray-700" required>
                                {{ __('I declare that the data provided is true and accurate.') }}
                            </label>
                            <x-input-error class="mt-2" :messages="$errors->get('data_declaration_agreed')" />

                            <label class="flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                                <input type="checkbox" name="rules_agreement_agreed" value="1" class="mt-1 rounded border-gray-300 dark:border-gray-700" required>
                                {{ __('I agree to the competition rules.') }}
                            </label>
                            <x-input-error class="mt-2" :messages="$errors->get('rules_agreement_agreed')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Submit Registration') }}</x-primary-button>
                            <a href="{{ route('clubs.athletes.index', $club) }}" class="text-sm text-gray-600 dark:text-gray-400 underline">{{ __('Cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
