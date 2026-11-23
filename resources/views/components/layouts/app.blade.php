@props([
    'title' => 'DompetKu',
    'headerMonth' => null,
])

@php
    $activeRoute = request()->route()?->getName();
    $displayMonth = $headerMonth ?? \App\Support\Format::monthYear(now());
    $categories = \App\Models\Transaction::categories();
@endphp

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
<body class="min-h-screen bg-[#f5f8fa] text-slate-900 antialiased">
    <div class="flex min-h-screen">
        {{-- Mobile Sidebar Overlay --}}
        <div id="mobile-sidebar-backdrop" class="fixed inset-0 z-40 hidden bg-slate-900/40 backdrop-blur-xs lg:hidden" onclick="toggleMobileSidebar(false)"></div>

        {{-- Left Sidebar --}}
        <aside id="app-sidebar" class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col justify-between border-r border-slate-200/70 bg-white px-5 py-6 transition-transform duration-200 lg:static lg:translate-x-0">
            <div>
                <div class="mb-8 flex items-center justify-between px-2">
                    <a href="{{ route('home') }}" class="focus:outline-none">
                        <x-brand-logo size="md" />
                    </a>
                    <button type="button" onclick="toggleMobileSidebar(false)" class="rounded-lg p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 lg:hidden" aria-label="Tutup menu">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
                    </button>
                </div>

                <nav class="space-y-1.5" aria-label="Navigasi Utama">
                    <a href="{{ route('home') }}"
                       class="flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-semibold transition-all {{ $activeRoute === 'home' ? 'bg-[#084734] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7" rx="1.5" />
                            <rect x="14" y="3" width="7" height="7" rx="1.5" />
                            <rect x="3" y="14" width="7" height="7" rx="1.5" />
                            <rect x="14" y="14" width="7" height="7" rx="1.5" />
                        </svg>
                        <span>Home</span>
                    </a>

                    <a href="{{ route('reports.index') }}"
                       class="flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-semibold transition-all {{ $activeRoute === 'reports.index' ? 'bg-[#084734] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 17l6-6 4 4 8-8" />
                            <path d="M5 21v-3" />
                            <path d="M10 21v-6" />
                            <path d="M15 21v-4" />
                            <path d="M20 21v-9" />
                        </svg>
                        <span>Reports</span>
                    </a>

                    <a href="{{ route('charts.index') }}"
                       class="flex items-center gap-3.5 rounded-xl px-4 py-3 text-sm font-semibold transition-all {{ $activeRoute === 'charts.index' ? 'bg-[#084734] text-white shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                        <svg class="h-5 w-5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 3v18" />
                            <path d="M12 12h9" />
                        </svg>
                        <span>Charts</span>
                    </a>
                </nav>
            </div>

            {{-- Bottom Status Card --}}
            <div class="rounded-2xl bg-[#f1f5f9] px-4 py-3.5">
                <p class="text-[10px] font-bold tracking-[0.08em] text-slate-500 uppercase">Status Akun</p>
                <div class="mt-1.5 flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-600"></span>
                    <span class="text-sm font-bold text-slate-800">Tersinkronisasi</span>
                </div>
            </div>
        </aside>

        {{-- Right Content Wrapper --}}
        <div class="flex min-w-0 flex-1 flex-col">
            {{-- Top Header Bar --}}
            <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-slate-200/70 bg-white/95 px-4 backdrop-blur-xs sm:px-8">
                <div class="flex items-center gap-3">
                    <button type="button" onclick="toggleMobileSidebar(true)" class="rounded-lg p-2 text-slate-600 hover:bg-slate-100 lg:hidden" aria-label="Buka menu">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="inline-flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-1.5 text-sm font-semibold text-slate-700 ring-1 ring-slate-200/70">
                        <svg class="h-4 w-4 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" />
                        </svg>
                        <span>{{ $displayMonth }}</span>
                    </div>
                </div>

                <div class="flex items-center gap-2.5 sm:gap-3">
                    @guest
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-3.5 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-200">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                                <polyline points="10 17 15 12 10 7" />
                                <line x1="15" y1="12" x2="3" y2="12" />
                            </svg>
                            <span>Login</span>
                        </a>
                    @endguest

                    <button type="button" onclick="openQuickTransaction()" class="inline-flex items-center gap-1.5 rounded-xl bg-[#084734] px-4 py-2 text-sm font-semibold text-white shadow-xs transition hover:bg-[#063829] cursor-pointer">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                        <span>Tambah Transaksi</span>
                    </button>

                    {{-- User Profile Avatar / Menu --}}
                    <div class="relative">
                        @auth
                            <button type="button" onclick="toggleProfileMenu()" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#084734] text-white shadow-xs transition hover:bg-[#063829] cursor-pointer" title="{{ auth()->user()->name }}">
                                <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M20 21a8 8 0 0 0-16 0" />
                                </svg>
                            </button>
                            <div id="profile-dropdown" class="absolute right-0 mt-2 hidden w-56 rounded-2xl border border-slate-100 bg-white p-2 shadow-lg">
                                <div class="border-b border-slate-100 px-3 py-2.5">
                                    <p class="truncate text-sm font-bold text-slate-900">{{ auth()->user()->name }}</p>
                                    <p class="truncate text-xs text-slate-500">{{ '@' . auth()->user()->username }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-2 rounded-xl px-3 py-2 text-left text-sm font-semibold text-rose-600 transition hover:bg-rose-50 cursor-pointer">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="flex h-9 w-9 items-center justify-center rounded-full bg-[#084734] text-white shadow-xs transition hover:bg-[#063829]" title="Masuk ke Akun">
                                <svg class="h-4.5 w-4.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M20 21a8 8 0 0 0-16 0" />
                                </svg>
                            </a>
                        @endauth
                    </div>
                </div>
            </header>

            {{-- Flash Status Toast --}}
            @if (session('status'))
                <div class="mx-4 mt-4 sm:mx-8">
                    <div class="flex items-center justify-between rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                            <span>{{ session('status') }}</span>
                        </div>
                        <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-emerald-600 hover:text-emerald-800 cursor-pointer">&times;</button>
                    </div>
                </div>
            @endif

            {{-- Main Content --}}
            <main class="flex-1 px-4 py-6 sm:px-8 sm:py-7">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- Quick Transaction Modal (for pages without inline form) --}}
    <div id="quick-tx-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 p-4 backdrop-blur-xs">
        <div class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold tracking-wider text-emerald-700 uppercase">Formulir Cepat</p>
                    <h3 class="text-lg font-bold text-slate-900">Tambah Transaksi</h3>
                </div>
                <button type="button" onclick="closeQuickTransactionModal()" class="rounded-xl p-1.5 text-slate-400 hover:bg-slate-100 hover:text-slate-600 cursor-pointer">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
                </button>
            </div>

            <form method="POST" action="{{ route('transactions.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="type" id="modal-tx-type" value="expense">

                <div class="grid grid-cols-2 gap-2 rounded-xl bg-slate-100 p-1">
                    <button type="button" id="modal-btn-expense" onclick="setModalTxType('expense')" class="rounded-lg bg-[#084734] py-2 text-sm font-semibold text-white transition cursor-pointer">Pengeluaran</button>
                    <button type="button" id="modal-btn-income" onclick="setModalTxType('income')" class="rounded-lg py-2 text-sm font-semibold text-slate-600 transition hover:text-slate-900 cursor-pointer">Pemasukan</button>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-700">Judul Transaksi</label>
                    <input type="text" name="title" required placeholder="Contoh: Belanja Bulanan, Gajian..." class="w-full rounded-xl bg-[#edf2f8] px-3.5 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-[#084734]/20 focus:outline-none">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="mb-1.5 block text-xs font-bold text-slate-700">Nominal (Rp)</label>
                        <input type="number" name="amount" min="1" required placeholder="0" class="w-full rounded-xl bg-[#edf2f8] px-3.5 py-2.5 text-sm font-semibold text-slate-800 placeholder-slate-400 focus:bg-white focus:ring-2 focus:ring-[#084734]/20 focus:outline-none">
                    </div>
                    <div>
                        <label class="mb-1.5 block text-xs font-bold text-slate-700">Tanggal</label>
                        <input type="date" name="occurred_at" required value="{{ now()->format('Y-m-d') }}" class="w-full rounded-xl bg-[#edf2f8] px-3.5 py-2.5 text-sm text-slate-800 focus:bg-white focus:ring-2 focus:ring-[#084734]/20 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="mb-1.5 block text-xs font-bold text-slate-700">Kategori</label>
                    <select name="category" class="w-full rounded-xl bg-[#edf2f8] px-3.5 py-2.5 text-sm font-medium text-slate-800 focus:bg-white focus:ring-2 focus:ring-[#084734]/20 focus:outline-none">
                        @foreach ($categories as $key => $meta)
                            <option value="{{ $key }}">{{ $meta['full_label'] }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="mt-2 w-full rounded-xl bg-[#084734] py-3 text-sm font-bold tracking-wide text-white shadow-sm transition hover:bg-[#063829] cursor-pointer">
                    SIMPAN TRANSAKSI
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleMobileSidebar(open) {
            const sidebar = document.getElementById('app-sidebar');
            const backdrop = document.getElementById('mobile-sidebar-backdrop');
            if (!sidebar || !backdrop) return;
            sidebar.classList.toggle('-translate-x-full', !open);
            backdrop.classList.toggle('hidden', !open);
        }

        function toggleProfileMenu() {
            const menu = document.getElementById('profile-dropdown');
            if (menu) menu.classList.toggle('hidden');
        }

        function openQuickTransaction() {
            const inlineInput = document.getElementById('quick-tx-title');
            if (inlineInput) {
                inlineInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                setTimeout(() => inlineInput.focus(), 250);
                return;
            }
            const modal = document.getElementById('quick-tx-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeQuickTransactionModal() {
            const modal = document.getElementById('quick-tx-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function setModalTxType(type) {
            const input = document.getElementById('modal-tx-type');
            const btnExpense = document.getElementById('modal-btn-expense');
            const btnIncome = document.getElementById('modal-btn-income');
            if (!input || !btnExpense || !btnIncome) return;
            input.value = type;
            if (type === 'expense') {
                btnExpense.className = 'rounded-lg bg-[#084734] py-2 text-sm font-semibold text-white transition cursor-pointer';
                btnIncome.className = 'rounded-lg py-2 text-sm font-semibold text-slate-600 transition hover:text-slate-900 cursor-pointer';
            } else {
                btnIncome.className = 'rounded-lg bg-[#084734] py-2 text-sm font-semibold text-white transition cursor-pointer';
                btnExpense.className = 'rounded-lg py-2 text-sm font-semibold text-slate-600 transition hover:text-slate-900 cursor-pointer';
            }
        }

        document.addEventListener('click', function (e) {
            const menu = document.getElementById('profile-dropdown');
            if (menu && !menu.classList.contains('hidden') && !menu.parentElement.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
