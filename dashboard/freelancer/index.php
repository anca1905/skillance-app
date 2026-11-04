<?php
$pageTitle = "Dashboard Freelancer";
require_once __DIR__ . '/includes/header.php';

// Cek kelengkapan rekening
$isBankEmpty = empty($currentUser['bank_account_number']);
?>

<?php if ($isBankEmpty): ?>
    <div class="alert alert-warning alert-dismissible fade show card-custom border-start border-4 border-warning mb-4" role="alert">
        <div class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-triangle-exclamation fs-3 text-warning"></i>
            <div>
                <strong>Rekening Pencairan Belum Diatur!</strong>
                <p class="mb-0 small text-muted">Agar Admin dapat mentransfer fee hasil pekerjaan Anda, mohon lengkapi data nomor rekening atau e-wallet Anda.</p>
            </div>
            <a href="profile.php" class="btn btn-sm btn-warning ms-auto text-nowrap fw-bold"><i class="fa-solid fa-credit-card me-1"></i> Atur Rekening</a>
        </div>
    </div>
<?php endif; ?>

<!-- Welcome Hero Banner -->
<div class="card card-custom p-4 mb-4" style="background: linear-gradient(135deg, #0d2e5c 0%, #1a447e 100%); color: white;">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <span class="badge bg-warning text-dark fw-bold mb-2 px-3 py-1 text-uppercase" style="font-size: 0.72rem;">
                <i class="fa-solid fa-bolt me-1"></i> Platform Freelance Skillance
            </span>
            <h3 class="fw-bold mb-1">Selamat Datang, <?= htmlspecialchars($userName) ?>!</h3>
            <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                <?php if ($userType === 'mahasiswa'): ?>
                    Asal Kampus: <strong><?= htmlspecialchars($currentUser['institution'] ?? 'Mahasiswa') ?></strong> <?= !empty($currentUser['major']) ? ' - ' . htmlspecialchars($currentUser['major']) : '' ?>
                <?php else: ?>
                    Kategori: <strong>Freelancer Umum</strong>
                <?php endif; ?>
                &bull; Mulai ambil proyek menarik dan kembangkan portofoliomu.
            </p>
        </div>
        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
            <a href="jobs.php" class="btn btn-gold px-4 py-2 fw-bold shadow-sm">
                <i class="fa-solid fa-briefcase me-2"></i> Jelajahi Lowongan
            </a>
        </div>
    </div>
</div>

