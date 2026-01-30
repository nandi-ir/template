<?php

declare(strict_types=1);

namespace Inisiatif\Package\Template\View\Composers;

use Illuminate\View\View;

final class Disclaimer
{
    /**
     * @var array
     */
    private $disclaimers = [
        'Inisiatif Zakat Indonesia terdaftar sebagai lembaga penerbit Bukti Setor Zakat (BSZ) untuk pengurangan penghasilan kena pajak berdasarkan Peraturan Dirjen Pajak No. PER-22/PJ/2025.',
        'Inisiatif Zakat Indonesia tidak menerima segala bentuk dana yang terkait dengan terorisme dan pencucian uang.',
        'Untuk memenuhi kepatuhan terhadap Syariah serta Undang-Undang No. 23 Tahun 2011 tentang Pengelolaan Zakat, data zakat yang disetorkan oleh Penyetor (Muzaki) telah sesuai dengan kriteria/syarat wajib zakat, yaitu: (1) Muslim, (2) Milik Sempurna, (3) Cukup Nisab, (4) Cukup Haul, dan (5) Bersumber dari dana yang halal.',
        'Transaksi zakat dapat dikreditkan sebagai pengurangan Penghasilan Bruto sesuai ketentuan PMK No. 114 Tahun 2025 dan Pasal 9 ayat (1) huruf g UU No. 7 Tahun 2021 tentang Harmonisasi Peraturan Perpajakan (UU HPP).',
    ];

    public function compose(View $view): void
    {
        $view->with('disclaimers', $this->disclaimers);
    }
}
