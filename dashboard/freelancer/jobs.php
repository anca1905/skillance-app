<?php
$pageTitle = "Bursa Lowongan Freelance";
require_once __DIR__ . '/includes/header.php';
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold text-navy mb-1"><i class="fa-solid fa-briefcase text-gold me-2"></i> Bursa Lowongan & Proyek Freelance</h4>
        <p class="text-muted small mb-0">Temukan tugas dan proyek yang sesuai dengan keahlian Anda, kerjakan fleksibel, dan dapatkan fee.</p>
    </div>
    <a href="my_tasks.php" class="btn btn-outline-primary btn-sm px-3 py-2 fw-bold">
        <i class="fa-solid fa-list-check me-1"></i> Lihat Tugas yang Sedang Dikerjakan
    </a>
</div>

<!-- Search & Filters -->
<div class="card card-custom p-3 mb-4">
    <div class="row g-2 g-md-3 align-items-center">
        <div class="col-12 col-md-5">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Cari judul pekerjaan, skill, atau kata kunci...">
            </div>
        </div>
        <div class="col-6 col-md-3">
            <select id="categoryFilter" class="form-select">
                <option value="">Semua Kategori</option>
                <option value="Web & Pemrograman">Web & Pemrograman</option>
                <option value="Desain & UI/UX">Desain & UI/UX</option>
                <option value="Penulisan & Konten">Penulisan & Konten</option>
                <option value="Digital Marketing">Digital Marketing</option>
                <option value="Data & Administrasi">Data & Administrasi</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="col-6 col-md-3">
            <select id="targetFilter" class="form-select">
                <option value="">Semua Target Audiens</option>
                <option value="mahasiswa">Khusus Mahasiswa</option>
                <option value="umum">Khusus Umum</option>
                <option value="semua">Semua (Mahasiswa & Umum)</option>
            </select>
        </div>
        <div class="col-12 col-md-1">
            <button class="btn btn-navy w-100 fw-bold d-flex align-items-center justify-content-center gap-1 py-2" onclick="loadJobs()" title="Filter Lowongan">
                <i class="fa-solid fa-filter"></i>
                <span class="d-md-none small">Filter</span>
            </button>
        </div>
    </div>
</div>

<!-- Jobs Grid Container -->
<div id="jobsGridContainer">
    <div class="text-center py-5 text-muted">
        <i class="fa-solid fa-circle-notch fa-spin fs-3 mb-3 text-gold"></i>
        <p class="mb-0">Memuat lowongan freelance...</p>
    </div>
</div>

<!-- Modal Detail & Ambil Pekerjaan -->
<div class="modal fade" id="modalJobDetail" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content card-custom">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold text-navy" id="modalJobTitle">Detail Pekerjaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="rounded-3 overflow-hidden mb-3 border shadow-sm" style="max-height: 220px;">
                    <img id="modalJobBanner" src="" alt="Banner Lowongan" class="w-100 h-100 object-fit-cover" style="max-height: 220px; object-fit: cover;">
                </div>
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <span class="badge bg-light text-navy border" id="modalJobCategory">Kategori</span>
                    <span class="badge bg-primary text-capitalize" id="modalJobTarget">Target</span>
                    <span class="badge bg-light text-muted border" id="modalJobDeadline">Deadline</span>
                </div>

                <div class="d-flex justify-content-between align-items-center p-3 rounded-3 mb-3 bg-light">
                    <div>
                        <small class="text-muted fw-bold text-uppercase d-block" style="font-size: 0.72rem;">Imbalan / Fee Pekerjaan</small>
                        <h3 class="fw-bold text-success mb-0" id="modalJobReward">Rp 0</h3>
                    </div>
                    <div class="text-end">
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Metode Pencairan:</small>
                        <span class="badge bg-success-subtle text-success fw-bold"><i class="fa-solid fa-money-bill-transfer me-1"></i> Transfer Manual Admin</span>
                    </div>
                </div>

                <div class="mb-3">
                    <h6 class="fw-bold text-navy mb-1"><i class="fa-solid fa-align-left text-gold me-2"></i> Deskripsi Pekerjaan:</h6>
                    <p class="text-muted small" id="modalJobDescription" style="white-space: pre-line; line-height: 1.8;"></p>
                </div>

                <div class="mb-3" id="modalJobReqsWrapper">
                    <h6 class="fw-bold text-navy mb-1"><i class="fa-solid fa-list-check text-gold me-2"></i> Kriteria & Syarat Pengerjaan:</h6>
                    <p class="text-muted small" id="modalJobRequirements" style="white-space: pre-line; line-height: 1.8;"></p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-navy small">Catatan Singkat / Portofolio (Opsional)</label>
                    <textarea id="applicationNotes" class="form-control" rows="2" placeholder="Tuliskan pengalaman atau portofolio singkat jika ada..."></textarea>
                </div>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-gold fw-bold px-4" id="btnConfirmApply">
                    <i class="fa-solid fa-handshake me-1"></i> Ambil Pekerjaan Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentJobs = [];