<!-- Stat Cards -->
<div class="row g-3 mb-4" id="statsContainer">
    <div class="col-6 col-md-3">
        <div class="card card-custom p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-card-icon bg-green-light">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
                <div>
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Fee Ditransfer</small>
                    <h5 class="fw-bold text-success mb-0" id="statPaid">Rp 0</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-custom p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-card-icon bg-gold-light">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Menunggu Transfer</small>
                    <h5 class="fw-bold text-warning mb-0" id="statPending">Rp 0</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-custom p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-card-icon bg-navy-light">
                    <i class="fa-solid fa-spinner"></i>
                </div>
                <div>
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Sedang Dikerjakan</small>
                    <h5 class="fw-bold text-navy mb-0" id="statInProgress">0 Tugas</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card card-custom p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-card-icon bg-purple-light">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Tugas Selesai</small>
                    <h5 class="fw-bold text-purple mb-0" id="statCompleted">0 Tugas</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Kolom Kiri: Tugas Aktif Saya -->
    <div class="col-lg-8">
        <div class="card card-custom p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-navy mb-0">
                    <i class="fa-solid fa-list-check text-gold me-2"></i> Tugas Aktif yang Sedang Dikerjakan
                </h5>
                <a href="my_tasks.php" class="btn btn-sm btn-outline-primary fw-semibold" style="font-size: 0.78rem;">
                    Lihat Semua Tugas &rarr;
                </a>
            </div>

            <div id="activeTasksContainer">
                <div class="text-center py-4 text-muted">
                    <i class="fa-solid fa-circle-notch fa-spin fs-4 mb-2"></i>
                    <p class="mb-0">Memuat data tugas...</p>
                </div>
            </div>
        </div>

        <!-- Lowongan Rekomendasi Terbuka -->
        <div class="card card-custom p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-navy mb-0">
                    <i class="fa-solid fa-briefcase text-gold me-2"></i> Lowongan Freelance Terbaru
                </h5>
                <a href="jobs.php" class="btn btn-sm btn-outline-primary fw-semibold" style="font-size: 0.78rem;">
                    Buka Bursa Lowongan &rarr;
                </a>
            </div>

            <div id="recommendedJobsContainer">
                <div class="text-center py-4 text-muted">
                    <i class="fa-solid fa-circle-notch fa-spin fs-4 mb-2"></i>
                    <p class="mb-0">Memuat lowongan...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Info Profil & Rekening Freelancer -->
    <div class="col-lg-4">
        <!-- Rekening Card -->
        <div class="card card-custom p-4 mb-4">
            <h6 class="fw-bold text-navy mb-3"><i class="fa-solid fa-credit-card text-gold me-2"></i> Rekening Transfer Manual</h6>
            <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                <?php if (!empty($currentUser['bank_account_number'])): ?>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary px-2 py-1"><?= htmlspecialchars($currentUser['bank_name'] ?? 'Bank') ?></span>
                        <small class="text-success fw-bold"><i class="fa-solid fa-check-circle me-1"></i> Siap Menerima Fee</small>
                    </div>
                    <div class="fw-bold fs-5 text-navy ls-1"><?= htmlspecialchars($currentUser['bank_account_number']) ?></div>
                    <small class="text-muted d-block mt-1">a.n. <?= htmlspecialchars($currentUser['bank_account_name'] ?? $userName) ?></small>
                <?php else: ?>
                    <p class="text-danger small mb-2"><i class="fa-solid fa-circle-exclamation me-1"></i> Belum ada nomor rekening terdaftar.</p>
                    <a href="profile.php" class="btn btn-sm btn-outline-primary w-100">Tambah Rekening</a>
                <?php endif; ?>
            </div>
            <div class="mt-3">
                <small class="text-muted" style="font-size: 0.75rem;">
                    <i class="fa-solid fa-info-circle me-1"></i> Fee pekerjaan Anda akan langsung ditransfer manual oleh Admin ke rekening di atas setelah hasil kerja disetujui.
                </small>
            </div>
        </div>

        <!-- Sinergi Skillance Academy (Akun Terpadu) -->
        <div class="card card-custom p-4 mb-4" style="background: linear-gradient(135deg, #0d2e5c 0%, #061a35 100%); color: #ffffff;">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="bg-gold p-2 rounded-circle text-navy d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                        <i class="fa-solid fa-graduation-cap fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0 text-white">Skillance Academy</h6>
                        <small class="text-white-50" style="font-size: 0.72rem;">Platform Belajar Koding Interaktif</small>
                    </div>
                </div>
                <span class="badge bg-gold text-navy fw-bold px-2 py-1" style="font-size: 0.65rem;">AKUN TERPADU</span>
            </div>
            <p class="small text-white-50 mb-3" style="line-height: 1.6;">
                Tingkatkan skill coding Anda (Web, Backend API, Flutter Mobile, UI/UX) untuk mendapatkan verifikasi keahlian dan prioritas tugas freelance.
            </p>
            <a href="../../auth/sso_jump.php?target=academy" target="_blank" class="btn btn-gold btn-sm w-100 fw-bold rounded-pill shadow-sm">
                <i class="fa-solid fa-laptop-code me-1"></i> Buka Portal Belajar (academy.skillance.cloud)
            </a>
        </div>

        <!-- Panduan Singkat -->
        <div class="card card-custom p-4" style="background: #fffdf5; border: 1px solid #fef3c7;">
            <h6 class="fw-bold text-navy mb-3"><i class="fa-solid fa-lightbulb text-gold me-2"></i> Cara Kerja Freelance</h6>
            <ol class="small text-muted ps-3 mb-0" style="line-height: 1.8;">
                <li><strong>Cari Lowongan:</strong> Pilih tugas yang sesuai dengan skill Anda di menu <em>Bursa Lowongan</em>.</li>
                <li><strong>Kerjakan Tugas:</strong> Selesaikan tugas sebelum tanggal deadline yang ditentukan.</li>
                <li><strong>Kirim Hasil Kerja:</strong> Lampirkan link (Google Drive/Figma/GitHub) atau file di menu <em>Pekerjaan Saya</em>.</li>
                <li><strong>Terima Pembayaran:</strong> Setelah admin memverifikasi dan menyetujui, admin akan mentransfer fee Anda dan mengunggah bukti struk.</li>
            </ol>
        </div>
    </div>
</div>

