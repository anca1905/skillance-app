<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perjanjian Kerja Sama (MOU) | S-OS Skillance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Times+New+Roman:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background: #f3f4f6;
            color: #000;
            line-height: 1.6;
        }

        .mou-container {
            max-width: 850px;
            margin: 40px auto;
            background: #fff;
            padding: 80px 100px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            border-radius: 8px;
        }

        .kop-surat {
            border-bottom: 3px solid #000;
            margin-bottom: 2px;
            padding-bottom: 15px;
        }

        .kop-surat-2 {
            border-bottom: 1px solid #000;
            margin-bottom: 30px;
        }

        .title-mou {
            text-align: center;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 5px;
            font-size: 1.25rem;
        }

        .subtitle-mou {
            text-align: center;
            margin-bottom: 30px;
        }

        .pasal-title {
            text-align: center;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
        }

        .signature-box {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
        }

        .signature-item {
            text-align: center;
            width: 40%;
        }

        .signature-line {
            margin-top: 80px;
            border-bottom: 1px solid #000;
            font-weight: bold;
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

            .mou-container {
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
                margin: 25mm 20mm;
            }
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-end mb-3 mt-4 no-print print-btn-container">
        <button class="btn btn-dark text-white shadow-sm" onclick="window.print()">
            Print MOU
        </button>
    </div>

    <div class="mou-container border">
        <!-- Kop Surat -->
        <div class="kop-surat d-flex align-items-center">
            <div style="width: 100px; text-align: center;">
                <!-- Logo -->
                <img src="../../assets/img/favicon.png" alt="Skillance Logo"
                    style="width: 70px; height: 70px; object-fit: contain;">
            </div>
            <div style="flex: 1; text-align: center;">
                <h3 style="margin: 0; font-weight: bold; font-family: sans-serif; letter-spacing: 2px;">CV. SKILLANCE
                    DIGITAL INDONESIA</h3>
                <p style="margin: 5px 0 0 0; font-size: 0.9rem;">IT Consultant & Software Development</p>
                <p style="margin: 0; font-size: 0.85rem;">Desa Pabiring Dusun Taruseng, Kecamatan Poleang Barat,
                    Kabupaten Bombana, 93772
                </p>
                <p style="margin: 0; font-size: 0.85rem;">Email: skillance.id@gmail.com | Telp: 082291700778</p>
            </div>
        </div>
        <div class="kop-surat-2"></div>

        <!-- Title -->
        <div class="title-mou">SURAT PERJANJIAN KERJA SAMA</div>
        <div class="subtitle-mou font-monospace">Nomor: <span id="mouNo">MOU/SKLR/2026/...</span></div>

        <!-- Opening -->
        <p style="text-align: justify;">
            Pada hari ini, <span id="hariPrint">...</span> tanggal <span id="tanggalPrint">...</span>, yang bertanda
            tangan di bawah ini:
        </p>

        <!-- Pihak 1 -->
        <table class="table-borderless mb-3" style="width: 100%;">
            <tr>
                <td style="width: 30px;">1.</td>
                <td style="width: 150px;">Nama</td>
                <td style="width: 20px;">:</td>
                <td><strong>Muh Arsyad Ramsi</strong></td>
            </tr>
            <tr>
                <td></td>
                <td>Jabatan</td>
                <td>:</td>
                <td>Direktur Utama</td>
            </tr>
            <tr>
                <td></td>
                <td>Instansi</td>
                <td>:</td>
                <td>CV. SKILLANCE DIGITAL INDONESIA</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" style="text-align: justify; padding-top: 10px;">
                    Dalam hal ini bertindak untuk dan atas nama CV. SKILLANCE DIGITAL INDONESIA, yang selanjutnya disebut
                    sebagai <strong>PIHAK PERTAMA</strong>.
                </td>
            </tr>
        </table>

        <!-- Pihak 2 -->
        <table class="table-borderless mb-4" style="width: 100%;">
            <tr>
                <td style="width: 30px;">2.</td>
                <td style="width: 150px;">Nama</td>
                <td style="width: 20px;">:</td>
                <td><strong id="clientName">...</strong></td>
            </tr>
            <tr>
                <td></td>
                <td>Instansi</td>
                <td>:</td>
                <td id="clientInst">...</td>
            </tr>
            <tr>
                <td></td>
                <td>Kontak</td>
                <td>:</td>
                <td id="clientPhone">...</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" style="text-align: justify; padding-top: 10px;">
                    Dalam hal ini bertindak untuk dan atas nama diri sendiri atau instansi terkait, yang selanjutnya
                    disebut sebagai <strong>PIHAK KEDUA</strong>.
                </td>
            </tr>
        </table>

        <p style="text-align: justify;">
            PIHAK PERTAMA dan PIHAK KEDUA secara bersama-sama selanjutnya disebut sebagai <strong>PARA PIHAK</strong>.
            PARA PIHAK sepakat untuk mengikatkan diri dalam Surat Perjanjian Kerja Sama dengan ketentuan dan
            syarat-syarat sebagai berikut:
        </p>

        <!-- Pasal 1 -->
        <div class="pasal-title">Pasal 1<br>RUANG LINGKUP PEKERJAAN</div>
        <p style="text-align: justify;">
            PIHAK PERTAMA sepakat untuk melaksanakan pekerjaan <strong><span id="projectName">...</span></strong> dengan
            detail platform/teknologi berupa <strong><span id="projectPlatform">...</span></strong> untuk dan atas nama
            PIHAK KEDUA. PIHAK KEDUA sepakat untuk menyerahkan pelaksanaan pekerjaan tersebut kepada PIHAK PERTAMA.
        </p>

        <!-- Pasal 2 -->
        <div class="pasal-title">Pasal 2<br>NILAI DAN CARA PEMBAYARAN</div>
        <p style="text-align: justify;">
            1. Nilai total kesepakatan untuk pekerjaan sebagaimana dimaksud pada Pasal 1 adalah sebesar <strong><span
                    id="projectPrice">...</span></strong>.<br>
            2. PIHAK KEDUA sepakat untuk melakukan pembayaran di awal atau Down Payment (DP) senilai <strong><span
                    id="projectDpAmount">...</span></strong>.<br>
            3. Sisa pembayaran senilai <strong><span id="projectBalance">...</span></strong> akan dilunasi oleh PIHAK
            KEDUA kepada rekening resmi milik PIHAK PERTAMA (selama status pembayaran saat ini adalah <strong><span
                    id="projectPayment">...</span></strong>).
        </p>

        <!-- Pasal 3 -->
        <div class="pasal-title">Pasal 3<br>JANGKA WAKTU PELAKSANAAN</div>
        <p style="text-align: justify;">
            Jangka waktu pelaksanaan pekerjaan sebagaimana dimaksud pada Pasal 1 disepakati selambat-lambatnya selesai
            pada tanggal <strong><span id="projectDeadline">...</span></strong>. Surat Perjanjian ini dinyatakan selesai
            ketika status pekerjaan telah <strong>Selesai</strong> dan kewajiban pembayaran telah dipenuhi.
        </p>

        <!-- Pasal 4 -->
        <div class="pasal-title">Pasal 4<br>PENUTUP</div>
        <p style="text-align: justify;">
            Demikian Surat Perjanjian Kerja Sama ini dibuat dalam rangkap 2 (dua) yang masing-masing bermeterai cukup
            dan mempunyai kekuatan hukum yang sama. Surat Perjanjian ini ditandatangani oleh PARA PIHAK dalam keadaan
            sadar dan tanpa paksaan dari pihak manapun.
        </p>

        <!-- Signatures -->
        <div class="signature-box">
            <div class="signature-item">
                <div><strong>PIHAK KEDUA</strong></div>
                <div style="margin-top: 5px;" id="clientInsttt">...</div>
                <div class="signature-line" id="clientNameSign">...</div>
            </div>
            <div class="signature-item">
                <div><strong>PIHAK PERTAMA</strong></div>
                <div style="margin-top: 5px;">CV. SKILLANCE DIGITAL INDONESIA</div>
                <div class="signature-line">Muh Arsyad Ramsi</div>
            </div>
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

                let addonSum = 0;
                if (data.addons && data.addons.length > 0) {
                    data.addons.forEach(a => addonSum += parseFloat(a.price));
                }

                const totalPrice = price + addonSum;

                const dpAmount = parseInt(data.dp_amount) || 0;
                const balance = totalPrice - dpAmount;

                // Waktu Pembuatan MOU
                const now = new Date();
                const mouYear = now.getFullYear();
                const mouMonth = String(now.getMonth() + 1).padStart(2, '0');

                document.getElementById('mouNo').innerText = `MOU/SKLR/${mouYear}/${mouMonth}/${data.id.toString().padStart(3, '0')}`;

                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const dtOpts = { day: 'numeric', month: 'long', year: 'numeric' };

                document.getElementById('hariPrint').innerText = days[now.getDay()];
                document.getElementById('tanggalPrint').innerText = now.toLocaleDateString('id-ID', dtOpts);

                // Data Client
                document.getElementById('clientName').innerText = data.client_name;
                document.getElementById('clientNameSign').innerText = data.client_name;
                document.getElementById('clientInst').innerText = data.client_institution || '-';
                document.getElementById('clientInsttt').innerText = data.client_institution || '';
                document.getElementById('clientPhone').innerText = data.client_contact || '-';

                // Data Project
                document.getElementById('projectName').innerText = data.name;
                document.getElementById('projectPlatform').innerText = data.platform;
                document.getElementById('projectPrice').innerText = formatRp(totalPrice);
                document.getElementById('projectDpAmount').innerText = formatRp(dpAmount);
                document.getElementById('projectBalance').innerText = formatRp(balance);
                document.getElementById('projectPayment').innerText = data.payment_status;

                const deadline = new Date(data.deadline);
                document.getElementById('projectDeadline').innerText = deadline.toLocaleDateString('id-ID', dtOpts);
            })
            .catch(err => {
                console.error(err);
                alert('Gagal memuat data');
            });
    </script>
</body>

</html>
