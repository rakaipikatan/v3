<div>
    <x-input-label for="full_name" :value="__('Full Name')" />
    <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name', $athlete?->full_name)" required autofocus />
    <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
</div>

<div>
    <x-input-label for="nickname" :value="__('Nickname')" />
    <x-text-input id="nickname" name="nickname" type="text" class="mt-1 block w-full" :value="old('nickname', $athlete?->nickname)" />
    <x-input-error class="mt-2" :messages="$errors->get('nickname')" />
</div>

<div>
    <x-input-label for="gender" :value="__('Gender')" />
    <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
        <option value="">{{ __('Select gender') }}</option>
        @foreach (['male' => __('Male'), 'female' => __('Female')] as $value => $label)
            <option value="{{ $value }}" @selected(old('gender', $athlete?->gender) === $value)>{{ $label }}</option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
</div>

<div>
    <x-input-label for="place_of_birth" :value="__('Place of Birth')" />
    <x-text-input id="place_of_birth" name="place_of_birth" type="text" class="mt-1 block w-full" :value="old('place_of_birth', $athlete?->place_of_birth)" required />
    <x-input-error class="mt-2" :messages="$errors->get('place_of_birth')" />
</div>

<div>
    <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
    <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth', $athlete?->date_of_birth?->format('Y-m-d'))" required />
    <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
</div>

<div>
    <x-input-label for="identity_number" :value="__('KTP / NIK / KIA (optional)')" />
    <x-text-input id="identity_number" name="identity_number" type="text" class="mt-1 block w-full" :value="old('identity_number', $athlete?->identity_number)" />
    <x-input-error class="mt-2" :messages="$errors->get('identity_number')" />
</div>

<div>
    <x-input-label for="blood_type" :value="__('Blood Type (optional)')" />
    <select id="blood_type" name="blood_type" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">
        <option value="">{{ __('Unknown') }}</option>
        @foreach (['A', 'B', 'AB', 'O'] as $type)
            <option value="{{ $type }}" @selected(old('blood_type', $athlete?->blood_type) === $type)>{{ $type }}</option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('blood_type')" />
</div>

<div class="flex items-center gap-4">
    <x-primary-button>{{ __('Save') }}</x-primary-button>
    <a href="{{ route('clubs.athletes.index', $club) }}" class="text-sm text-gray-600 dark:text-gray-400 underline">{{ __('Cancel') }}</a>
</div>
