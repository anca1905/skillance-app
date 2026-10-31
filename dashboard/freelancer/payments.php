<?php
$pageTitle = "Riwayat Pembayaran & Dompet";
require_once __DIR__ . '/includes/header.php';
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-navy mb-1"><i class="fa-solid fa-wallet text-gold me-2"></i> Riwayat Pembayaran & Rekening</h4>
        <p class="text-muted small mb-0">Pantau seluruh fee hasil pekerjaan yang telah disetujui, status transfer manual, dan kelola rekening pencairan Anda.</p>
    </div>
</div>

<!-- Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card card-custom p-4 border-start border-4 border-success">
            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Total Fee Telah Ditransfer</small>
            <h3 class="fw-bold text-success mt-1 mb-0" id="totalPaidDisplay">Rp 0</h3>
            <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;"><i class="fa-solid fa-circle-check text-success me-1"></i> Telah dikirim oleh Admin ke rekening Anda.</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-4 border-start border-4 border-warning">
            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Menunggu Transfer Manual</small>
            <h3 class="fw-bold text-warning mt-1 mb-0" id="totalPendingDisplay">Rp 0</h3>
            <small class="text-muted mt-2 d-block" style="font-size: 0.75rem;"><i class="fa-solid fa-clock text-warning me-1"></i> Tugas telah disetujui, siap ditransfer oleh Admin.</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-custom p-4 border-start border-4 border-primary">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.72rem;">Rekening Pencairan Aktif</small>
                    <h5 class="fw-bold text-navy mt-1 mb-0" id="currentBankName">Memuat...</h5>
                    <div class="text-muted small" id="currentBankNumber">-</div>
                    <small class="text-muted" id="currentBankHolder">-</small>
                </div>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditBank">
                    <i class="fa-solid fa-pen me-1"></i> Edit
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Riwayat Pembayaran -->
<div class="card card-custom p-4">
    <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-receipt text-gold me-2"></i> Daftar Transaksi Pembayaran Fee</h5>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="small text-muted text-uppercase">
                    <th>#</th>
                    <th>Pekerjaan / Tugas</th>
                    <th>Nominal Fee</th>
                    <th>Rekening Tujuan</th>
                    <th>Status Pembayaran</th>
                    <th>Waktu Transfer</th>
                    <th>Bukti Transfer</th>
                </tr>
            </thead>
            <tbody id="payoutsTableBody">
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        <i class="fa-solid fa-circle-notch fa-spin me-2"></i> Memuat riwayat pembayaran...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Rekening Bank / E-Wallet -->
<div class="modal fade" id="modalEditBank" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-custom">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-navy"><i class="fa-solid fa-credit-card text-gold me-2"></i> Atur Rekening / E-Wallet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formBankSettings">
                <div class="modal-body p-4">
                    <input type="hidden" name="action" value="update_profile">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($currentUser['name']) ?>">
                    <input type="hidden" name="user_type" value="<?= htmlspecialchars($currentUser['user_type']) ?>">
                    <input type="hidden" name="phone" value="<?= htmlspecialchars($currentUser['phone'] ?? '') ?>">
                    <input type="hidden" name="institution" value="<?= htmlspecialchars($currentUser['institution'] ?? '') ?>">
                    <input type="hidden" name="major" value="<?= htmlspecialchars($currentUser['major'] ?? '') ?>">
                    <input type="hidden" name="nim" value="<?= htmlspecialchars($currentUser['nim'] ?? '') ?>">
                    <input type="hidden" name="skills" value="<?= htmlspecialchars($currentUser['skills'] ?? '') ?>">
                    <input type="hidden" name="bio" value="<?= htmlspecialchars($currentUser['bio'] ?? '') ?>">
                    <input type="hidden" name="portfolio_url" value="<?= htmlspecialchars($currentUser['portfolio_url'] ?? '') ?>">

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy">Pilih Bank / E-Wallet</label>
                        <select name="bank_name" id="inputBankName" class="form-select" required>
                            <option value="">-- Pilih Penyedia Rekening --</option>
                            <optgroup label="Bank Nasional">
                                <option value="BCA">BCA (Bank Central Asia)</option>
                                <option value="Mandiri">Bank Mandiri</option>
                                <option value="BRI">Bank BRI</option>
                                <option value="BNI">Bank BNI</option>
                                <option value="BSI">Bank Syariah Indonesia (BSI)</option>
                                <option value="CIMB">CIMB Niaga</option>
                                <option value="Jago">Bank Jago</option>
                                <option value="Seabank">Seabank</option>
                            </optgroup>
                            <optgroup label="E-Wallet">
                                <option value="Dana">Dana</option>
                                <option value="GoPay">GoPay</option>
                                <option value="OVO">OVO</option>
                                <option value="ShopeePay">ShopeePay</option>
                            </optgroup>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy">Nomor Rekening / No. HP E-Wallet</label>
                        <input type="text" name="bank_account_number" id="inputBankNumber" class="form-control" placeholder="Contoh: 1234567890 atau 082291700778" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy">Nama Lengkap Pemilik Rekening (Atas Nama)</label>
                        <input type="text" name="bank_account_name" id="inputBankHolder" class="form-control" placeholder="Nama sesuai buku tabungan atau akun e-wallet" required>
                    </div>

                    <div class="alert alert-info py-2 px-3 small mb-0">
                        <i class="fa-solid fa-shield-halved me-1"></i> Pastikan data rekening benar dan valid agar proses transfer manual dari Admin berjalan lancar.
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-navy fw-bold" id="btnSaveBank">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Rekening
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tampil Bukti Transfer -->
<div class="modal fade" id="modalReceiptView" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-custom">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-navy"><i class="fa-solid fa-receipt text-gold me-2"></i> Bukti Transfer Fee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <div id="receiptContainer">
                    <img id="receiptImage" src="" alt="Bukti Transfer" class="img-fluid rounded border shadow-sm mb-3" style="max-height: 450px;">
                </div>
                <div class="p-3 bg-light rounded text-start">
                    <small class="text-muted d-block" id="receiptJobTitle"></small>
                    <small class="text-muted d-block" id="receiptDate"></small>
                    <small class="text-muted d-block" id="receiptNotes"></small>
                </div>
            </div>
            <div class="modal-footer border-top">
                <a href="#" id="btnDownloadReceipt" target="_blank" class="btn btn-sm btn-outline-primary"><i class="fa-solid fa-download me-1"></i> Unduh Struk</a>
                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadPayoutsData();

    // Form Bank update handler
    const formBank = document.getElementById('formBankSettings');
    formBank.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSaveBank');
        const origText = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Menyimpan...';
        btn.disabled = true;

        const formData = new FormData(formBank);

        fetch('../../api/freelance_api.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalEditBank'));
                if (modal) modal.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Tersimpan!',
                    text: data.message
                });
                loadPayoutsData();
            } else {
                Swal.fire({ icon: 'error', title: 'Gagal', text: data.message });
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan sistem.' });
        })
        .finally(() => {
            btn.innerHTML = origText;
            btn.disabled = false;
        });
    });
});

