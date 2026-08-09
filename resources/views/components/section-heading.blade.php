@props(['eyebrow' => null, 'title', 'accent' => null])
<div>
    @if ($eyebrow)
        <p class="text-xs font-bold uppercase tracking-widest text-indigo-600 dark:text-indigo-400">{{ $eyebrow }}</p>
    @endif
    <h2 class="mt-1 text-3xl sm:text-4xl font-black tracking-tight">
        {{ $title }}
        @if ($accent)
            <span class="text-indigo-600 dark:text-indigo-400">{{ $accent }}</span>
        @endif
    </h2>
</div>
