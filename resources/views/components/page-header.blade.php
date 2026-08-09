@props(['eyebrow' => null, 'title', 'accent' => null, 'description' => null])
<section class="bg-gray-900 dark:bg-black text-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20">
        @if ($eyebrow)
            <p class="text-xs font-bold uppercase tracking-widest text-indigo-400">{{ $eyebrow }}</p>
        @endif
        <h1 class="mt-2 text-4xl sm:text-5xl font-black tracking-tight">
            {{ $title }}
            @if ($accent)
                <span class="text-indigo-400">{{ $accent }}</span>
            @endif
        </h1>
        @if ($description)
            <p class="mt-4 text-gray-300 max-w-xl">{{ $description }}</p>
        @endif
    </div>
</section>