function loadPayoutsData() {
    fetch('../../api/freelance_api.php?action=get_payouts')
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            document.getElementById('totalPaidDisplay').innerText = formatRupiah(data.total_paid);
            document.getElementById('totalPendingDisplay').innerText = formatRupiah(data.total_pending);

            // Tampilkan Info Bank
            if (data.bank_account && data.bank_account.bank_account_number) {
                document.getElementById('currentBankName').innerText = data.bank_account.bank_name || 'Bank';
                document.getElementById('currentBankNumber').innerText = data.bank_account.bank_account_number;
                document.getElementById('currentBankHolder').innerText = 'a.n. ' + (data.bank_account.bank_account_name || '-');

                // Isi modal form
                document.getElementById('inputBankName').value = data.bank_account.bank_name || '';
                document.getElementById('inputBankNumber').value = data.bank_account.bank_account_number || '';
                document.getElementById('inputBankHolder').value = data.bank_account.bank_account_name || '';
            } else {
                document.getElementById('currentBankName').innerHTML = '<span class="text-danger small"><i class="fa-solid fa-circle-exclamation me-1"></i> Belum Diatur</span>';
                document.getElementById('currentBankNumber').innerText = 'Klik Edit untuk menambah';
                document.getElementById('currentBankHolder').innerText = '-';
            }

            renderPayoutsTable(data.payouts);
        }
    })
    .catch(err => console.error('Error fetching payouts:', err));
}

