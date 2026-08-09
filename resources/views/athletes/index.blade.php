<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Athletes') }} &mdash; {{ $club->club_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center">
                <a href="{{ route('clubs.index') }}" class="text-sm text-gray-600 dark:text-gray-400 underline">
                    &larr; {{ __('Back to Clubs') }}
                </a>

                <a href="{{ route('clubs.athletes.create', $club) }}" class="inline-block px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-md text-sm font-semibold">
                    {{ __('Add Athlete') }}
                </a>
            </div>

            @if (session('status'))
                <p class="text-sm text-green-600 dark:text-green-400">{{ __(str_replace('-', ' ', ucfirst(session('status')))) }}</p>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                @if ($athletes->isEmpty())
                    <p class="p-6 text-gray-600 dark:text-gray-400">{{ __('No athletes yet.') }}</p>
                @else
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-6 py-3">{{ __('Full Name') }}</th>
                                <th class="px-6 py-3">{{ __('Gender') }}</th>
                                <th class="px-6 py-3">{{ __('Age') }}</th>
                                <th class="px-6 py-3">{{ __('Blood Type') }}</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($athletes as $athlete)
                                <tr>
                                    <td class="px-6 py-4 text-gray-900 dark:text-gray-100">
                                        {{ $athlete->full_name }}
                                        @if ($athlete->nickname)
                                            <span class="text-gray-500 dark:text-gray-400">({{ $athlete->nickname }})</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ ucfirst($athlete->gender) }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $athlete->age }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $athlete->blood_type ?? '-' }}</td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        @if ($athlete->registrations->isNotEmpty())
                                            <a href="{{ route('registrations.show', $athlete->registrations->first()) }}" class="text-indigo-600 dark:text-indigo-400 underline">{{ __('View Registration') }}</a>
                                        @else
                                            <a href="{{ route('registrations.create', [$club, $athlete]) }}" class="text-indigo-600 dark:text-indigo-400 underline">{{ __('Register') }}</a>
                                        @endif
                                        <a href="{{ route('clubs.athletes.edit', [$club, $athlete]) }}" class="text-indigo-600 dark:text-indigo-400 underline">{{ __('Edit') }}</a>
                                        @if ($athlete->registrations->isEmpty())
                                            <form method="post" action="{{ route('clubs.athletes.destroy', [$club, $athlete]) }}" class="inline" onsubmit="return confirm('{{ __('Delete this athlete?') }}')">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="text-red-600 dark:text-red-400 underline">{{ __('Delete') }}</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