<!-- Modal Submit Hasil Kerja Cepat -->
<div class="modal fade" id="modalSubmitTask" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-custom">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-navy"><i class="fa-solid fa-cloud-arrow-up text-gold me-2"></i> Ajukan Hasil Kerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formSubmitTask" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="action" value="submit_task">
                    <input type="hidden" name="assignment_id" id="submitAssignmentId">

                    <div class="mb-3">
                        <label class="form-label fw-bold text-navy small">Judul Tugas</label>
                        <input type="text" id="submitTaskTitle" class="form-control bg-light" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-navy small">Tautan Hasil Kerja (Google Drive, Figma, GitHub, dll.) <span class="text-danger">*</span></label>
                        <input type="url" name="submission_link" id="submitLink" class="form-control" placeholder="https://drive.google.com/... atau https://figma.com/..." required>
                        <small class="text-muted" style="font-size: 0.72rem;">Pastikan akses link sudah dibuka (Public / Anyone with the link).</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-navy small">Unggah Berkas Pendukung (Opsional)</label>
                        <input type="file" name="submission_file" id="submitFile" class="form-control">
                        <small class="text-muted" style="font-size: 0.72rem;">Format: ZIP, PDF, DOC, PNG, JPG (Maks. 25MB).</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-navy small">Catatan Pengerjaan untuk Admin</label>
                        <textarea name="submission_notes" id="submitNotes" class="form-control" rows="3" placeholder="Tuliskan keterangan hasil pengerjaan atau detail yang perlu diketahui admin..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gold fw-bold" id="btnConfirmSubmit">
                        <i class="fa-solid fa-paper-plane me-1"></i> Kirim untuk Ditinjau
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadOverviewData();

    // Form submit deliverable handler
    const formSubmit = document.getElementById('formSubmitTask');
    formSubmit.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('btnConfirmSubmit');
        const origText = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Mengirim...';
        btn.disabled = true;

        const formData = new FormData(formSubmit);

        fetch('../../api/freelance_api.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalSubmitTask'));
                if (modal) modal.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil Diajukan!',
                    text: data.message
                });
                loadOverviewData();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mengajukan',
                    text: data.message
                });
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

function loadOverviewData() {
    fetch('../../api/freelance_api.php?action=get_overview')
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            // Render Stats
            document.getElementById('statPaid').innerText = formatRupiah(data.stats.total_earnings_paid);
            document.getElementById('statPending').innerText = formatRupiah(data.stats.total_earnings_pending);
            document.getElementById('statInProgress').innerText = data.stats.in_progress + ' Tugas';
            document.getElementById('statCompleted').innerText = data.stats.total_completed + ' Tugas';

            // Render Active Tasks
            renderActiveTasks(data.active_tasks);

            // Render Recommended Jobs
            renderRecommendedJobs(data.recent_jobs);
        }
    })
    .catch(err => console.error('Error fetching overview:', err));
}

function renderActiveTasks(tasks) {
    const container = document.getElementById('activeTasksContainer');
    if (!tasks || tasks.length === 0) {
        container.innerHTML = `
            <div class="text-center py-4 bg-light rounded-3">
                <i class="fa-solid fa-clipboard-check text-muted fs-2 mb-2"></i>
                <p class="mb-1 text-muted fw-bold">Belum ada tugas yang sedang Anda kerjakan.</p>
                <small class="text-muted d-block mb-3">Jelajahi bursa lowongan dan ambil pekerjaan pertama Anda!</small>
                <a href="jobs.php" class="btn btn-sm btn-gold fw-bold"><i class="fa-solid fa-magnifying-glass me-1"></i> Cari Tugas Sekarang</a>
            </div>
        `;
        return;
    }

    let html = '<div class="d-flex flex-column gap-3">';
    tasks.forEach(t => {
        let badgeStatus = '';
        let actionBtn = '';

        if (t.status === 'in_progress' || t.status === 'accepted') {
            badgeStatus = '<span class="badge bg-primary"><i class="fa-solid fa-spinner fa-spin me-1"></i> Sedang Dikerjakan</span>';
            actionBtn = `<button class="btn btn-sm btn-gold fw-bold" onclick="openSubmitModal(${t.assignment_id}, '${escapeHtml(t.title)}')"><i class="fa-solid fa-cloud-arrow-up me-1"></i> Submit Hasil</button>`;
        } else if (t.status === 'submitted') {
            badgeStatus = '<span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i> Menunggu Review Admin</span>';
            actionBtn = `<a href="my_tasks.php" class="btn btn-sm btn-light fw-bold text-navy"><i class="fa-solid fa-eye me-1"></i> Cek Pengajuan</a>`;
        } else if (t.status === 'revision') {
            badgeStatus = '<span class="badge bg-danger"><i class="fa-solid fa-triangle-exclamation me-1"></i> Butuh Revisi</span>';
            actionBtn = `<button class="btn btn-sm btn-danger fw-bold" onclick="openSubmitModal(${t.assignment_id}, '${escapeHtml(t.title)}')"><i class="fa-solid fa-repeat me-1"></i> Kirim Revisi</button>`;
        }

        let deadlineText = t.days_left >= 0 ? `${t.days_left} hari lagi (${t.deadline})` : `<span class="text-danger fw-bold">Lewat ${Math.abs(t.days_left)} hari (${t.deadline})</span>`;

        html += `
            <div class="p-3 rounded-3 border bg-white d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        ${badgeStatus}
                        <span class="badge bg-light text-muted border">${t.category}</span>
                    </div>
                    <h6 class="fw-bold text-navy mb-1">${escapeHtml(t.title)}</h6>
                    <div class="d-flex flex-wrap gap-3 small text-muted">
                        <span><i class="fa-solid fa-coins text-warning me-1"></i> Fee: <strong class="text-success">${formatRupiah(t.reward_amount)}</strong></span>
                        <span><i class="fa-regular fa-clock me-1"></i> Batas: ${deadlineText}</span>
                    </div>
                    ${t.status === 'revision' && t.revision_feedback ? `
                        <div class="alert alert-danger py-1 px-2 mt-2 mb-0 small">
                            <strong>Catatan Admin:</strong> ${escapeHtml(t.revision_feedback)}
                        </div>
                    ` : ''}
                </div>
                <div class="d-flex gap-2 align-self-end align-self-md-center">
                    ${actionBtn}
                </div>
            </div>
        `;
    });
    html += '</div>';
    container.innerHTML = html;
}

