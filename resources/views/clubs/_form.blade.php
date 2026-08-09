<div>
    <x-input-label for="club_name" :value="__('Club Name')" />
    <x-text-input id="club_name" name="club_name" type="text" class="mt-1 block w-full" :value="old('club_name', $club?->club_name)" required autofocus />
    <x-input-error class="mt-2" :messages="$errors->get('club_name')" />
</div>

<div>
    <x-input-label for="club_pic" :value="__('Club PIC')" />
    <x-text-input id="club_pic" name="club_pic" type="text" class="mt-1 block w-full" :value="old('club_pic', $club?->club_pic)" required />
    <x-input-error class="mt-2" :messages="$errors->get('club_pic')" />
</div>

<div>
    <x-input-label for="city" :value="__('City')" />
    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $club?->city)" required />
    <x-input-error class="mt-2" :messages="$errors->get('city')" />
</div>

<div>
    <x-input-label for="province" :value="__('Province')" />
    <x-text-input id="province" name="province" type="text" class="mt-1 block w-full" :value="old('province', $club?->province)" required />
    <x-input-error class="mt-2" :messages="$errors->get('province')" />
</div>

<div class="flex items-center gap-4">
    <x-primary-button>{{ __('Save') }}</x-primary-button>
    <a href="{{ route('clubs.index') }}" class="text-sm text-gray-600 dark:text-gray-400 underline">{{ __('Cancel') }}</a>
</div>
