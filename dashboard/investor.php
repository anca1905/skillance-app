<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'investor') {
    header("Location: ../auth/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Investor Dashboard | S-OS Skillance</title>

    <!-- Google Fonts & Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #333;
            /* Dark background outside mobile view */
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .mobile-container {
            width: 100%;
            max-width: 480px;
            background-color: #f4f6f9;
            min-height: 100vh;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow-x: hidden;
        }

        /* App Header */
        .app-header {
            background: linear-gradient(135deg, #0d2e5c, #1a4a8c);
            color: white;
            padding: 1.5rem 1.5rem 4rem 1.5rem;
            border-bottom-left-radius: 24px;
            border-bottom-right-radius: 24px;
            position: relative;
            z-index: 10;
        }

        .app-header h5 {
            font-weight: 700;
            margin: 0;
            font-size: 1.25rem;
        }

        .app-header p {
            margin: 0;
            opacity: 0.85;
            font-size: 0.85rem;
        }

        /* Financial Card */
        .finance-card {
            background: #fff;
            border-radius: 20px;
            padding: 1.5rem;
            margin: -3rem 1.5rem 1.5rem 1.5rem;
            box-shadow: 0 8px 24px rgba(13, 46, 92, 0.08);
            position: relative;
            z-index: 20;
        }

        .finance-card .balance-label {
            color: #6c757d;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.3rem;
        }

        .finance-card .balance-amount {
            font-size: 2.2rem;
            font-weight: 800;
            color: #0d2e5c;
            margin-bottom: 1.2rem;
            letter-spacing: -0.5px;
        }

        .finance-stats {
            display: flex;
            justify-content: space-between;
            border-top: 1px solid #eef2f7;
            padding-top: 1.2rem;
        }

        .finance-stats .stat-item {
            flex: 1;
        }

        .finance-stats .stat-item:last-child {
            padding-left: 1rem;
            border-left: 1px solid #eef2f7;
            text-align: right;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #6c757d;
            margin-bottom: 0.2rem;
            font-weight: 600;
        }

        .stat-value {
            font-weight: 700;
            color: #198754;
            font-size: 1.1rem;
        }

        .stat-value.commission {
            color: #d97706;
            /* Gold/Orange */
        }

        /* Section Title */
        .section-title {
            padding: 0.5rem 1.5rem;
            font-weight: 700;
            color: #343a40;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        /* Transactions List */
        .transaction-list {
            padding: 0 1.5rem 3rem 1.5rem;
        }

        .trx-item {
            background: #fff;
            border-radius: 16px;
            padding: 1.2rem 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .trx-item:active {
            transform: scale(0.98);
        }

        .trx-icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            background: #eef2f7;
            color: #0d2e5c;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .trx-icon.icon-profit {
            background: #e6f4ea;
            color: #198754;
        }

        .trx-details {
            flex: 1;
            min-width: 0;
        }

        .trx-title {
            font-weight: 600;
            color: #2b3440;
            margin: 0 0 0.2rem 0;
            font-size: 0.95rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .trx-date {
            font-size: 0.75rem;
            color: #8c98a4;
            margin: 0;
        }

        .trx-amount {
            text-align: right;
            padding-left: 0.5rem;
        }

        .trx-profit {
            font-weight: 700;
            color: #198754;
            font-size: 0.95rem;
            margin: 0 0 0.2rem 0;
        }

        .trx-buy-sell {
            font-size: 0.7rem;
            color: #8c98a4;
            margin: 0;
            white-space: nowrap;
        }

        /* Floating Action Button (Log Out) */
        .btn-logout {
            position: absolute;
            top: 2rem;
            right: 1.5rem;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #fff;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            backdrop-filter: blur(4px);
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 2rem 1rem;
            color: #8c98a4;
        }
    </style>
</head>

<body>

    <div class="mobile-container">

        <!-- Top Header -->
        <div class="app-header">
            <button class="btn-logout" id="btnLogout" title="Keluar">
                <i class="fa-solid fa-power-off"></i>
            </button>
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <img src="../assets/img/avatar/avatar-1.png" alt="Profile" class="rounded-circle shadow-sm"
                        width="56" height="56" id="userAvatar"
                        onerror="this.src='https://ui-avatars.com/api/?name=Darniati&background=eef2f7&color=0d2e5c'">
                </div>
                <div>
                    <p class="mb-0">Selamat datang, Investor</p>
                    <h5 id="investorName">Darniati</h5>
                    <p class="mb-0 small mt-1"><i class="fa-solid fa-id-badge me-1"></i> <span
                            id="investorEmail">investor@skillance.id</span></p>
                </div>
            </div>
        </div>

        <!-- Financial Card -->
        <div class="finance-card">
            <div class="balance-label">Total Saldo (Modal + Untung)</div>
            <div class="balance-amount" id="currentBalance">Rp 500.000</div>

            <div class="finance-stats">
                <div class="stat-item">
                    <div class="stat-label">Total Keuntungan</div>
                    <div class="stat-value" id="totalProfit">Rp 0</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Estimasi Komisi</div>
                    <div class="stat-value commission" id="estimatedCommission">Rp 0</div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-2 px-4">
            <h6 class="section-title mb-0 px-0">Riwayat Transaksi</h6>
            <span class="badge bg-white text-secondary border rounded-pill px-2 py-1" style="font-weight: 500;">Bulan
                Ini</span>
        </div>

        <!-- Transaction List -->
        <div class="transaction-list" id="transactionList">
            <!-- Transactions will be loaded here via JS -->
        </div>

        <!-- Floating Action Button Add Transaction -->
        <button class="btn btn-navy shadow" id="btnTambahTrx" data-bs-toggle="modal" data-bs-target="#modalAddTrx"
            style="position: absolute; bottom: 2rem; right: 1.5rem; border-radius: 50%; width: 56px; height: 56px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; z-index: 1000; background-color: #0d2e5c; color: #fff; border: none; cursor: pointer;">
            <i class="fa-solid fa-plus"></i>
        </button>

    </div>

    <!-- Modal Tambah Transaksi -->
    <div class="modal fade" id="modalAddTrx" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px; margin: 10px auto;">
            <div class="modal-content border-0" style="border-radius: 20px;">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" style="color: #0d2e5c;">Catat Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAddTrx">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Keterangan (Contoh: Pulsa Telkomsel
                                20rb)</label>
                            <input type="text" class="form-control" id="trxType" required
                                placeholder="Masukkan keterangan...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Harga Modal / Beli (Rp)</label>
                            <input type="number" class="form-control" id="trxBuy" required placeholder="Contoh: 19900"
                                min="0">
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">Harga Jual (Rp)</label>
                            <input type="number" class="form-control" id="trxSell" required placeholder="Contoh: 23000"
                                min="0">
                        </div>
                        <button type="submit" class="btn w-100 text-white shadow-sm"
                            style="background-color: #198754; border-radius: 12px; padding: 0.8rem; font-weight: 600;">
                            <i class="fa-solid fa-check me-1"></i> Simpan Transaksi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            // 1. Cek Login
            const isLoggedIn = localStorage.getItem('isLoggedIn');
            if (!isLoggedIn) {
                window.location.href = '../auth/index.html';
                // return; // Uncomment in production
            }

            // 2. Set Informasi User
            const userName = localStorage.getItem('userName') || 'Darniati';
            const userEmail = localStorage.getItem('userEmail') || 'darniati@skillance.id';

            document.getElementById('investorName').textContent = userName;
            document.getElementById('investorEmail').textContent = userEmail;

            // Jika ada avatar dinamis, pasang di sini
            const avatarUrl = 'https://ui-avatars.com/api/?name=' + encodeURIComponent(userName) + '&background=eef2f7&color=0d2e5c';
            document.getElementById('userAvatar').src = avatarUrl;

            // 3. Ambil data dari API Database (BUKAN LOCALSTORAGE)
            let transactions = [];
            let totalModal = 0;
            let totalProfit = 0;

            const formatRp = (num) => 'Rp ' + Number(num).toLocaleString('id-ID');

            function renderDashboard() {
                const transactionListEl = document.getElementById('transactionList');
                transactionListEl.innerHTML = '';

                if (transactions.length === 0) {
                    transactionListEl.innerHTML = '<div class="empty-state">Belum ada transaksi.</div>';
                } else {
                    transactions.forEach(trx => {
                        const profit = trx.sellPrice - trx.buyPrice;

                        // Parse the date properly for formatting "10 Mar 2026 14:30"
                        const d = new Date(trx.date);
                        const months = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
                        const day = d.getDate().toString().padStart(2, '0');
                        const month = months[d.getMonth()];
                        const year = d.getFullYear();
                        const hour = d.getHours().toString().padStart(2, '0');
                        const min = d.getMinutes().toString().padStart(2, '0');
                        const dateFormatted = `${day} ${month} ${year} ${hour}:${min}`;

                        const trxHtml = `
                    <div class="trx-item">
                        <div class="trx-icon icon-profit">
                            <i class="fa-solid fa-arrow-up-right-dots"></i>
                        </div>
                        <div class="trx-details">
                            <h4 class="trx-title" title="${trx.type}">${trx.type}</h4>
                            <p class="trx-date">${dateFormatted}</p>
                        </div>
                        <div class="trx-amount">
                            <p class="trx-profit">+${formatRp(profit)}</p>
                            <p class="trx-buy-sell">B: ${trx.buyPrice.toLocaleString('id-ID')} | J: ${trx.sellPrice.toLocaleString('id-ID')}</p>
                        </div>
                    </div>
                `;
                        transactionListEl.innerHTML += trxHtml;
                    });
                }

                // 5. Update Card UI
                const currentBalance = totalModal + totalProfit;
                const estCommission = totalProfit * 0.50; // Asumsi 50% komisi

                document.getElementById('currentBalance').textContent = formatRp(currentBalance);
                document.getElementById('totalProfit').textContent = formatRp(totalProfit);
                document.getElementById('estimatedCommission').textContent = formatRp(estCommission) + ' (50%)';
            }

            function loadDataFromAPI() {
                fetch('../api/investor_api.php')
                    .then(r => r.json())
                    .then(res => {
                        if (res.status === 'success') {
                            transactions = res.transactions;
                            totalModal = res.capital;
                            totalProfit = res.totalProfit;
                            renderDashboard();
                        }
                    })
                    .catch(err => console.error("Gagal load API:", err));
            }

            // Panggil render pertama kali dari API
            loadDataFromAPI();

            // 7. Handle Submit Transaksi Baru ke Database API
            const formAddTrx = document.getElementById('formAddTrx');
            if (formAddTrx) {
                formAddTrx.addEventListener('submit', function (e) {
                    e.preventDefault();

                    const typeEl = document.getElementById('trxType').value;
                    const buyEl = parseInt(document.getElementById('trxBuy').value);
                    const sellEl = parseInt(document.getElementById('trxSell').value);

                    if (buyEl >= sellEl) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: 'Harga Jual harus lebih besar dari Harga Modal!'
                        });
                        return;
                    }

                    const btn = this.querySelector('button[type="submit"]');
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Menyimpan...';

                    const newTrx = {
                        type: typeEl,
                        buyPrice: buyEl,
                        sellPrice: sellEl
                    };

                    fetch('../api/investor_api.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(newTrx)
                    })
                        .then(r => r.json())
                        .then(res => {
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Simpan Transaksi';

                            if (res.status === 'success') {
                                formAddTrx.reset();

                                // Tutup modal bootstrap
                                const modalEl = document.getElementById('modalAddTrx');
                                const modalInst = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                                modalInst.hide();

                                // Hilangkan backdrop manual jika ada yang tertinggal (fix modal glitched sometimes)
                                document.body.classList.remove('modal-open');
                                const backdrop = document.querySelector('.modal-backdrop');
                                if (backdrop) backdrop.remove();

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Transaksi berhasil dicatat dan masuk ke sistem pusat!',
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                // Reload data dari database agar termutakhirkan
                                loadDataFromAPI();
                            } else {
                                Swal.fire({ icon: 'error', title: 'Gagal', text: res.message });
                            }
                        })
                        .catch(e => {
                            console.error(e);
                            btn.disabled = false;
                            btn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Simpan Transaksi';
                        });
                });
            }

            // 6. Logout Functionality
            const btnLogout = document.getElementById('btnLogout');
            if (btnLogout) {
                btnLogout.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Keluar?',
                        text: "Anda akan keluar dari dashboard investor.",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#0d2e5c',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Keluar',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            localStorage.clear();
                            window.location.href = '../auth/index.html';
                        }
                    });
                });
            }
        });
    </script>

</body>

</html>
