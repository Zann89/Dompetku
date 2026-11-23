@props([
    'title' => 'DompetKu',
    'showHeaderBrandText' => false,
])

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} — DompetKu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-backdrop min-h-screen text-slate-900 antialiased">
    <div class="mx-auto flex min-h-screen max-w-6xl flex-col px-5 py-6 sm:px-8">
        {{-- Top Bar --}}
        <header class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 focus:outline-none">
                @if ($showHeaderBrandText)
                    <x-brand-logo size="sm" />
                    <div class="flex flex-col leading-tight">
                        <span class="text-base font-bold text-slate-800">DompetKu</span>
                        <span class="text-[9px] font-bold tracking-[0.16em] text-slate-400 uppercase">Financial Hub</span>
                    </div>
                @else
                    <x-brand-logo size="sm" />
                @endif
            </a>

            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200/80 bg-white px-4 py-2 text-xs font-semibold text-slate-700 shadow-xs transition hover:border-slate-300 hover:bg-slate-50">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5" />
                    <path d="m12 19-7-7 7-7" />
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </header>

        {{-- Centered Card Content --}}
        <main class="flex flex-1 items-center justify-center py-8">
            {{ $slot }}
        </main>
    </div>

    <script>
        function togglePasswordField(inputId, btn) {
            const input = document.getElementById(inputId);
            if (!input) return;
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            btn.classList.toggle('text-emerald-700', isPassword);
        }
    </script>
</body>
</html>