let selectedJobId = null;

document.addEventListener('DOMContentLoaded', function() {
    loadJobs();

    // Search enter key listener
    document.getElementById('searchInput').addEventListener('keyup', function(e) {
        if (e.key === 'Enter') loadJobs();
    });

    document.getElementById('categoryFilter').addEventListener('change', loadJobs);
    document.getElementById('targetFilter').addEventListener('change', loadJobs);

    // Apply button confirm
    document.getElementById('btnConfirmApply').addEventListener('click', function() {
        if (!selectedJobId) return;

        const btn = this;
        const origText = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Memproses...';
        btn.disabled = true;

        const notes = document.getElementById('applicationNotes').value;
        const formData = new FormData();
        formData.append('action', 'apply_job');
        formData.append('job_id', selectedJobId);
        formData.append('application_notes', notes);

        fetch('../../api/freelance_api.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                const modal = bootstrap.Modal.getInstance(document.getElementById('modalJobDetail'));
                if (modal) modal.hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Pekerjaan Berhasil Diambil!',
                    text: data.message,
                    confirmButtonText: 'Buka Pekerjaan Saya',
                    confirmButtonColor: '#0d2e5c'
                }).then(() => {
                    window.location.href = 'my_tasks.php';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Mengambil',
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

function loadJobs() {
    const container = document.getElementById('jobsGridContainer');
    container.innerHTML = `
        <div class="text-center py-5 text-muted">
            <i class="fa-solid fa-circle-notch fa-spin fs-3 mb-3 text-gold"></i>
            <p class="mb-0">Memuat lowongan freelance...</p>
        </div>
    `;

    const search = encodeURIComponent(document.getElementById('searchInput').value);
    const category = encodeURIComponent(document.getElementById('categoryFilter').value);
    const target = encodeURIComponent(document.getElementById('targetFilter').value);

    fetch(`../../api/freelance_api.php?action=get_jobs&search=${search}&category=${category}&target=${target}`)
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            currentJobs = data.jobs;
            renderJobsGrid(data.jobs);
        } else {
            container.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(err => {
        console.error(err);
        container.innerHTML = '<div class="alert alert-danger">Gagal memuat lowongan.</div>';
    });
}

function getJobBannerUrl(img, category) {
    if (img && img.trim() !== '') {
        return `../../uploads/freelance_jobs/${img}`;
    }
    const fallbacks = {
        'Web & Pemrograman': 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=700&q=80',
        'Desain & UI/UX': 'https://images.unsplash.com/photo-1581291518655-9523c932694b?auto=format&fit=crop&w=700&q=80',
        'Penulisan & Konten': 'https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=700&q=80',
        'Digital Marketing': 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=700&q=80',
        'Data & Administrasi': 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=700&q=80',
        'Lainnya': 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=700&q=80'
    };
    return fallbacks[category] || 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=700&q=80';
}

function renderJobsGrid(jobs) {
    const container = document.getElementById('jobsGridContainer');
    if (!jobs || jobs.length === 0) {
        container.innerHTML = `
            <div class="card card-custom p-5 text-center">
                <i class="fa-solid fa-folder-open text-muted fs-1 mb-3"></i>
                <h5 class="fw-bold text-navy mb-1">Belum Ada Lowongan yang Sesuai</h5>
                <p class="text-muted small mb-0">Coba ubah kata kunci pencarian atau filter kategori Anda.</p>
            </div>
        `;
        return;
    }

    let html = '<div class="row g-4">';
    jobs.forEach(j => {
        let isApplied = j.has_applied > 0;
        let actionBtn = isApplied ?
            `<a href="my_tasks.php" class="btn btn-sm btn-secondary w-100 fw-bold"><i class="fa-solid fa-check me-1"></i> Sedang Dikerjakan (Buka)</a>` :
            `<button class="btn btn-sm btn-gold fw-bold w-100" onclick="showJobDetail(${j.id})"><i class="fa-solid fa-handshake me-1"></i> Lihat & Ambil Tugas</button>`;

        let deadlineBadge = j.days_left >= 0 ? 
            `<span class="badge bg-light text-muted border"><i class="fa-regular fa-clock me-1 text-gold"></i> ${j.days_left} hari lagi</span>` :
            `<span class="badge bg-danger text-white"><i class="fa-solid fa-triangle-exclamation me-1"></i> Lewat deadline</span>`;

        const bannerImg = getJobBannerUrl(j.image, j.category);

        html += `
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-custom h-100 d-flex flex-column justify-content-between overflow-hidden">
                    <!-- Card Cover Banner -->
                    <div class="position-relative" style="height: 140px; overflow: hidden; background: #0d2e5c;">
                        <img src="${bannerImg}" alt="${escapeHtml(j.title)}" class="w-100 h-100 object-fit-cover" loading="lazy">
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(180deg, rgba(13, 46, 92, 0.2) 0%, rgba(13, 46, 92, 0.7) 100%);"></div>
                        <div class="position-absolute top-0 start-0 p-3 d-flex justify-content-between align-items-center w-100">
                            <span class="badge bg-white text-navy shadow-sm fw-bold" style="font-size: 0.72rem;">${j.category}</span>
                            <span class="badge bg-primary text-capitalize" style="font-size: 0.7rem;">${j.target_audience}</span>
                        </div>
                    </div>

                    <div class="p-3 p-md-4 d-flex flex-column justify-content-between flex-grow-1">
                        <div>
                            <h5 class="fw-bold text-navy mb-2" style="font-size: 1.05rem;">${escapeHtml(j.title)}</h5>
                            <p class="text-muted small mb-3 text-truncate-3" style="line-height: 1.6; min-height: 54px;">
                                ${escapeHtml(j.description)}
                            </p>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between align-items-center p-2 rounded-2 bg-light mb-3">
                                <div>
                                    <small class="text-muted d-block" style="font-size: 0.68rem; font-weight: 700;">FEE PEKERJAAN</small>
                                    <span class="fw-bold text-success fs-6">${formatRupiah(j.reward_amount)}</span>
                                </div>
                                <div class="text-end">
                                    ${deadlineBadge}
                                </div>
                            </div>

                            ${actionBtn}
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
    html += '</div>';
    container.innerHTML = html;
}

function showJobDetail(jobId) {
    const job = currentJobs.find(item => item.id == jobId);
    if (!job) return;

    selectedJobId = jobId;
    const bannerEl = document.getElementById('modalJobBanner');
    if (bannerEl) bannerEl.src = getJobBannerUrl(job.image, job.category);

    document.getElementById('modalJobTitle').innerText = job.title;
    document.getElementById('modalJobCategory').innerText = job.category;
    document.getElementById('modalJobTarget').innerText = 'Target: ' + job.target_audience;
    document.getElementById('modalJobDeadline').innerText = 'Batas: ' + job.deadline + ` (${job.days_left} hari lagi)`;
    document.getElementById('modalJobReward').innerText = formatRupiah(job.reward_amount);
    document.getElementById('modalJobDescription').innerText = job.description;

    if (job.requirements && job.requirements.trim().length > 0) {
        document.getElementById('modalJobReqsWrapper').style.display = 'block';
        document.getElementById('modalJobRequirements').innerText = job.requirements;
    } else {
        document.getElementById('modalJobReqsWrapper').style.display = 'none';
    }

    document.getElementById('applicationNotes').value = '';

    new bootstrap.Modal(document.getElementById('modalJobDetail')).show();
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
