<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Keuangan | Skillance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #fff;
            color: #000;
            padding: 20px;
        }

        .report-header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }

        .report-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        .company-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .report-date {
            font-size: 14px;
            color: #555;
        }

        .summary-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 30px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .table th {
            background-color: #f2f2f2 !important;
            font-weight: bold;
        }

        .text-success,
        .text-danger {
            color: #000 !important;
        }

        /* Force black for print */

        @media print {
            body {
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .table-bordered {
                border-color: #000 !important;
            }

            .table th,
            .table td {
                border-color: #000 !important;
            }
        }
    </style>
</head>

<body>

    <div class="row mb-3 no-print">
        <div class="col-12 text-end">
            <button class="btn btn-secondary mx-2" onclick="window.close()">Tutup Laporan</button>
            <button class="btn btn-primary" onclick="window.print()">Cetak Ulang</button>
        </div>
    </div>

    <div class="report-header">
        <div class="company-name">SKILLANCE OFFICE SYSTEM</div>
        <div class="report-title">Laporan Keuangan: Laba / Rugi</div>
        <div class="report-date" id="reportDate"></div>
    </div>

    <div class="summary-box">
        <h5 class="fw-bold mb-3 border-bottom pb-2">Ringkasan (Summary)</h5>
        <div class="row">
            <div class="col-6 mb-2"><strong>Total Pemasukan:</strong> <span id="valIncome" class="float-end">Rp 0</span>
            </div>
            <div class="col-6 mb-2"><strong>Total Pengeluaran:</strong> <span id="valExpense" class="float-end">Rp
                    0</span></div>
            <div class="col-12 mt-2 pt-2 border-top">
                <strong>LABA BERSIH (Saldo):</strong> <span id="valBalance" class="float-end fw-bold">Rp 0</span>
            </div>
        </div>
    </div>

    <h6 class="fw-bold mb-3">Detail Transaksi</h6>
    <table class="table table-bordered table-sm align-middle">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">Tanggal</th>
                <th width="35%">Keterangan</th>
                <th width="15%">Kategori</th>
                <th width="15%">Tipe</th>
                <th width="15%" class="text-end">Nominal</th>
            </tr>
        </thead>
        <tbody id="trxList">
            <tr>
                <td colspan="6" class="text-center py-4">Memuat data...</td>
            </tr>
        </tbody>
    </table>

    <div class="mt-5 pt-5 row">
        <div class="col-4 ms-auto text-center">
            <p class="mb-5">Mengetahui,</p>
            <br><br><br>
            <p class="fw-bold text-decoration-underline mb-0">Finance Dept.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Set Date
            const today = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            document.getElementById('reportDate').innerText = 'Dicetak pada: ' + today.toLocaleDateString('id-ID', options);

            fetchData();
        });

        function fetchData() {
            fetch('../../api/finance.php')
                .then(response => response.json())
                .then(data => {
                    const fmt = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });

                    document.getElementById('valIncome').innerText = fmt.format(data.stats.income);
                    document.getElementById('valExpense').innerText = fmt.format(data.stats.expense);

                    let balanceEl = document.getElementById('valBalance');
                    balanceEl.innerText = fmt.format(data.stats.balance);

                    const container = document.getElementById('trxList');
                    container.innerHTML = '';

                    if (data.transactions.length === 0) {
                        container.innerHTML = '<tr><td colspan="6" class="text-center py-4">Tidak ada data transaksi.</td></tr>';
                    } else {
                        data.transactions.forEach((trx, index) => {
                            let typeText = trx.type === 'income' ? 'Pemasukan' : 'Pengeluaran';

                            const html = `
                                <tr>
                                    <td class="text-center">${index + 1}</td>
                                    <td>${trx.date}</td>
                                    <td>${trx.desc}</td>
                                    <td>${trx.category}</td>
                                    <td>${typeText}</td>
                                    <td class="text-end">${fmt.format(trx.amount)}</td>
                                </tr>
                            `;
                            container.insertAdjacentHTML('beforeend', html);
                        });
                    }

                    // Auto trigger print after 500ms when render is done
                    setTimeout(() => {
                        window.print();
                    }, 500);
                })
                .catch(err => {
                    document.getElementById('trxList').innerHTML = '<tr><td colspan="6" class="text-center text-danger py-4">Gagal memuat format laporan.</td></tr>';
                });
        }
    </script>
</body>

</html>
