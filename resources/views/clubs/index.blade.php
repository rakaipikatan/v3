<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Clubs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex justify-between items-center">
                @if (session('status') === 'club-created')
                    <p class="text-sm text-green-600 dark:text-green-400">{{ __('Club created.') }}</p>
                @elseif (session('status') === 'club-updated')
                    <p class="text-sm text-green-600 dark:text-green-400">{{ __('Club updated.') }}</p>
                @elseif (session('status') === 'club-deleted')
                    <p class="text-sm text-green-600 dark:text-green-400">{{ __('Club deleted.') }}</p>
                @else
                    <span></span>
                @endif

                <a href="{{ route('clubs.create') }}" class="inline-block px-4 py-2 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-md text-sm font-semibold">
                    {{ __('Add Club') }}
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg overflow-hidden">
                @if ($clubs->isEmpty())
                    <p class="p-6 text-gray-600 dark:text-gray-400">{{ __('No clubs yet.') }}</p>
                @else
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-6 py-3">{{ __('Club Name') }}</th>
                                <th class="px-6 py-3">{{ __('PIC') }}</th>
                                <th class="px-6 py-3">{{ __('City') }}</th>
                                <th class="px-6 py-3">{{ __('Province') }}</th>
                                <th class="px-6 py-3">{{ __('Athletes') }}</th>
                                <th class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($clubs as $club)
                                <tr>
                                    <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $club->club_name }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $club->club_pic }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $club->city }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $club->province }}</td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                        <a href="{{ route('clubs.athletes.index', $club) }}" class="underline">{{ $club->athletes_count }}</a>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-3">
                                        <a href="{{ route('clubs.athletes.index', $club) }}" class="text-indigo-600 dark:text-indigo-400 underline">{{ __('Athletes') }}</a>
                                        <a href="{{ route('clubs.edit', $club) }}" class="text-indigo-600 dark:text-indigo-400 underline">{{ __('Edit') }}</a>
                                        @if ($club->athletes_count === 0)
                                            <form method="post" action="{{ route('clubs.destroy', $club) }}" class="inline" onsubmit="return confirm('{{ __('Delete this club?') }}')">
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
