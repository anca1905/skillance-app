<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/index.php");
    exit();
}

$year = isset($_GET['year']) ? intval($_GET['year']) : intval(date('Y'));
if ($year < 2020 || $year > 2035) $year = intval(date('Y'));
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lampiran Rekapitulasi SPT 1771 - PT Skillance Digital Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background: #fff;
            color: #000;
            padding: 30px;
            font-size: 13px;
        }

        .header-kop {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }

        .header-kop h3 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 2px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .header-kop p {
            margin-bottom: 2px;
            font-size: 11px;
            color: #222;
        }

        .doc-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .doc-title h4 {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 3px;
            text-decoration: underline;
            text-transform: uppercase;
        }

        .doc-title p {
            font-size: 12px;
            margin-bottom: 0;
            font-style: italic;
        }

        .meta-table {
            width: 100%;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .meta-table td {
            padding: 3px 6px;
        }

        .table-spt {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .table-spt th,
        .table-spt td {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 12px;
        }

        .table-spt th {
            background-color: #f2f2f2 !important;
            text-align: center;
            font-weight: bold;
        }

        .box-summary {
            border: 1px solid #000;
            padding: 12px 16px;
            margin-bottom: 25px;
            background: #fafafa;
        }

        .signature-section {
            margin-top: 40px;
            page-break-inside: avoid;
        }

        @media print {
            body {
                padding: 10px 15px;
            }

            .no-print {
                display: none !important;
            }

            .table-spt th {
                background-color: #eaeaea !important;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

    <div class="row mb-3 no-print">
        <div class="col-12 text-end">
            <span class="text-muted small me-3">Tips: Pilih "Save as PDF" jika ingin mengunduh lampiran resmi.</span>
            <button class="btn btn-secondary btn-sm me-2" onclick="window.close()">Tutup</button>
            <button class="btn btn-primary btn-sm fw-bold" onclick="window.print()">
                <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
            </button>
        </div>
    </div>

    <!-- KOP SURAT RESMI PT -->
    <div class="header-kop">
        <h3>PT SKILLANCE DIGITAL INDONESIA</h3>
        <p><strong>Keputusan Menkumham RI No:</strong> AHU-A138609.AH.01.30.Tahun 2026 &bull; <strong>NPWP:</strong> 100000011940526</p>
        <p>Desa Pabiring Dusun Taruseng, Kec. Poleang Barat, Kab. Bombana, Sulawesi Tenggara 93772</p>
        <p>Website: https://skillance.my.id &bull; Rekening Perusahaan: Bank Mandiri a.n. PT Skillance Digital Indonesia</p>
    </div>

    <!-- JUDUL DOKUMEN -->
    <div class="doc-title">
        <h4>REKAPITULASI PEREDARAN BRUTO & PERHITUNGAN PPh FINAL (PP 55/2022)</h4>
        <p>Lampiran Khusus Pelaporan SPT Tahunan PPh Wajib Pajak Badan (Formulir 1771-III)</p>
    </div>

    <!-- IDENTITAS WAJIB PAJAK -->
    <table class="meta-table">
        <tr>
            <td width="22%"><strong>Nama Wajib Pajak</strong></td>
            <td width="2%">:</td>
            <td width="40%">PT SKILLANCE DIGITAL INDONESIA</td>
            <td width="16%"><strong>Tahun Pajak</strong></td>
            <td width="2%">:</td>
            <td width="18%"><strong><?= $year ?></strong></td>
        </tr>
        <tr>
            <td><strong>NPWP (16 Digit)</strong></td>
            <td>:</td>
            <td><strong class="font-monospace">100000011940526</strong></td>
            <td><strong>Masa Pajak</strong></td>
            <td>:</td>
            <td>Januari - Desember</td>
        </tr>
        <tr>
            <td><strong>KPP Administrasi</strong></td>
            <td>:</td>
            <td>KPP Pratama Kolaka</td>
            <td><strong>Tarif Pajak</strong></td>
            <td>:</td>
            <td>0,5% (PPh Final UMKM)</td>
        </tr>
    </table>

    <!-- TABEL REKAPITULASI 12 BULAN -->
    <table class="table-spt">
        <thead>
            <tr>
                <th width="5%">NO</th>
                <th width="20%">MASA PAJAK (BULAN)</th>
                <th width="25%">PEREDARAN BRUTO (OMZET)</th>
                <th width="12%">TARIF</th>
                <th width="20%">PPh FINAL TERUTANG (0,5%)</th>
                <th width="18%">KETERANGAN</th>
            </tr>
        </thead>
        <tbody id="sptBody">
            <tr>
                <td colspan="6" class="text-center py-3">Memuat data transaksi tahun <?= $year ?>...</td>
            </tr>
        </tbody>
        <tfoot style="font-weight: bold; background-color: #f2f2f2;">
            <tr>
                <td colspan="2" class="text-center">JUMLAH TOTAL</td>
                <td class="text-end" id="printTotalOmzet">Rp 0</td>
                <td class="text-center">0,5%</td>
                <td class="text-end" id="printTotalPph">Rp 0</td>
                <td class="text-center">Nihil / Terbayar</td>
            </tr>
        </tfoot>
    </table>

    <!-- RINGKASAN LABA RUGI TAHUNAN -->
    <div class="box-summary">
        <div style="font-weight: bold; font-size: 13px; margin-bottom: 8px; border-bottom: 1px solid #ccc; padding-bottom: 4px;">
            RINGKASAN LABA RUGI KOMPREHENSIF TAHUN PAJAK <?= $year ?> (UNTUK NERACA AHU & DJP)
        </div>
        <table style="width: 100%; font-size: 12px;">
            <tr>
                <td width="60%">1. Total Peredaran Bruto / Pendapatan Usaha (Semua Unit Bisnis)</td>
                <td width="5%">:</td>
                <td width="35%" class="text-end" id="sumIncome">Rp 0</td>
            </tr>
            <tr>
                <td>2. Total Beban Pokok & Operasional (Server, Cetak, Akrilik, Fee Tim, Utilitas)</td>
                <td>:</td>
                <td class="text-end" id="sumExpense">Rp 0</td>
            </tr>
            <tr style="font-weight: bold; border-top: 1px solid #000;">
                <td style="padding-top: 6px;">3. LABA / (RUGI) BERSIH USAHA TAHUN BERJALAN</td>
                <td style="padding-top: 6px;">:</td>
                <td class="text-end" style="padding-top: 6px;" id="sumNet">Rp 0</td>
            </tr>
        </table>
    </div>

    <!-- TANDA TANGAN PEJABAT PERUSAHAAN -->
    <div class="signature-section">
        <div class="row">
            <div class="col-6 text-center">
                <p class="mb-1">Dibuat & Diverifikasi Oleh,</p>
                <p class="text-muted small">Bendahara / Sekretaris Keuangan</p>
                <div style="height: 60px;"></div>
                <p class="fw-bold mb-0 text-decoration-underline">Finance & Accounting Dept.</p>
                <p class="small text-muted">PT Skillance Digital Indonesia</p>
            </div>
            <div class="col-6 text-center">
                <p class="mb-1">Poleang Barat, <?= date('d F Y') ?></p>
                <p class="text-muted small">Direktur Utama,</p>
                <div style="height: 60px;"></div>
                <p class="fw-bold mb-0 text-decoration-underline">MUH. ARSYAD RAMSI</p>
                <p class="small text-muted">Direktur / Penanggung Jawab PT</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const year = <?= $year ?>;
            const fmt = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });

            fetch(`../../api/finance.php?year=${year}`)
                .then(r => r.json())
                .then(data => {
                    if (data.status === 'success' && data.spt_summary) {
                        const s = data.spt_summary;
                        const body = document.getElementById('sptBody');
                        body.innerHTML = '';

                        s.monthly.forEach((m, idx) => {
                            const pph = m.pph_final;
                            body.innerHTML += `
                                <tr>
                                    <td class="text-center">${idx + 1}</td>
                                    <td>${m.month_name}</td>
                                    <td class="text-end">${fmt.format(m.income)}</td>
                                    <td class="text-center">0,5%</td>
                                    <td class="text-end">${fmt.format(pph)}</td>
                                    <td class="text-center small">${m.income > 0 ? 'PP 55 Terutang' : 'Nihil'}</td>
                                </tr>
                            `;
                        });

                        document.getElementById('printTotalOmzet').innerText = fmt.format(s.yearly_income);
                        document.getElementById('printTotalPph').innerText = fmt.format(s.yearly_pph_final);
                        
                        document.getElementById('sumIncome').innerText = fmt.format(s.yearly_income);
                        document.getElementById('sumExpense').innerText = fmt.format(s.yearly_expense);
                        document.getElementById('sumNet').innerText = fmt.format(s.yearly_net_profit);
                    }
                })
                .catch(err => {
                    console.error(err);
                    document.getElementById('sptBody').innerHTML = '<tr><td colspan="6" class="text-center text-danger">Gagal memuat rekapitulasi SPT.</td></tr>';
                });
        });
    </script>
</body>

</html>
