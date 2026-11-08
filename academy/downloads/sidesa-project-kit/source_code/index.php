<?php
// SIDESA Standalone Interactive Preview Launcher
$dsn = "mysql:host=localhost;dbname=skillance;charset=utf8mb4";
$pdo = null;
try {
    $pdo = new PDO($dsn, "root", "", [PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT]);
} catch (Exception $e) {
    $pdo = null;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIDESA - Sistem Informasi Desa Mandiri & Layanan Surat Warga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root { --navy: #071a35; --gold: #fca311; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #f8fafc; color: #1e293b; }
        .hero-banner { background: linear-gradient(135deg, #071a35 0%, #0d2e5c 100%); color: white; padding: 40px 20px; }
        .card-stat { border-radius: 14px; border: none; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="hero-banner">
        <div class="container text-center">
            <span class="badge bg-danger rounded-pill px-3 py-2 mb-2"><i class="fa-solid fa-code me-1"></i> SOURCE CODE RESMI SIDESA</span>
            <h1 class="fw-bold mb-2">Sistem Informasi Desa Mandiri (SIDESA)</h1>
            <p class="text-white-50 max-w-xl mx-auto">Portal Layanan Surat Warga Online Mandiri, Tracking Realtime, Visualisasi APBDes, & WhatsApp Gateway</p>
            <div class="d-flex justify-content-center gap-2 mt-3">
                <a href="#portal-warga" class="btn btn-warning text-navy fw-bold rounded-pill px-4"><i class="fa-solid fa-paper-plane me-1"></i> Uji Permohonan Surat</a>
                <a href="#apbdes" class="btn btn-outline-light rounded-pill px-4"><i class="fa-solid fa-chart-pie me-1"></i> Infografis APBDes</a>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <!-- STATS -->
        <div class="row g-3 mb-5">
            <div class="col-md-3">
                <div class="card card-stat p-3 bg-white">
                    <div class="text-muted small">Total Penduduk Terdaftar</div>
                    <h3 class="fw-bold text-primary mb-0">1.842 Jiwa</h3>
                    <small class="text-success"><i class="fa-solid fa-arrow-up"></i> 100% Data Valid</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-3 bg-white">
                    <div class="text-muted small">Surat Terbit Bulan Ini</div>
                    <h3 class="fw-bold text-success mb-0">87 Berkas</h3>
                    <small class="text-muted">QR-Code Validasi Aktif</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-3 bg-white">
                    <div class="text-muted small">Dana Desa (APBDes 2026)</div>
                    <h3 class="fw-bold text-warning mb-0">Rp 1,33 M</h3>
                    <small class="text-success"><i class="fa-solid fa-check"></i> Serapan 78.4%</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat p-3 bg-white">
                    <div class="text-muted small">Status WA Gateway</div>
                    <h3 class="fw-bold text-info mb-0">Tersambung</h3>
                    <small class="text-muted">Notifikasi Realtime Aktif</small>
                </div>
            </div>
        </div>

        <div class="row g-4" id="portal-warga">
            <!-- PORTAL WARGA FORM -->
            <div class="col-lg-6">
                <div class="card card-stat p-4 bg-white h-100">
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-envelope-open-text text-danger me-2"></i> Permohonan Surat Online Mandiri</h5>
                    <form onsubmit="simulasiAjukan(event)">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nomor Induk Kependudukan (NIK) Warga</label>
                            <input type="text" class="form-control" id="simNik" value="7401012304990001" placeholder="Masukkan 16 digit NIK..." required>
                            <small class="text-muted" style="font-size:0.75rem;">Contoh NIK Demo: <code>7401012304990001</code> (Rahmat Hidayat)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Pilih Jenis Surat</label>
                            <select class="form-select" id="simJenis">
                                <option value="SKD">Surat Keterangan Domisili Warga</option>
                                <option value="SKU">Surat Keterangan Usaha (UMKM)</option>
                                <option value="SKTM">Surat Keterangan Tidak Mampu</option>
                                <option value="SKCK">Surat Pengantar Catatan Kepolisian (SKCK)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Keperluan Surat</label>
                            <input type="text" class="form-control" id="simKeperluan" value="Pengajuan Beasiswa S1 Mahasiswa" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Nomor WhatsApp Warga (Untuk Notifikasi)</label>
                            <input type="tel" class="form-control" id="simWa" value="082291700778" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2 rounded-pill shadow-sm" id="btnSimAjukan">
                            <i class="fa-solid fa-paper-plane me-1"></i> Kirim Permohonan Surat & Dapatkan Kode Tracking
                        </button>
                    </form>
                    <div id="simFeedback" class="mt-3"></div>
                </div>
            </div>

            <!-- APBDES INTERAKTIF CHART -->
            <div class="col-lg-6" id="apbdes">
                <div class="card card-stat p-4 bg-white h-100">
                    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-chart-pie text-success me-2"></i> Transparansi APBDes Interaktif (Chart.js)</h5>
                    <canvas id="apbdesChart" height="230"></canvas>
                    <div class="mt-3 text-center small text-muted">
                        Data realisasi APBDes Desa Sukamaju Tahun Anggaran 2026.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Inisialisasi Chart APBDes
    const ctx = document.getElementById('apbdesChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Penyelenggaraan Pemdes', 'Pembangunan Fisik Jalan', 'Posyandu Terpadu', 'Pemberdayaan Tani', 'Insentif Guru Mengaji'],
            datasets: [{
                data: [380000000, 450000000, 180000000, 120000000, 95000000],
                backgroundColor: ['#0284c7', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    function simulasiAjukan(e) {
        e.preventDefault();
        const nik = document.getElementById('simNik').value;
        const jenis = document.getElementById('simJenis').value;
        const keperluan = document.getElementById('simKeperluan').value;
        const wa = document.getElementById('simWa').value;
        const fb = document.getElementById('simFeedback');

        const randomCode = 'TRX-DS-2026-' + Math.floor(1000 + Math.random() * 9000);
        fb.innerHTML = `
            <div class="alert alert-success border-0 shadow-sm p-3 rounded-3">
                <div class="fw-bold mb-1"><i class="fa-solid fa-circle-check text-success"></i> Permohonan Surat Berhasil Masuk!</div>
                <div class="small">Kode Tracking Surat Anda: <strong class="badge bg-navy text-white fs-6">${randomCode}</strong></div>
                <div class="small mt-1 text-muted">Notifikasi WhatsApp telah diteruskan ke nomor: <strong>${wa}</strong></div>
                <hr class="my-2">
                <div class="small text-success fw-semibold">Status: <span class="badge bg-warning text-dark">DIVERIFIKASI OPERATOR</span></div>
            </div>
        `;
    }
    </script>
</body>
</html>