function renderPayoutsTable(payouts) {
    const tbody = document.getElementById('payoutsTableBody');
    if (!payouts || payouts.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="text-center py-4 text-muted">
                    <i class="fa-solid fa-money-bill-wave text-muted fs-3 mb-2 d-block"></i>
                    Belum ada riwayat transaksi pembayaran.
                </td>
            </tr>
        `;
        return;
    }

    let html = '';
    payouts.forEach((p, idx) => {
        let statusBadge = '';
        let receiptAction = '-';

        if (p.status === 'transferred') {
            statusBadge = '<span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> Ditransfer</span>';
            if (p.transfer_receipt) {
                receiptAction = `
                    <button class="btn btn-sm btn-outline-success fw-bold py-1 px-2" style="font-size:0.75rem;" onclick="viewReceipt('${p.transfer_receipt}', '${escapeHtml(p.job_title)}', '${p.transferred_at}', '${escapeHtml(p.transfer_notes)}')">
                        <i class="fa-solid fa-receipt me-1"></i> Lihat Struk
                    </button>
                `;
            } else {
                receiptAction = '<span class="text-muted small">Tanpa lampiran</span>';
            }
        } else {
            statusBadge = '<span class="badge bg-warning text-dark"><i class="fa-solid fa-hourglass-half me-1"></i> Menunggu Transfer Admin</span>';
            receiptAction = '<span class="text-muted small fst-italic">Menunggu proses</span>';
        }

        html += `
            <tr>
                <td class="text-muted">${idx + 1}</td>
                <td>
                    <div class="fw-bold text-navy">${escapeHtml(p.job_title)}</div>
                    <small class="text-muted">${p.category}</small>
                </td>
                <td class="fw-bold text-success">${formatRupiah(p.amount)}</td>
                <td>
                    <span class="badge bg-light text-navy border">${p.bank_name}</span>
                    <div class="small text-muted">${p.account_number}</div>
                    <small class="text-muted d-block" style="font-size: 0.72rem;">a.n. ${escapeHtml(p.account_name)}</small>
                </td>
                <td>${statusBadge}</td>
                <td><small class="text-muted">${p.transferred_at || 'Dalam Antrean'}</small></td>
                <td>${receiptAction}</td>
            </tr>
        `;
    });
    tbody.innerHTML = html;
}

function viewReceipt(filename, jobTitle, date, notes) {
    const fileUrl = `../../uploads/transfer_receipts/${filename}`;
    document.getElementById('receiptImage').src = fileUrl;
    document.getElementById('receiptJobTitle').innerHTML = `<strong>Tugas:</strong> ${jobTitle}`;
    document.getElementById('receiptDate').innerHTML = `<strong>Tanggal Transfer:</strong> ${date || '-'}`;
    document.getElementById('receiptNotes').innerHTML = `<strong>Catatan:</strong> ${notes || 'Transfer fee via m-banking'}`;
    document.getElementById('btnDownloadReceipt').href = fileUrl;

    new bootstrap.Modal(document.getElementById('modalReceiptView')).show();
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
