<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>KUITANSI #{{ $donation->getIdentificationNumber() }} </title>
    <style>
        body {
            margin: 0;
        }

        .box {
            margin: auto;
            font-size: 14px;
            line-height: 1.2;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #000000;
            border-top: 10px solid #0ea432;
            border-right: 1px solid grey;
            border-left: 1px solid grey;
            border-bottom: 1px solid grey;
        }

        .content-container {
            margin: 0 10px 10px;
        }

        .invoice-header {
            margin-top: 20px;
        }

        .invoice-header table {
            width: 100%; 
            border-collapse: collapse; 
            border-spacing: 0;
        }

        .invoice-content {
            font-size: 13px;
        }

        .title {
            font-weight: bold;
            font-size: 18px;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .description {
            line-height: 22px;
            text-align: justify;
        }

        .greeting {
            background-color: #ddd;
            padding: 10px;
        }

        .greeting p {
            padding: 0;
            margin: 0;
        }

        .transaction-status {
            background-color: #ddd;
            padding: 10px;
            display: flex;
            justify-content: center;
        }

        .transaction-status table {
            font-size: 14px;
            width: 100%;
        }

        .transaction-status table td {
            padding: 3px;
            word-wrap: break-word;
            white-space: normal;
        }

        .transaction-status .detail-title {
            min-width: 120px;
        }

        .transaction-status .detail-value {
            width: 210px;
        }

        .transaction-header {
            background-color: #0ea432;
            color: #fff;
            font-weight: bold;
            display: block;
            padding: 5px;
            margin: 10px 0 0;
        }

        .transaction-table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-header {
            background-color: #ddd;
        }

        .header-cell {
            vertical-align: middle;
            text-align: left;
            font-weight: bold;
            padding: 10px 5px;
        }

        .right-align {
            text-align: right;
        }

        .table-body {
            border-bottom: 1px solid grey;
        }

        .body-cell {
            vertical-align: top;
            text-align: left;
            padding: 10px 5px;
        }

        .funding-name {
            margin: 0;
            line-height: 1
        }

        .funding-description {
            margin: 5px 0 0 0;
            line-height: 1;
            color: #868686
        }

        .amount-cell {
            text-align: right;
            width: 5rem;
            white-space: nowrap;
        }

        .footer-cell {
            vertical-align: top;
            text-align: right;
            padding: 10px 5px;
            font-weight: bold;
        }

        .currency-cell {
            vertical-align: top;
            text-align: right;
            padding: 10px 5px;
        }

        .currency-text {
            color: gray;
            font-style: italic;
            font-weight: normal;
        }

        td>li {
            list-style: none;
        }

        .bold {
            font-weight: bold;
        }

        .closing-text {
            margin: 10px 0 1em 0;
            line-height: 22px;
            text-align: justify;
        }

        .signature-table {
            margin-left: 6em;
            margin-top: 1em;
            margin-bottom: 1em;
        }

        .signature-cell {
            width: 50%;
            text-align: center;
            position: relative;
        }

        .signature-text {
            line-height: 50%;
            z-index: 2;
        }

        .signature-date {
            line-height: 50%;
            margin-bottom: 4.5rem;
            z-index: 2;
        }

        .signature-name {
            line-height: 50%;
            font-weight: bold;
            z-index: 2;
        }

        .signature-image {
            top: 38px;
            position: absolute;
            left: 30px;
            height: 110px;
            z-index: 1;
        }

        .footer-container {
            margin: 10px;
        }

        .notes-section {
            margin-top: 2em;
            page-break-inside: avoid;
        }

        .notes-title {
            font-size: 9.5px;
            line-height: 21px;
            text-align: left;
        }

        .notes-list {
            font-size: 9.5px;
            text-align: justify;
            margin-left: 0;
            padding-left: 1em;
        }

        .organization {
            padding-top: 6px;
            padding-bottom: 6px;
        }

        .organization-name {
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            margin: 5px 0;
        }

        .organization-detail {
            font-size: 9.5px;
            text-align: center;
            margin: 5px 0;
        }

        @page {
            margin-top: 10mm;
            margin-right: 4mm;
            margin-bottom: 4mm;
            margin-left: 4mm;

        }
    </style>
</head>

@php
    $logoImg =
        'data:image/png;base64,' .
        base64_encode(file_get_contents('http://donation.inisiatif.id/images/logo-inisiatif-zakat-indonesia.png'));

    $signatureImg =
        'data:image/jpeg;base64,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';

@endphp

<body>
    <div class="box">
        <div class="content-container">
            <div class="invoice-header">
                <table>
                    <tr>
                        <td style="vertical-align: top; width:120px;">
                            <img src="{{ $logoImg }}" height="60" alt="Inisiatif Zakat Indonesia"/>
                        </td>
                        <td style="vertical-align: top;">
                            <div style="display:inline-block; width:auto; text-align:left; margin-left: 80px;">
                                <div class="title">
                                    KUITANSI
                                </div>
                                <div class="organization">
                                    <p class="organization-name">Yayasan Inisiatif Zakat Indonesia</p>
                                    <p class="organization-detail">LAZNAS SK Kemenag RI No. 1754 Tahun 2025</p>
                                    <p class="organization-detail">Alamat Jl. Raya Condet No.27-G, Batu Ampar, Kramat Jati, Jakarta Timur 13520</p>
                                    <p class="organization-detail">Telp : (021) 87787325 Fax : (021) 87787603</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>

            
            <div class="invoice-content">
                <div class="greeting">
                    <p>Kepada Bapak/Ibu <strong>{{ $donor->getName() }}</strong></p>
                </div>

                <p class="description">
                    Kuitansi ini adalah bukti pembayaran Zakat, Infaq dan Shodaqoh Anda di Inisiatif Zakat Indonesia.
                    Berikut kami sertakan detail pembayaran Anda:
                </p>
                <div class="transaction-status">
                    <table>
                        <tbody>
                            <tr>
                                <td class="detail-title"><b>Nomor Donatur</b></td>
                                <td>:</td>
                                <td class="detail-value">{{ $donor->getIdentificationNumber() }}</td>
                                <td class="detail-title"><b>Nomor Transaksi</b></td>
                                <td>:</td>
                                <t class="detail-value"d>{{ $donation->getIdentificationNumber() }}</t>
                            </tr>
                            <tr>
                                <td class="detail-title"><b>Nama Donatur</b></td>
                                <td>:</td>
                                <td class="detail-value">{{ $donor->getName() }}</td>
                                <td class="detail-title"><b>Tanggal Transaksi</b></td>
                                <td>:</td>
                                <td class="detail-value">{{ $donation->getDate()->format('d - m - Y') }}</td>

                            </tr>
                            <tr>
                                <td class="detail-title"><b>NPWP</b></td>
                                <td>:</td>
                                <td class="detail-value">{{ $donor->getTaxNumber() }}</td>
                                <td class="detail-title"><b>Alamat NPWP</b></td>
                                <td>:</td>
                                <td class="detail-value">{{ $donor->getTaxAddress() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="transaction-header">Detail Transaksi</div>
                <table class="transaction-table">
                    <thead class="table-header">
                        <tr>
                            <td class="header-cell">Jenis Transaksi</td>
                            <td class="header-cell">Program</td>
                            <td class="header-cell right-align">Sub Total</td>
                        </tr>
                    </thead>
                    <tbody class="table-body">
                        @foreach ($details as $detail)
                            <tr>
                                <td class="body-cell">
                                    <p class="funding-name">{{ $detail->getFundingName() }}</p>
                                    @if ($donation->getType() === 'GOOD')
                                        <p class="funding-description">Beras 10 Kg</p>
                                    @endif
                                </td>
                                <td class="body-cell">{{ $detail->getProgramName() }}</td>
                                <td class="body-cell amount-cell">
                                    <li>
                                        {{ sprintf('Rp. %s', $detail->getTotalAmountFormatted()) }}
                                    </li>
                                    @if ($detail->getCurrency() !== 'IDR')
                                        <li class="right-align currency-text">
                                            ({{ $detail->getCurrency() }} {{ $detail->getAmountFormatted() }})
                                        </li>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="footer-cell">
                                <li>
                                    Total Transaksi
                                </li>
                                @if ($donation->getCurrency() !== 'IDR')
                                    <li class="currency-text">
                                        Rate 1 {{ $donation->getCurrency() }} ke IDR adalah
                                        {{ $donation->getCurrencyRate() }}
                                    </li>
                                @endif
                            </td>
                            <td class="footer-cell amount-cell">
                                <li>
                                    {{ sprintf('Rp. %s', $donation->getTotalAmountFormatted()) }}
                                </li>
                                @if ($donation->getCurrency() !== 'IDR')
                                    <li class="currency-text bold">
                                        ({{ $donation->getCurrency() }} {{ $donation->getAmountFormatted() }})
                                    </li>
                                @endif
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <p class="closing-text">
                    Semoga Allah memberikan pahala atas apa yang telah Bapak/Ibu
                    {{ $donor->getName() }}{{ ' ' }}
                    tunaikan, semoga Allah memberikan keberkahan atas harta yang masih
                    tertinggal dan semoga
                    <strong>zakat, infaq dan shodaqoh</strong> ini menjadi pembersih bagi
                    jiwa dan harta Bapak/Ibu {{ $donor->getName() }} beserta keluarga.
                </p>
            </div>
        </div>

        <table class="signature-table">
            <tbody>
                <tr>
                    <td class="signature-cell">
                        <p class="signature-text">Diterima oleh LAZNAS IZI</p>
                        <p class="signature-date">
                            {{ $donation->getBranchName() }}, {{ $donation->getDate()->format('d - m - Y') }}
                        </p>
                        @if ($withSignature)
                            <img class="signature-image" src="{{ $signatureImg }}" alt="IZI Signature">
                        @endif
                        <p class="signature-name">Lilis Maesaroh</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="footer-container">
            <div class="notes-section">
                <p class="notes-title">
                    <strong>Keterangan :</strong>
                </p>
                <ol class="notes-list">
                    <li>
                        Inisiatif Zakat Indonesia terdaftar sebagai lembaga penerbit Bukti Setor Zakat (BSZ) untuk pengurangan penghasilan kena pajak berdasarkan Peraturan Dirjen Pajak No. PER-22/PJ/2025
                    </li>
                    <li>
                        Inisiatif Zakat Indonesia tidak menerima segala bentuk dana yang
                        terkait dengan terorisme dan pencucian uang.
                    </li>
                    <li>
                        Untuk memenuhi kepatuhan terhadap Syariah serta Undang-Undang No. 23 Tahun 2011 tentang Pengelolaan Zakat, data zakat yang disetorkan oleh Penyetor (Muzaki) telah sesuai dengan kriteria/syarat wajib zakat, yaitu: (1) Muslim, (2) Milik Sempurna, (3) Cukup Nisab, (4) Cukup Haul, dan (5) Bersumber dari dana yang halal.
                    </li>
                    <li>
                        Transaksi zakat dapat dikreditkan sebagai pengurangan Penghasilan Bruto sesuai ketentuan PMK No. 114 Tahun 2025 dan Pasal 9 ayat (1) huruf g UU No. 7 Tahun 2021 tentang Harmonisasi Peraturan Perpajakan (UU HPP).
                    </li>
                </ol>
            </div>
        </div>
    </div>
</body>

</html>
