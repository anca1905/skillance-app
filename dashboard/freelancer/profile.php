<?php
$pageTitle = "Profil & Pengaturan Freelancer";
require_once __DIR__ . '/includes/header.php';

$isWelcome = isset($_GET['welcome']) || isset($_GET['first_login']);
?>

<?php if ($isWelcome): ?>
    <div class="alert alert-success alert-dismissible fade show card-custom border-start border-4 border-success mb-4" role="alert">
        <div class="d-flex align-items-center gap-3">
            <i class="fa-solid fa-circle-check fs-2 text-success"></i>
            <div>
                <h5 class="fw-bold mb-1">Selamat Datang di Skillance Freelance! 🎉</h5>
                <p class="mb-0 small text-muted">Akun Google Anda berhasil terhubung. Silakan lengkapi informasi profil Anda (tipe mahasiswa/umum, keahlian, dan rekening pencairan fee) di bawah ini.</p>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    </div>
<?php endif; ?>

<div class="row g-4">
    <!-- Profil Card Kiri -->
    <div class="col-lg-4">
        <div class="card card-custom p-4 text-center">
            <div class="position-relative d-inline-block mx-auto mb-3">
                <img src="<?= htmlspecialchars($avatarUrl) ?>" alt="Avatar" class="rounded-circle border border-3 border-white shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                <span class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-2" title="Aktif"></span>
            </div>
            <h5 class="fw-bold text-navy mb-1"><?= htmlspecialchars($userName) ?></h5>
            <small class="text-muted d-block mb-2"><?= htmlspecialchars($userEmail) ?></small>

            <div class="mb-3">
                <?php if ($userType === 'mahasiswa'): ?>
                    <span class="badge-type badge-mhs"><i class="fa-solid fa-graduation-cap me-1"></i> Mahasiswa</span>
                <?php else: ?>
                    <span class="badge-type badge-umum"><i class="fa-solid fa-user me-1"></i> Freelancer Umum</span>
                <?php endif; ?>
            </div>

            <hr class="my-3">

            <div class="text-start small text-muted">
                <div class="mb-2">
                    <strong class="text-navy d-block">Kampus / Instansi:</strong>
                    <span><?= htmlspecialchars($currentUser['institution'] ?? 'Belum diisi') ?></span>
                </div>
                <?php if (!empty($currentUser['major'])): ?>
                    <div class="mb-2">
                        <strong class="text-navy d-block">Jurusan / Program Studi:</strong>
                        <span><?= htmlspecialchars($currentUser['major']) ?></span>
                    </div>
                <?php endif; ?>
                <?php if (!empty($currentUser['nim'])): ?>
                    <div class="mb-2">
                        <strong class="text-navy d-block">NIM:</strong>
                        <span><?= htmlspecialchars($currentUser['nim']) ?></span>
                    </div>
                <?php endif; ?>
                <div class="mb-2">
                    <strong class="text-navy d-block">No. WhatsApp:</strong>
                    <span><?= htmlspecialchars($currentUser['phone'] ?? 'Belum diisi') ?></span>
                </div>
                <div class="mb-2">
                    <strong class="text-navy d-block">Rekening Pencairan:</strong>
                    <span><?= !empty($currentUser['bank_account_number']) ? htmlspecialchars($currentUser['bank_name'] . ' - ' . $currentUser['bank_account_number'] . ' (a.n. ' . $currentUser['bank_account_name'] . ')') : '<span class="text-danger">Belum diatur</span>' ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Edit Profil Kanan -->
    <div class="col-lg-8">
        <div class="card card-custom p-4">
            <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-user-pen text-gold me-2"></i> Perbarui Data Profil & Rekening</h5>

            <form id="formProfile">
                <input type="hidden" name="action" value="update_profile">

                <!-- Pilihan Tipe Freelancer -->
                <div class="mb-4">
                    <label class="form-label fw-bold text-navy small">Kategori Anda</label>
                    <div class="row g-2">
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="user_type" id="typeMhs" value="mahasiswa" <?= $userType === 'mahasiswa' ? 'checked' : '' ?> onchange="toggleMhsFields()">
                            <label class="btn btn-outline-primary w-100 py-2 fw-semibold" for="typeMhs">
                                <i class="fa-solid fa-graduation-cap me-1"></i> Mahasiswa Aktif
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="user_type" id="typeUmum" value="umum" <?= $userType !== 'mahasiswa' ? 'checked' : '' ?> onchange="toggleMhsFields()">
                            <label class="btn btn-outline-secondary w-100 py-2 fw-semibold" for="typeUmum">
                                <i class="fa-solid fa-user me-1"></i> Umum / Profesional
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-navy small">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($currentUser['name'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold text-navy small">No. WhatsApp Aktif</label>
                        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($currentUser['phone'] ?? '') ?>" placeholder="0822...">
                    </div>
                </div>

                <!-- Bagian Mahasiswa (Conditional) -->
                <div id="mhsFieldsWrapper" style="display: <?= $userType === 'mahasiswa' ? 'block' : 'none' ?>;">
                    <div class="p-3 bg-light rounded-3 mb-3 border">
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-building-columns text-primary me-1"></i> Informasi Kampus & Kuliah</h6>
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label small text-muted fw-bold">Nama Kampus / Universitas</label>
                                <input type="text" name="institution" class="form-control" value="<?= htmlspecialchars($currentUser['institution'] ?? '') ?>" placeholder="Contoh: Universitas Halu Oleo (UHO)">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted fw-bold">Jurusan / Program Studi</label>
                                <input type="text" name="major" class="form-control" value="<?= htmlspecialchars($currentUser['major'] ?? '') ?>" placeholder="Contoh: Teknik Informatika">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-muted fw-bold">NIM (Nomor Induk Mahasiswa)</label>
                                <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($currentUser['nim'] ?? '') ?>" placeholder="F1G1...">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-navy small">Keahlian & Skill (Pisahkan dengan koma)</label>
                    <input type="text" name="skills" class="form-control" value="<?= htmlspecialchars($currentUser['skills'] ?? '') ?>" placeholder="Contoh: Web Design, Bootstrap, Figma, Penulisan SEO, Python">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-navy small">Tautan Portofolio / GitHub / LinkedIn</label>
                    <input type="url" name="portfolio_url" class="form-control" value="<?= htmlspecialchars($currentUser['portfolio_url'] ?? '') ?>" placeholder="https://github.com/... atau https://linkedin.com/in/...">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-navy small">Bio Singkat / Tentang Anda</label>
                    <textarea name="bio" class="form-control" rows="3" placeholder="Ceritakan pengalaman singkat Anda atau bidang yang paling Anda sukai..."><?= htmlspecialchars($currentUser['bio'] ?? '') ?></textarea>
                </div>

                <!-- Bagian Rekening Bank / E-Wallet -->
                <div class="p-3 rounded-3 mb-4" style="background: #fff9ed; border: 1px solid #fca311;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="fa-solid fa-credit-card text-gold fs-5"></i>
                        <h6 class="fw-bold text-navy mb-0">Rekening / E-Wallet Pencairan Fee (Transfer Manual Admin)</h6>
                    </div>
                    <small class="text-muted d-block mb-3">Admin Skillance akan mentransfer fee pekerjaan Anda langsung ke rekening / e-wallet ini.</small>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small text-muted fw-bold">Pilih Bank / E-Wallet</label>
                            <select name="bank_name" class="form-select">
                                <option value="">-- Pilih Rekening --</option>
                                <optgroup label="Bank Nasional">
                                    <option value="BCA" <?= ($currentUser['bank_name'] ?? '') === 'BCA' ? 'selected' : '' ?>>BCA</option>
                                    <option value="Mandiri" <?= ($currentUser['bank_name'] ?? '') === 'Mandiri' ? 'selected' : '' ?>>Mandiri</option>
                                    <option value="BRI" <?= ($currentUser['bank_name'] ?? '') === 'BRI' ? 'selected' : '' ?>>BRI</option>
                                    <option value="BNI" <?= ($currentUser['bank_name'] ?? '') === 'BNI' ? 'selected' : '' ?>>BNI</option>
                                    <option value="BSI" <?= ($currentUser['bank_name'] ?? '') === 'BSI' ? 'selected' : '' ?>>BSI</option>
                                    <option value="Jago" <?= ($currentUser['bank_name'] ?? '') === 'Jago' ? 'selected' : '' ?>>Bank Jago</option>
                                    <option value="Seabank" <?= ($currentUser['bank_name'] ?? '') === 'Seabank' ? 'selected' : '' ?>>Seabank</option>
                                </optgroup>
                                <optgroup label="E-Wallet">
                                    <option value="Dana" <?= ($currentUser['bank_name'] ?? '') === 'Dana' ? 'selected' : '' ?>>Dana</option>
                                    <option value="GoPay" <?= ($currentUser['bank_name'] ?? '') === 'GoPay' ? 'selected' : '' ?>>GoPay</option>
                                    <option value="OVO" <?= ($currentUser['bank_name'] ?? '') === 'OVO' ? 'selected' : '' ?>>OVO</option>
                                    <option value="ShopeePay" <?= ($currentUser['bank_name'] ?? '') === 'ShopeePay' ? 'selected' : '' ?>>ShopeePay</option>
                                </optgroup>
                                <option value="Lainnya" <?= ($currentUser['bank_name'] ?? '') === 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small text-muted fw-bold">Nomor Rekening / No. HP</label>
                            <input type="text" name="bank_account_number" class="form-control" value="<?= htmlspecialchars($currentUser['bank_account_number'] ?? '') ?>" placeholder="Contoh: 8220192837">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small text-muted fw-bold">Atas Nama Pemilik Rekening</label>
                            <input type="text" name="bank_account_name" class="form-control" value="<?= htmlspecialchars($currentUser['bank_account_name'] ?? '') ?>" placeholder="Nama sesuai tabungan">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-gold fw-bold px-4 py-2" id="btnSaveProfile">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Perubahan Profil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleMhsFields() {
    const isMhs = document.getElementById('typeMhs').checked;
    document.getElementById('mhsFieldsWrapper').style.display = isMhs ? 'block' : 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    const formProfile = document.getElementById('formProfile');
    formProfile.addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSaveProfile');
        const origText = btn.innerHTML;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Menyimpan...';
        btn.disabled = true;

        const formData = new FormData(formProfile);

        fetch('../../api/freelance_api.php', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Profil Diperbarui!',
                    text: data.message
                }).then(() => {
                    location.reload();
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
        })
        .finally(() => {
            btn.innerHTML = origText;
            btn.disabled = false;
        });
    });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
