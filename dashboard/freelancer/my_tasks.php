<?php
$pageTitle = "Pekerjaan Saya";
require_once __DIR__ . '/includes/header.php';
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-navy mb-1"><i class="fa-solid fa-list-check text-gold me-2"></i> Daftar Tugas & Pekerjaan Saya</h4>
        <p class="text-muted small mb-0">Kelola proses pengerjaan tugas, ajukan hasil karya, dan pantau status review admin.</p>
    </div>
    <a href="jobs.php" class="btn btn-gold btn-sm px-3 py-2 fw-bold">
        <i class="fa-solid fa-plus me-1"></i> Ambil Pekerjaan Baru
    </a>
</div>

<!-- Filter Tabs Status -->
<div class="card card-custom p-2 mb-4 overflow-x-auto">
    <ul class="nav nav-pills flex-nowrap gap-2 text-nowrap" id="statusFilterTabs" style="min-width: max-content;">
        <li class="nav-item">
            <button class="nav-link active fw-bold" onclick="filterTasks('all', this)">
                <i class="fa-solid fa-layer-group me-1"></i> Semua Tugas
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link fw-bold" onclick="filterTasks('in_progress', this)">
                <i class="fa-solid fa-spinner me-1"></i> Sedang Dikerjakan
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link fw-bold" onclick="filterTasks('submitted', this)">
                <i class="fa-solid fa-clock me-1"></i> Menunggu Review
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link fw-bold text-danger" onclick="filterTasks('revision', this)">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> Perlu Revisi
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link fw-bold text-success" onclick="filterTasks('completed', this)">
                <i class="fa-solid fa-circle-check me-1"></i> Selesai
            </button>
        </li>
    </ul>
</div>

<!-- Task List Container -->
<div id="tasksListContainer">
    <div class="text-center py-5 text-muted">
        <i class="fa-solid fa-circle-notch fa-spin fs-3 mb-3 text-gold"></i>
        <p class="mb-0">Memuat pekerjaan Anda...</p>
    </div>
</div>

<!-- Modal Submit / Revisi Tugas -->
<div class="modal fade" id="modalSubmitTask" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-custom">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-navy" id="modalSubmitTitle">
                    <i class="fa-solid fa-cloud-arrow-up text-gold me-2"></i> Kirim Hasil Pengerjaan
                </h5>
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
                        <label class="form-label fw-bold text-navy small">Tautan Hasil Kerja (Link) <span class="text-danger">*</span></label>
                        <input type="url" name="submission_link" id="submitLink" class="form-control" placeholder="https://drive.google.com/... atau https://github.com/..." required>
                        <small class="text-muted" style="font-size: 0.72rem;">Sertakan tautan Google Drive / Figma / GitHub / Dokumen online yang dapat diakses admin.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-navy small">Unggah Berkas (Opsional jika ada file langsung)</label>
                        <input type="file" name="submission_file" id="submitFile" class="form-control">
                        <small class="text-muted" style="font-size: 0.72rem;">Mendukung berkas: ZIP, PDF, DOC, PNG, JPG (Maks 25MB).</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-navy small">Catatan / Deskripsi Pengerjaan</label>
                        <textarea name="submission_notes" id="submitNotes" class="form-control" rows="3" placeholder="Tuliskan catatan atau instruksi penting kepada admin terkait hasil kerja ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gold fw-bold" id="btnConfirmSubmit">
                        <i class="fa-solid fa-paper-plane me-1"></i> Kirim Hasil Kerja
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentFilter = 'all';

document.addEventListener('DOMContentLoaded', function() {
    loadMyTasks('all');

    // Submit form handler
    const formSubmit = document.getElementById('formSubmitTask');
    formSubmit.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('btnConfirmSubmit');
        const origText = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Mengirimkan...';
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
                    title: 'Berhasil Terkirim!',
                    text: data.message
                });
                loadMyTasks(currentFilter);
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
        })
        .finally(() => {
            btn.innerHTML = origText;
            btn.disabled = false;
        });
    });
});

function filterTasks(status, btnElement) {
    currentFilter = status;
    document.querySelectorAll('#statusFilterTabs .nav-link').forEach(btn => btn.classList.remove('active'));
    if (btnElement) btnElement.classList.add('active');
    loadMyTasks(status);
}

function loadMyTasks(status) {
    const container = document.getElementById('tasksListContainer');
    container.innerHTML = `
        <div class="text-center py-5 text-muted">
            <i class="fa-solid fa-circle-notch fa-spin fs-3 mb-3 text-gold"></i>
            <p class="mb-0">Memuat pekerjaan...</p>
        </div>
    `;

    fetch(`../../api/freelance_api.php?action=get_my_tasks&status=${status}`)
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            renderTasksList(data.tasks);
        } else {
            container.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(err => {
        console.error(err);
        container.innerHTML = '<div class="alert alert-danger">Gagal terhubung ke server.</div>';
    });
}

