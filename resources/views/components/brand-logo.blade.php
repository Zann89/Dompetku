@props([
    'size' => 'md',
    'showText' => true,
    'subtitle' => null,
])

@php
    $iconClasses = match ($size) {
        'sm' => 'h-7 w-7',
        'lg' => 'h-10 w-10',
        default => 'h-8 w-8',
    };
    $textClasses = match ($size) {
        'sm' => 'text-sm',
        'lg' => 'text-xl',
        default => 'text-base',
    };
@endphp

<div {{ $attributes->merge(['class' => 'inline-flex items-center gap-2']) }}>
    <svg class="{{ $iconClasses }} shrink-0" viewBox="0 0 44 40" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        {{-- Back green bills --}}
        <rect x="8" y="4" width="16" height="12" rx="2.5" transform="rotate(-14 8 4)" fill="#22c55e" />
        <rect x="16" y="3" width="16" height="12" rx="2.5" transform="rotate(8 16 3)" fill="#4ade80" />
        {{-- Upward trend arrow --}}
        <path d="M12 15L19 9L23 12L31 5" stroke="#15803d" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
        <path d="M27 5H31V9" stroke="#15803d" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
        {{-- Wallet body --}}
        <rect x="4" y="13" width="32" height="23" rx="6" fill="#0d5c3f" />
        <path d="M4 19C4 15.6863 6.68629 13 10 13H30C33.3137 13 36 15.6863 36 19V20H4V19Z" fill="#157a55" />
        {{-- Wallet clasp --}}
        <rect x="26" y="21" width="12" height="8" rx="4" fill="#4ade80" />
        <circle cx="30" cy="25" r="2" fill="#084734" />
    </svg>

    @if ($showText)
        <div class="flex flex-col leading-none">
            <span class="{{ $textClasses }} font-extrabold tracking-tight">
                <span class="text-emerald-200/90 drop-shadow-[0_0.5px_0_rgba(15,23,42,0.22)]">Dompet</span><span class="text-emerald-500">Ku</span>
            </span>
            @if ($subtitle)
                <span class="mt-0.5 text-[10px] font-semibold tracking-[0.16em] text-slate-400 uppercase">{{ $subtitle }}</span>
            @endif
        </div>
    @endif
</div>
