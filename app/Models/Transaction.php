<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'title', 'description', 'type', 'category', 'amount', 'occurred_at'])]
class Transaction extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => TransactionType::class,
            'amount' => 'integer',
            'occurred_at' => 'datetime',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope transactions to the current authenticated user or public workspace.
     *
     * @param  Builder<Transaction>  $query
     * @return Builder<Transaction>
     */
    public function scopeForWorkspace(Builder $query, ?int $userId): Builder
    {
        if ($userId !== null) {
            return $query->where('user_id', $userId);
        }

        return $query->whereNull('user_id');
    }

    /**
     * Category metadata for charts, icons, colors, and subtitles.
     *
     * @return array<string, array{label: string, full_label: string, subtitle: string, dominant_desc: string, color: string, icon_bg: string, icon_text: string, badge_bg: string, badge_text: string, default_desc: string, type: string, icon: string}>
     */
    public static function categories(): array
    {
        return [
            'Tagihan' => [
                'label' => 'Tagihan',
                'full_label' => 'Tagihan & Kewajiban',
                'subtitle' => 'Listrik, Internet, Asuransi',
                'dominant_desc' => 'Mencakup cicilan, utilitas rumah tangga, dan langganan wajib bulanan.',
                'color' => '#17c3e6',
                'icon_bg' => 'bg-rose-50',
                'icon_text' => 'text-rose-500',
                'badge_bg' => 'bg-slate-100',
                'badge_text' => 'text-slate-600',
                'default_desc' => 'PLN & PDAM',
                'type' => 'expense',
                'icon' => 'bolt',
            ],
            'Makanan' => [
                'label' => 'Makanan',
                'full_label' => 'Makanan & Konsumsi',
                'subtitle' => 'Bahan Dapur & Konsumsi',
                'dominant_desc' => 'Mencakup belanja harian, makan di luar, dan kebutuhan dapur.',
                'color' => '#facc15',
                'icon_bg' => 'bg-sky-50',
                'icon_text' => 'text-slate-600',
                'badge_bg' => 'bg-sky-50',
                'badge_text' => 'text-sky-700',
                'default_desc' => 'Restoran Keluarga',
                'type' => 'expense',
                'icon' => 'utensils',
            ],
            'Lainnya' => [
                'label' => 'Lainnya',
                'full_label' => 'Pengeluaran Lainnya',
                'subtitle' => 'Administrasi & Biaya Mini',
                'dominant_desc' => 'Mencakup biaya administrasi bank dan pengeluaran insidental.',
                'color' => '#f46a7d',
                'icon_bg' => 'bg-indigo-50',
                'icon_text' => 'text-indigo-600',
                'badge_bg' => 'bg-indigo-50',
                'badge_text' => 'text-indigo-700',
                'default_desc' => 'Administrasi Bank',
                'type' => 'expense',
                'icon' => 'shapes',
            ],
            'Transportasi' => [
                'label' => 'Transportasi',
                'full_label' => 'Transportasi & Mobilitas',
                'subtitle' => 'BBM, Tol, Transportasi Umum',
                'dominant_desc' => 'Mencakup biaya perjalanan harian, bahan bakar, dan parkir.',
                'color' => '#8b5cf6',
                'icon_bg' => 'bg-violet-50',
                'icon_text' => 'text-violet-600',
                'badge_bg' => 'bg-violet-50',
                'badge_text' => 'text-violet-700',
                'default_desc' => 'Perjalanan Harian',
                'type' => 'expense',
                'icon' => 'car',
            ],
            'Belanja' => [
                'label' => 'Belanja',
                'full_label' => 'Belanja & Gaya Hidup',
                'subtitle' => 'Kebutuhan Pribadi & Rumah',
                'dominant_desc' => 'Mencakup pembelian barang rumah tangga dan kebutuhan pribadi.',
                'color' => '#f97316',
                'icon_bg' => 'bg-orange-50',
                'icon_text' => 'text-orange-600',
                'badge_bg' => 'bg-orange-50',
                'badge_text' => 'text-orange-700',
                'default_desc' => 'Belanja Bulanan',
                'type' => 'expense',
                'icon' => 'bag',
            ],
            'Gaji' => [
                'label' => 'Gaji',
                'full_label' => 'Gaji & Penghasilan Utama',
                'subtitle' => 'Gaji Bulanan & Tunjangan',
                'dominant_desc' => 'Sumber pemasukan utama rutin bulanan dari pekerjaan.',
                'color' => '#10b981',
                'icon_bg' => 'bg-emerald-50',
                'icon_text' => 'text-emerald-600',
                'badge_bg' => 'bg-emerald-50',
                'badge_text' => 'text-emerald-700',
                'default_desc' => 'Penerimaan Kas',
                'type' => 'income',
                'icon' => 'wallet',
            ],
            'Bonus' => [
                'label' => 'Bonus',
                'full_label' => 'Bonus & Insentif',
                'subtitle' => 'Bonus Kerja & Komisi',
                'dominant_desc' => 'Pemasukan tambahan dari insentif, komisi, atau proyek sampingan.',
                'color' => '#06b6d4',
                'icon_bg' => 'bg-cyan-50',
                'icon_text' => 'text-cyan-600',
                'badge_bg' => 'bg-cyan-50',
                'badge_text' => 'text-cyan-700',
                'default_desc' => 'Bonus & Insentif',
                'type' => 'income',
                'icon' => 'sparkles',
            ],
            'Investasi' => [
                'label' => 'Investasi',
                'full_label' => 'Imbal Hasil Investasi',
                'subtitle' => 'Dividen, Bunga, Reksa Dana',
                'dominant_desc' => 'Pemasukan pasif dari instrumen investasi dan tabungan.',
                'color' => '#3b82f6',
                'icon_bg' => 'bg-blue-50',
                'icon_text' => 'text-blue-600',
                'badge_bg' => 'bg-blue-50',
                'badge_text' => 'text-blue-700',
                'default_desc' => 'Hasil Investasi',
                'type' => 'income',
                'icon' => 'chart',
            ],
        ];
    }

    /**
     * @return array{label: string, full_label: string, subtitle: string, dominant_desc: string, color: string, icon_bg: string, icon_text: string, badge_bg: string, badge_text: string, default_desc: string, type: string, icon: string}
     */
    public static function metaFor(string $category): array
    {
        $all = self::categories();

        return $all[$category] ?? $all['Lainnya'];
    }
}