function renderRecommendedJobs(jobs) {
    const container = document.getElementById('recommendedJobsContainer');
    if (!jobs || jobs.length === 0) {
        container.innerHTML = '<p class="text-muted text-center py-3">Belum ada lowongan baru yang dibuka saat ini.</p>';
        return;
    }

    let html = '<div class="row g-3">';
    jobs.forEach(j => {
        let isApplied = j.has_applied > 0;
        let btnAction = isApplied ? 
            `<button class="btn btn-sm btn-secondary disabled w-100" style="font-size: 0.75rem;"><i class="fa-solid fa-check me-1"></i> Sudah Diambil</button>` :
            `<button class="btn btn-sm btn-outline-primary fw-bold w-100" style="font-size: 0.75rem;" onclick="quickApplyJob(${j.id}, '${escapeHtml(j.title)}')"><i class="fa-solid fa-handshake me-1"></i> Ambil Tugas</button>`;

        html += `
            <div class="col-md-6">
                <div class="p-3 border rounded-3 h-100 d-flex flex-column justify-content-between bg-white">
                    <div>
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge bg-light text-navy border">${j.category}</span>
                            <span class="badge bg-gold-light text-dark fw-bold">${formatRupiah(j.reward_amount)}</span>
                        </div>
                        <h6 class="fw-bold text-navy mb-2" style="font-size: 0.92rem;">${escapeHtml(j.title)}</h6>
                        <p class="text-muted small mb-3 text-truncate-2" style="font-size: 0.8rem; min-height: 38px;">
                            ${escapeHtml(j.description)}
                        </p>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2 small text-muted" style="font-size: 0.72rem;">
                            <span><i class="fa-solid fa-calendar-day me-1"></i> Deadline: ${j.deadline}</span>
                            <span>Target: <strong class="text-capitalize">${j.target_audience}</strong></span>
                        </div>
                        ${btnAction}
                    </div>
                </div>
            </div>
        `;
    });
    html += '</div>';
    container.innerHTML = html;
}

function openSubmitModal(assignmentId, title) {
    document.getElementById('submitAssignmentId').value = assignmentId;
    document.getElementById('submitTaskTitle').value = title;
    document.getElementById('submitLink').value = '';
    document.getElementById('submitFile').value = '';
    document.getElementById('submitNotes').value = '';
    new bootstrap.Modal(document.getElementById('modalSubmitTask')).show();
}

function quickApplyJob(jobId, title) {
    Swal.fire({
        title: 'Ambil Tugas Ini?',
        html: `Apakah Anda yakin ingin mengambil tugas:<br><strong>${title}</strong>?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Ambil Sekarang!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#0d2e5c'
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('action', 'apply_job');
            formData.append('job_id', jobId);

            fetch('../../api/freelance_api.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tugas Diterima!',
                        text: data.message
                    }).then(() => {
                        window.location.href = 'my_tasks.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message
                    });
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan sistem.' });
            });
        }
    });
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