function renderTasksList(tasks) {
    const container = document.getElementById('tasksListContainer');
    if (!tasks || tasks.length === 0) {
        container.innerHTML = `
            <div class="card card-custom p-5 text-center">
                <i class="fa-solid fa-clipboard-list text-muted fs-1 mb-3"></i>
                <h5 class="fw-bold text-navy mb-1">Tidak Ada Pekerjaan pada Kategori Ini</h5>
                <p class="text-muted small mb-4">Anda belum memiliki pekerjaan dengan status yang dipilih.</p>
                <div>
                    <a href="jobs.php" class="btn btn-gold fw-bold px-4 py-2"><i class="fa-solid fa-magnifying-glass me-2"></i> Cari Lowongan Pekerjaan</a>
                </div>
            </div>
        `;
        return;
    }

    let html = '<div class="d-flex flex-column gap-3">';
    tasks.forEach(t => {
        let badgeStatus = '';
        let actionBtn = '';
        let statusCardBorder = '';

        if (t.status === 'in_progress' || t.status === 'accepted') {
            badgeStatus = '<span class="badge bg-primary px-3 py-2"><i class="fa-solid fa-spinner fa-spin me-1"></i> Sedang Dikerjakan</span>';
            actionBtn = `<button class="btn btn-gold fw-bold btn-sm px-3" onclick="openSubmitModal(${t.assignment_id}, '${escapeHtml(t.title)}', false)"><i class="fa-solid fa-cloud-arrow-up me-1"></i> Kirim Hasil Kerja</button>`;
            statusCardBorder = 'border-start border-4 border-primary';
        } else if (t.status === 'submitted') {
            badgeStatus = '<span class="badge bg-warning text-dark px-3 py-2"><i class="fa-solid fa-clock me-1"></i> Menunggu Review Admin</span>';
            actionBtn = `<button class="btn btn-outline-secondary fw-bold btn-sm px-3" onclick="openSubmitModal(${t.assignment_id}, '${escapeHtml(t.title)}', true)"><i class="fa-solid fa-pen-to-square me-1"></i> Perbarui Pengajuan</button>`;
            statusCardBorder = 'border-start border-4 border-warning';
        } else if (t.status === 'revision') {
            badgeStatus = '<span class="badge bg-danger px-3 py-2"><i class="fa-solid fa-triangle-exclamation me-1"></i> Perlu Revisi</span>';
            actionBtn = `<button class="btn btn-danger fw-bold btn-sm px-3" onclick="openSubmitModal(${t.assignment_id}, '${escapeHtml(t.title)}', false)"><i class="fa-solid fa-repeat me-1"></i> Kirim Ulang Revisi</button>`;
            statusCardBorder = 'border-start border-4 border-danger';
        } else if (t.status === 'completed') {
            badgeStatus = '<span class="badge bg-success px-3 py-2"><i class="fa-solid fa-circle-check me-1"></i> Selesai & Disetujui</span>';
            
            // Payout Status
            let payoutBadge = '';
            if (t.payout_status === 'transferred') {
                payoutBadge = `<span class="badge bg-success"><i class="fa-solid fa-check-double me-1"></i> Fee Telah Ditransfer</span>`;
                if (t.transfer_receipt) {
                    payoutBadge += ` <a href="../../uploads/transfer_receipts/${t.transfer_receipt}" target="_blank" class="btn btn-xs btn-outline-success ms-2 py-0 px-2" style="font-size:0.75rem;"><i class="fa-solid fa-receipt me-1"></i> Struk</a>`;
                }
            } else {
                payoutBadge = `<span class="badge bg-warning text-dark"><i class="fa-solid fa-hourglass-half me-1"></i> Menunggu Transfer Manual Admin</span>`;
            }
            actionBtn = payoutBadge;
            statusCardBorder = 'border-start border-4 border-success';
        }

        let deadlineInfo = t.days_left >= 0 ? 
            `<span class="badge bg-light text-navy border"><i class="fa-regular fa-clock me-1"></i> Sisa Waktu: <strong>${t.days_left} Hari</strong> (${t.deadline})</span>` :
            `<span class="badge bg-danger text-white"><i class="fa-solid fa-triangle-exclamation me-1"></i> Melewati Batas ${Math.abs(t.days_left)} Hari (${t.deadline})</span>`;

        html += `
            <div class="card card-custom p-4 ${statusCardBorder}">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-3">
                    <div>
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                            ${badgeStatus}
                            <span class="badge bg-light text-navy border">${t.category}</span>
                            ${deadlineInfo}
                        </div>
                        <h5 class="fw-bold text-navy mb-1">${escapeHtml(t.title)}</h5>
                        <div class="text-muted small">
                            <i class="fa-solid fa-calendar-check me-1"></i> Diambil pada: ${t.assigned_at}
                        </div>
                    </div>
                    <div class="text-md-end">
                        <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.7rem;">Nominal Fee</small>
                        <h4 class="fw-bold text-success mb-0">${formatRupiah(t.reward_amount)}</h4>
                    </div>
                </div>

                <div class="p-3 bg-light rounded-3 mb-3">
                    <h6 class="fw-bold text-navy small mb-1"><i class="fa-solid fa-circle-info text-gold me-1"></i> Deskripsi Tugas:</h6>
                    <p class="mb-2 small text-muted" style="white-space: pre-line;">${escapeHtml(t.description)}</p>
                    ${t.requirements ? `
                        <h6 class="fw-bold text-navy small mb-1 mt-2"><i class="fa-solid fa-list-ul text-gold me-1"></i> Kriteria & Syarat:</h6>
                        <p class="mb-0 small text-muted" style="white-space: pre-line;">${escapeHtml(t.requirements)}</p>
                    ` : ''}
                </div>

                <!-- Bagian Revisi Jika Status = Revision -->
                ${t.status === 'revision' && t.revision_feedback ? `
                    <div class="alert alert-danger p-3 mb-3 border-0 rounded-3">
                        <div class="d-flex align-items-start gap-2">
                            <i class="fa-solid fa-triangle-exclamation fs-5 mt-1 text-danger"></i>
                            <div>
                                <strong class="d-block mb-1">Catatan Revisi dari Admin Skillance:</strong>
                                <p class="mb-0 small" style="white-space: pre-line;">${escapeHtml(t.revision_feedback)}</p>
                            </div>
                        </div>
                    </div>
                ` : ''}

                <!-- Bagian Submission Terakhir -->
                ${t.submission_link || t.submission_file ? `
                    <div class="p-3 border rounded-3 mb-3 bg-white">
                        <small class="text-muted fw-bold d-block mb-2 text-uppercase" style="font-size: 0.72rem;">Hasil Kerja yang Sudah Diajukan:</small>
                        <div class="d-flex flex-wrap gap-3 align-items-center">
                            ${t.submission_link ? `
                                <a href="${t.submission_link}" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size: 0.8rem;">
                                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Buka Tautan Kerja
                                </a>
                            ` : ''}
                            ${t.submission_file ? `
                                <a href="../../uploads/freelance_submissions/${t.submission_file}" target="_blank" class="btn btn-sm btn-outline-secondary" style="font-size: 0.8rem;">
                                    <i class="fa-solid fa-download me-1"></i> Unduh File (${t.submission_file})
                                </a>
                            ` : ''}
                            ${t.submitted_at ? `<small class="text-muted ms-auto" style="font-size: 0.75rem;">Dikirim pada: ${t.submitted_at}</small>` : ''}
                        </div>
                        ${t.submission_notes ? `
                            <p class="mt-2 mb-0 small text-muted fst-italic">"${escapeHtml(t.submission_notes)}"</p>
                        ` : ''}
                    </div>
                ` : ''}

                <!-- Action Button Row -->
                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                    <small class="text-muted" style="font-size: 0.75rem;">
                        Target: <span class="badge bg-light text-dark border text-capitalize">${t.target_audience}</span>
                    </small>
                    <div>
                        ${actionBtn}
                    </div>
                </div>
            </div>
        `;
    });
    html += '</div>';
    container.innerHTML = html;
}

function openSubmitModal(assignmentId, title, isUpdate) {
    document.getElementById('submitAssignmentId').value = assignmentId;
    document.getElementById('submitTaskTitle').value = title;
    document.getElementById('modalSubmitTitle').innerHTML = isUpdate ? 
        '<i class="fa-solid fa-pen-to-square text-gold me-2"></i> Perbarui Pengajuan Kerja' :
        '<i class="fa-solid fa-cloud-arrow-up text-gold me-2"></i> Kirim Hasil Pengerjaan';
    document.getElementById('submitLink').value = '';
    document.getElementById('submitFile').value = '';
    document.getElementById('submitNotes').value = '';
    new bootstrap.Modal(document.getElementById('modalSubmitTask')).show();
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
