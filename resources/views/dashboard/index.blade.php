@php
    use App\Enums\TransactionType;
    use App\Models\Transaction;
    use App\Support\Format;
@endphp

<x-layouts.app title="Ringkasan Dompet & Arus Kas" :headerMonth="Format::monthYear($selectedMonth)">
    {{-- Page Header & Month Switcher --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-[11px] font-bold tracking-[0.12em] text-emerald-700 uppercase">
                Dashboard Finansial <span class="mx-1 text-emerald-500">&bull;</span> <span class="font-semibold tracking-normal text-emerald-600 normal-case">Terupdate Real-Time</span>
            </p>
            <h1 class="mt-1 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-[28px]">
                Ringkasan Dompet &amp; Arus Kas
            </h1>
        </div>

        <div class="inline-flex items-center gap-1 rounded-2xl border border-slate-200/80 bg-white p-1.5 shadow-2xs">
            <a href="{{ route('home', ['month' => $prevMonth->format('Y-m'), 'type' => $filterType]) }}"
               class="flex h-8 w-8 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-100 hover:text-slate-800"
               title="Bulan Sebelumnya">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            </a>

            <a href="{{ route('home', ['month' => $selectedMonth->format('Y-m'), 'type' => $filterType]) }}"
               class="inline-flex items-center gap-1.5 rounded-xl bg-[#084734] px-3.5 py-1.5 text-xs font-bold text-white shadow-2xs">
                <svg class="h-3.5 w-3.5 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                <span>{{ Format::monthYear($selectedMonth) }}</span>
            </a>

            <a href="{{ route('home', ['month' => $nextMonth->format('Y-m'), 'type' => $filterType]) }}"
               class="rounded-xl px-3 py-1.5 text-xs font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900">
                {{ Format::monthYear($nextMonth) }}
            </a>

            <a href="{{ route('home', ['month' => $nextMonth->format('Y-m'), 'type' => $filterType]) }}"
               class="flex h-8 w-8 items-center justify-center rounded-xl text-slate-500 transition hover:bg-slate-100 hover:text-slate-800"
               title="Bulan Berikutnya">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </a>
        </div>
    </div>

    {{-- 3 Summary KPI Cards --}}
    <div class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-[1.45fr_1fr_1fr]">
        {{-- Total Saldo Kas --}}
        <div class="balance-card-gradient relative overflow-hidden rounded-2xl p-6 text-white shadow-[0_14px_34px_-12px_rgba(8,71,52,0.5)]">
            <div class="pointer-events-none absolute -top-10 -right-10 h-40 w-40 rounded-full bg-emerald-400/10 blur-2xl"></div>
            <div class="flex items-center justify-between">
                <div class="inline-flex items-center gap-2 text-[11px] font-bold tracking-[0.12em] text-emerald-200/90 uppercase">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="6" width="20" height="12" rx="2" />
                        <circle cx="12" cy="12" r="2" />
                        <path d="M6 12h.01M18 12h.01" />
                    </svg>
                    <span>Total Saldo Kas</span>
                </div>
                <span class="rounded-full bg-white/15 px-2.5 py-0.5 text-[11px] font-semibold text-emerald-100">Aktif</span>
            </div>
            <p class="mt-5 text-3xl font-extrabold tracking-tight sm:text-4xl">
                {{ Format::rupiah($totalBalance) }}
            </p>
        </div>

        {{-- Pemasukan --}}
        <div class="rounded-2xl border border-slate-200/70 bg-white p-6 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold tracking-[0.12em] text-slate-400 uppercase">Pemasukan</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14" />
                        <path d="m19 12-7 7-7-7" />
                    </svg>
                </span>
            </div>
            <p class="mt-6 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-[28px]">
                {{ Format::rupiah($monthlyIncome) }}
            </p>
        </div>

        {{-- Pengeluaran --}}
        <div class="rounded-2xl border border-slate-200/70 bg-white p-6 shadow-2xs">
            <div class="flex items-center justify-between">
                <span class="text-[11px] font-bold tracking-[0.12em] text-slate-400 uppercase">Pengeluaran</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-rose-50 text-rose-500">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 19V5" />
                        <path d="m5 12 7-7 7 7" />
                    </svg>
                </span>
            </div>
            <p class="mt-6 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-[28px]">
                {{ Format::rupiah($monthlyExpense) }}
            </p>
        </div>
    </div>

    {{-- Main 2-Column Section: Daftar Transaksi & Tambah Transaksi Cepat --}}
    <div class="mt-7 grid grid-cols-1 gap-6 lg:grid-cols-12">
        {{-- Left Column: Daftar Transaksi --}}
        <div class="lg:col-span-7">
            <div class="mb-3.5 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <svg class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                        <path d="M8 7h8M8 11h8M8 15h5" />
                    </svg>
                    <h2 class="text-lg font-extrabold text-slate-900">Daftar Transaksi</h2>
                    <span class="rounded-full bg-sky-100/80 px-2.5 py-0.5 text-[11px] font-bold text-sky-800">
                        {{ $transactionCount }} Transaksi
                    </span>
                </div>

                {{-- Filter Dropdown --}}
                <div class="relative">
                    <button type="button" onclick="toggleFilterMenu()" class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:bg-slate-50 cursor-pointer" title="Filter Transaksi">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 6h18M7 12h10M10 18h4"/></svg>
                    </button>
                    <div id="tx-filter-menu" class="absolute right-0 z-20 mt-2 hidden w-44 rounded-xl border border-slate-100 bg-white p-1.5 shadow-lg">
                        <a href="{{ route('home', ['month' => $selectedMonth->format('Y-m'), 'type' => 'all']) }}" class="block rounded-lg px-3 py-2 text-xs font-semibold {{ $filterType === 'all' ? 'bg-[#084734] text-white' : 'text-slate-700 hover:bg-slate-50' }}">Semua Transaksi</a>
                        <a href="{{ route('home', ['month' => $selectedMonth->format('Y-m'), 'type' => 'income']) }}" class="block rounded-lg px-3 py-2 text-xs font-semibold {{ $filterType === 'income' ? 'bg-[#084734] text-white' : 'text-slate-700 hover:bg-slate-50' }}">Hanya Pemasukan</a>
                        <a href="{{ route('home', ['month' => $selectedMonth->format('Y-m'), 'type' => 'expense']) }}" class="block rounded-lg px-3 py-2 text-xs font-semibold {{ $filterType === 'expense' ? 'bg-[#084734] text-white' : 'text-slate-700 hover:bg-slate-50' }}">Hanya Pengeluaran</a>
                    </div>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200/70 bg-white shadow-2xs">
                @forelse ($groupedTransactions as $group)
                    {{-- Date Group Header --}}
                    <div class="flex items-center justify-between border-b border-slate-100 bg-[#f1f5f9]/80 px-5 py-2.5">
                        <div class="inline-flex items-center gap-2 text-xs font-bold text-slate-700">
                            <svg class="h-3.5 w-3.5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            <span>{{ $group['date_label'] }}</span>
                        </div>
                        <span class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">{{ $group['day_label'] }}</span>
                    </div>

                    {{-- Transactions in Date Group --}}
                    <div class="divide-y divide-slate-100">
                        @foreach ($group['items'] as $tx)
                            @php
                                $meta = Transaction::metaFor($tx->category);
                                $isIncome = $tx->type === TransactionType::Income;
                            @endphp
                            <div class="group flex items-center justify-between gap-4 px-5 py-4 transition hover:bg-slate-50/70">
                                <div class="flex min-w-0 items-center gap-3.5">
                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl {{ $meta['icon_bg'] }} {{ $meta['icon_text'] }}">
                                        <x-category-icon :name="$meta['icon']" class="h-5 w-5" />
                                    </div>
                                    <div class="min-w-0">
                                        <p class="truncate text-sm font-bold text-slate-900">{{ $tx->title }}</p>
                                        <div class="mt-1 flex items-center gap-2">
                                            <span class="rounded-md px-2 py-0.5 text-[10px] font-bold {{ $meta['badge_bg'] }} {{ $meta['badge_text'] }}">
                                                {{ $meta['label'] }}
                                            </span>
                                            <span class="truncate text-xs text-slate-400">{{ $tx->description }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex shrink-0 items-center gap-3">
                                    <div class="text-right">
                                        <p class="text-sm font-extrabold {{ $isIncome ? 'text-emerald-700' : 'text-rose-700' }}">
                                            {{ $isIncome ? '+ ' : '- ' }}{{ Format::rupiah($tx->amount) }}
                                        </p>
                                        <p class="mt-0.5 text-[11px] font-medium text-slate-400">
                                            {{ $tx->occurred_at->format('H:i') }} WIB
                                        </p>
                                    </div>

                                    <form method="POST" action="{{ route('transactions.destroy', $tx) }}" onsubmit="return confirm('Hapus transaksi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg p-1.5 text-slate-300 opacity-0 transition group-hover:opacity-100 hover:bg-rose-50 hover:text-rose-600 cursor-pointer" title="Hapus Transaksi">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @empty
                    <div class="px-6 py-14 text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-400">
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z"/></svg>
                        </div>
                        <p class="mt-3 text-sm font-bold text-slate-700">Belum ada transaksi di bulan ini</p>
                        <p class="mt-1 text-xs text-slate-400">Gunakan formulir Tambah Transaksi Cepat di samping untuk mulai mencatat.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Right Column: Tambah Transaksi Cepat --}}
        <div class="lg:col-span-5">
            <div class="mb-3.5 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                        <path d="M12 8v8M8 12h8" />
                    </svg>
                    <h2 class="text-lg font-extrabold text-slate-900">Tambah Transaksi Cepat</h2>
                </div>
                <span class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-[10px] font-extrabold tracking-wider text-emerald-800 uppercase">
                    Formulir Cepat
                </span>
            </div>

            <div class="rounded-2xl border border-slate-200/70 bg-white p-6 shadow-2xs">
                @if ($errors->any())
                    <div class="mb-4 rounded-xl border border-rose-200 bg-rose-50 px-3.5 py-2.5 text-xs font-medium text-rose-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('transactions.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="type" id="quick-tx-type" value="{{ old('type', 'expense') }}">

                    {{-- Expense / Income Toggle --}}
                    <div class="grid grid-cols-2 gap-1.5 rounded-xl bg-[#f1f5f9] p-1">
                        <button type="button" id="quick-btn-expense" onclick="setQuickTxType('expense')"
                                class="inline-flex items-center justify-center gap-1.5 rounded-lg py-2.5 text-xs font-bold transition cursor-pointer {{ old('type', 'expense') === 'expense' ? 'bg-[#084734] text-white shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="22 17 13.5 8.5 8.5 13.5 2 7"/><polyline points="16 17 22 17 22 11"/></svg>
                            <span>Pengeluaran</span>
                        </button>
                        <button type="button" id="quick-btn-income" onclick="setQuickTxType('income')"
                                class="inline-flex items-center justify-center gap-1.5 rounded-lg py-2.5 text-xs font-bold transition cursor-pointer {{ old('type') === 'income' ? 'bg-[#084734] text-white shadow-xs' : 'text-slate-600 hover:text-slate-900' }}">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                            <span>Pemasukan</span>
                        </button>
                    </div>

                    {{-- Judul Transaksi --}}
                    <div>
                        <div class="mb-1.5 flex items-center justify-between">
                            <label for="quick-tx-title" class="text-xs font-bold text-slate-800">Judul Transaksi</label>
                            <span class="text-[11px] font-medium text-slate-400">Wajib</span>
                        </div>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                            </span>
                            <input id="quick-tx-title" name="title" type="text" value="{{ old('title') }}" required
                                   placeholder="Contoh: Belanja Bulanan, Gajian..."
                                   class="w-full rounded-xl bg-[#edf2f8] py-3 pr-4 pl-10 text-sm text-slate-800 placeholder-slate-400 transition focus:bg-white focus:ring-2 focus:ring-[#084734]/20 focus:outline-none">
                        </div>
                    </div>

                    {{-- Nominal (Rp) --}}
                    <div>
                        <div class="mb-1.5 flex items-center justify-between">
                            <label for="quick-tx-amount" class="text-xs font-bold text-slate-800">Nominal (Rp)</label>
                            <span class="text-[11px] font-bold text-emerald-700">Mata Uang IDR</span>
                        </div>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-sm font-bold text-slate-500">Rp</span>
                            <input id="quick-tx-amount" name="amount" type="number" min="1" value="{{ old('amount') }}" required
                                   placeholder="0"
                                   class="w-full rounded-xl bg-[#edf2f8] py-3 pr-4 pl-11 text-sm font-bold text-slate-800 placeholder-slate-400 transition focus:bg-white focus:ring-2 focus:ring-[#084734]/20 focus:outline-none">
                        </div>
                    </div>

                    {{-- Tanggal --}}
                    <div>
                        <label for="quick-tx-date" class="mb-1.5 block text-xs font-bold text-slate-800">Tanggal</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            </span>
                            <input id="quick-tx-date" name="occurred_at" type="date"
                                   value="{{ old('occurred_at', $selectedMonth->isCurrentMonth() ? now()->format('Y-m-d') : $selectedMonth->format('Y-m-d')) }}" required
                                   class="w-full rounded-xl bg-[#edf2f8] py-3 pr-4 pl-10 text-sm font-medium text-slate-800 transition focus:bg-white focus:ring-2 focus:ring-[#084734]/20 focus:outline-none">
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label for="quick-tx-category" class="mb-1.5 block text-xs font-bold text-slate-800">Kategori</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-500">
                                <x-category-icon name="shapes" class="h-4 w-4" />
                            </span>
                            <select id="quick-tx-category" name="category"
                                    class="w-full appearance-none rounded-xl bg-[#edf2f8] py-3 pr-9 pl-10 text-sm font-semibold text-slate-800 transition focus:bg-white focus:ring-2 focus:ring-[#084734]/20 focus:outline-none">
                                @foreach ($categories as $key => $meta)
                                    <option value="{{ $key }}" data-tx-type="{{ $meta['type'] }}" {{ old('category', 'Tagihan') === $key ? 'selected' : '' }}>
                                        {{ $meta['full_label'] }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-500">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m6 9 6 6 6-6"/></svg>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="mt-2 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-[#084734] px-5 py-3.5 text-xs font-extrabold tracking-[0.08em] text-white uppercase shadow-sm transition hover:bg-[#063829] cursor-pointer">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        <span>Simpan Transaksi</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function setQuickTxType(type) {
            const input = document.getElementById('quick-tx-type');
            const btnExpense = document.getElementById('quick-btn-expense');
            const btnIncome = document.getElementById('quick-btn-income');
            const select = document.getElementById('quick-tx-category');
            if (!input || !btnExpense || !btnIncome) return;

            input.value = type;
            const activeClass = 'inline-flex items-center justify-center gap-1.5 rounded-lg py-2.5 text-xs font-bold transition cursor-pointer bg-[#084734] text-white shadow-xs';
            const inactiveClass = 'inline-flex items-center justify-center gap-1.5 rounded-lg py-2.5 text-xs font-bold transition cursor-pointer text-slate-600 hover:text-slate-900';

            btnExpense.className = type === 'expense' ? activeClass : inactiveClass;
            btnIncome.className = type === 'income' ? activeClass : inactiveClass;

            if (select) {
                const matchingOption = Array.from(select.options).find(opt => opt.dataset.txType === type);
                if (matchingOption) {
                    select.value = matchingOption.value;
                }
            }
        }

        function toggleFilterMenu() {
            const menu = document.getElementById('tx-filter-menu');
            if (menu) menu.classList.toggle('hidden');
        }

        document.addEventListener('click', function (e) {
            const menu = document.getElementById('tx-filter-menu');
            if (menu && !menu.classList.contains('hidden') && !menu.parentElement.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</x-layouts.app>
