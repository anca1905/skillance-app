<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice | S-OS Skillance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f3f4f6;
            color: #333;
        }

        .invoice-container {
            max-width: 850px;
            margin: 40px auto;
            background: #fff;
            padding: 60px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border-radius: 12px;
        }

        .text-navy {
            color: #0d2e5c !important;
        }

        .bg-navy {
            background-color: #0d2e5c !important;
            color: white !important;
        }

        .table> :not(caption)>*>* {
            padding: 1.25rem 1rem;
            border-bottom-color: #eee;
            vertical-align: middle;
        }

        .no-border,
        .no-border th,
        .no-border td {
            border: none !important;
        }

        .ls-2 {
            letter-spacing: 2px;
        }

        .print-btn-container {
            max-width: 850px;
        }

        @media print {
            body {
                background: #fff;
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .invoice-container {
                max-width: 100%;
                margin: 0;
                box-shadow: none;
                padding: 0;
                border: none !important;
                border-radius: 0;
            }

            .no-print {
                display: none !important;
            }

            @page {
                margin: 15mm;
            }
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-end mb-3 mt-4 no-print print-btn-container">
        <button class="btn btn-navy text-white shadow-sm" onclick="window.print()">
            <i class="fa-solid fa-print me-1"></i> Print Invoice
        </button>
    </div>

    <div class="invoice-container border border-light">
        <!-- Header -->
        <div class="row mb-5 pb-4 border-bottom align-items-center">
            <div class="col-7">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="../../assets/img/favicon.png" alt="Skillance Logo"
                        style="width: 45px; height: 45px; object-fit: contain;">
                    <div>
                        <h3 class="fw-bold text-navy mb-0 ls-2">SKILLANCE</h3>
                        <small class="text-muted fw-bold" style="font-size: 0.75rem; letter-spacing: 1px;">OFFICE
                            SYSTEM</small>
                    </div>
                </div>
                <div class="text-muted small lh-lg">
                    <strong>CV. SKILLANCE DIGITAL INDONESIA</strong><br>
                    Desa pabiring dusun taruseng<br>
                    Kecamatan poleang barat kabupaten bombana, 93772<br>
                    skillance.id@gmail.com | 082291700778
                </div>
            </div>
            <div class="col-5 text-end">
                <h1 class="fw-bold text-navy mb-1" style="font-size: 3rem; letter-spacing: -1px;">INVOICE</h1>
                <h6 class="text-muted mb-4 font-monospace fs-6" id="invNo">INV/...</h6>
                <div class="small">
                    <div class="d-flex justify-content-end mb-1">
                        <span class="text-muted me-3">Tanggal:</span>
                        <strong id="invDate" class="text-dark" style="min-width: 120px;">-</strong>
                    </div>
                    <div class="d-flex justify-content-end">
                        <span class="text-muted me-3">Jatuh Tempo:</span>
                        <strong id="invDue" class="text-dark" style="min-width: 120px;">-</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Client Info -->
        <div class="row mb-5">
            <div class="col-7">
                <p class="text-muted small mb-2 fw-bold text-uppercase ls-2">Ditagihkan Kepada</p>
                <div class="p-3 bg-light rounded border border-light"
                    style="border-left: 4px solid #0d2e5c !important;">
                    <h5 class="fw-bold text-navy mb-1" id="clientName">Nama Klien</h5>
                    <div class="text-muted small mb-1" id="clientInst">Instansi</div>
                    <div class="text-muted small"><i class="fa-solid fa-phone me-2"></i><span id="clientPhone">-</span>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <p class="text-muted small mb-2 fw-bold text-uppercase ls-2 text-end">Status Pembayaran</p>
                <div class="p-3 text-end">
                    <h3 class="fw-bold text-navy mb-0" id="invStatus">...</h3>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive mb-5">
            <table class="table mb-0">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th
                            class="ps-3 text-uppercase small font-monospace text-muted py-3 border-top-0 border-bottom-0 rounded-start">
                            Deskripsi Project</th>
                        <th
                            class="text-center text-uppercase small font-monospace text-muted py-3 border-top-0 border-bottom-0">
                            Kuantitas</th>
                        <th
                            class="text-end text-uppercase small font-monospace text-muted py-3 border-top-0 border-bottom-0">
                            Harga Satuan</th>
                        <th
                            class="text-end pe-3 text-uppercase small font-monospace text-muted py-3 border-top-0 border-bottom-0 rounded-end">
                            Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3">
                            <strong class="d-block mb-1 text-dark fs-6" id="itemName">Memuat...</strong>
                            <small class="text-muted" id="itemPlatform">Platform: -</small>
                        </td>
                        <td class="text-center">1</td>
                        <td class="text-end" id="itemPrice">Rp 0</td>
                        <td class="text-end pe-3 fw-bold text-dark" id="itemTotal">Rp 0</td>
                    </tr>
                </tbody>
                <tbody id="addonContainer">
                    <!-- Dinamis: Baris revisi masuk di sini -->
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="no-border"></td>
                        <td class="text-end text-muted fw-bold py-3 no-border small">TOTAL PROJECT</td>
                        <td class="text-end pe-3 fw-bold py-3 no-border" id="subTotal">Rp 0</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="no-border"></td>
                        <td class="text-end text-muted fw-bold pb-3 no-border small">TELAH DIBAYAR (DP)</td>
                        <td class="text-end pe-3 text-success fw-bold pb-3 no-border" id="dpAmount">Rp 0</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="no-border"></td>
                        <td class="text-end text-muted fw-bold pt-3 pb-0 no-border small">SISA TAGIHAN</td>
                        <td class="text-end pe-3 text-danger fs-4 fw-bold pt-3 pb-0 border-top border-2 border-dark"
                            id="grandTotal">Rp 0</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Footer / Payment Info -->
        <div class="row mt-5 pt-4 border-top">
            <div class="col-8">
                <h6 class="fw-bold mb-3 ls-2 text-uppercase text-muted small">Informasi Pembayaran</h6>
                <div class="p-3 bg-light rounded-3 text-muted small border" style="max-width: 300px;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fa-solid fa-building-columns text-navy me-2"></i>
                        <strong class="text-dark">Bank BCA</strong>
                    </div>
                    No. Rekening: <strong class="text-dark fs-6">1620011628934</strong><br>
                    Atas Nama: <strong class="text-dark">ELESSE NINDY CAHYANI</strong>
                </div>
            </div>
            <div class="col-4 text-center mt-3 d-flex flex-column justify-content-end align-items-center">
                <p class="mb-5 small text-muted">Hormat Kami,</p>
                <div style="border-bottom: 1px solid #ddd; width: 150px; margin-bottom: 5px;"></div>
                <h6 class="fw-bold mb-0 text-navy">Muh Arsyad Ramsi</h6>
            </div>
        </div>

        <div class="text-center mt-5 pt-4">
            <p class="text-muted small fst-italic">Tanda terima ini merupakan bukti sah penagihan dari CV. SKILLANCE DIGITAL INDONESIA.<br>Terima kasih atas kerja sama Anda.</p>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const projectId = urlParams.get('id');

        if (!projectId) {
            alert('ID Project tidak ditemukan!');
            window.location.href = 'index.html';
        }

        fetch(`../../api/projects.php?id=${projectId}`)
            .then(res => res.json())
            .then(data => {
                if (data.status === 'error') {
                    alert('Project tidak ditemukan');
                    return;
                }

                // Format rupiah
                const formatRp = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num || 0);

                const price = parseInt(data.price) || 0;
                const dpAmount = parseInt(data.dp_amount) || 0;

                // Sum from new addons array
                let addonSum = 0;
                if (data.addons && data.addons.length > 0) {
                    data.addons.forEach(a => addonSum += parseFloat(a.price));
                }

                const totalPrice = price + addonSum;
                const balance = totalPrice - dpAmount;
                const formattedPrice = formatRp(price);

                // If created_at is available, else use current date
                const created = data.created_at ? new Date(data.created_at) : new Date();
                const invYear = created.getFullYear();
                const invMonth = String(created.getMonth() + 1).padStart(2, '0');

                document.getElementById('invNo').innerText = `INV/SKLR/${invYear}/${invMonth}/${data.id.toString().padStart(3, '0')}`;

                const deadline = new Date(data.deadline);
                const dtOpts = { day: 'numeric', month: 'long', year: 'numeric' };

                document.getElementById('invDate').innerText = created.toLocaleDateString('id-ID', dtOpts);
                document.getElementById('invDue').innerText = deadline.toLocaleDateString('id-ID', dtOpts);

                document.getElementById('clientName').innerText = data.client_name;
                document.getElementById('clientInst').innerText = data.client_institution || '-';
                document.getElementById('clientPhone').innerText = data.client_contact || '-';
                document.getElementById('invStatus').innerText = (data.payment_status || '').toUpperCase();

                document.getElementById('itemName').innerText = data.name;
                document.getElementById('itemPlatform').innerText = `Platform Pengembangan: ${data.platform}`;

                document.getElementById('itemPrice').innerText = formattedPrice;
                document.getElementById('itemTotal').innerText = formattedPrice;

                document.getElementById('itemPrice').innerText = formattedPrice;
                document.getElementById('itemTotal').innerText = formattedPrice;

                // Render Addons
                const addonContainer = document.getElementById('addonContainer');
                addonContainer.innerHTML = '';
                if (data.addons && data.addons.length > 0) {
                    data.addons.forEach(addon => {
                        let rp = formatRp(addon.price);
                        let row = `<tr class="bg-light">
                            <td class="ps-3 border-bottom-0">
                                <strong class="d-block mb-1 text-dark fs-6 text-secondary"><i class="fa-solid fa-plus me-1 small"></i> <span>${addon.name}</span></strong>
                            </td>
                            <td class="text-center border-bottom-0">1</td>
                            <td class="text-end border-bottom-0">${rp}</td>
                            <td class="text-end pe-3 fw-bold text-dark border-bottom-0">${rp}</td>
                        </tr>`;
                        addonContainer.insertAdjacentHTML('beforeend', row);
                    });
                }

                document.getElementById('subTotal').innerText = formatRp(totalPrice);
                document.getElementById('dpAmount').innerText = formatRp(dpAmount);
                document.getElementById('grandTotal').innerText = formatRp(balance);
            })
            .catch(err => {
                console.error(err);
                alert('Gagal memuat data');
            });
    </script>
</body>

</html>
