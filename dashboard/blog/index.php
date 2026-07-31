<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Artikel | S-OS Skillance</title>

    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    
    <!-- Quill Rich Text Editor CSS -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <style>
        body { background-color: #f3f4f6; overflow-x: hidden; }
        .sidebar { width: 250px; height: 100vh; position: fixed; top: 0; left: 0; background-color: var(--white); border-right: 1px solid rgba(0, 0, 0, 0.05); padding-top: 20px; z-index: 1000; transition: 0.3s; overflow-y: auto;}
        .main-content { margin-left: 250px; padding: 20px; transition: 0.3s; }
        .nav-link { color: var(--text-body); padding: 12px 20px; font-weight: 500; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: var(--navy-subtle); color: var(--navy) !important; border-right: 3px solid var(--navy); }
        .nav-link i { width: 20px; text-align: center; }
        @media (max-width: 768px) { .sidebar { margin-left: -250px; } .sidebar.active { margin-left: 0; } .main-content { margin-left: 0; } }
        .card { border: none; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.03); border-radius: 8px; }
        .cover-preview { width: 100%; height: 180px; object-fit: cover; border-radius: 8px; background-color: #eee; }
        .ql-container { height: 250px; font-family: 'Inter', sans-serif;}
    </style>
</head>

<body>

    <nav class="sidebar shadow-sm" id="sidebar">
        <div class="px-4 mb-4 d-flex align-items-center gap-2">
            <i class="fa-solid fa-code text-gold fs-4"></i>
            <div>
                <h5 class="fw-bold text-navy mb-0 ls-2">SKILLANCE</h5>
                <small class="text-muted" style="font-size: 0.65rem;">OFFICE SYSTEM</small>
            </div>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item"><a href="../index.php" class="nav-link"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
            <li class="nav-item"><a href="../project/index.php" class="nav-link"><i class="fa-solid fa-briefcase"></i> Project</a></li>
            <li class="nav-item"><a href="../finance/index.php" class="nav-link"><i class="fa-solid fa-wallet"></i> Keuangan</a></li>
            <li class="nav-item"><a href="../investment/index.php" class="nav-link"><i class="fa-solid fa-hand-holding-dollar"></i> Investasi Admin</a></li>
            <li class="nav-item"><a href="../hrd/index.php" class="nav-link"><i class="fa-solid fa-users"></i> HRD</a></li>
            <li class="nav-item"><a href="../team/index.php" class="nav-link"><i class="fa-solid fa-people-group"></i> Manajemen Tim</a></li>
            <li class="nav-item"><a href="index.php" class="nav-link active"><i class="fa-solid fa-newspaper"></i> Kelola Artikel</a></li>
            <li class="nav-item"><a href="../profile.php" class="nav-link text-warning"><i class="fa-solid fa-user-gear"></i> Profil Saya</a></li>
            <li class="nav-item mt-4"><a href="#" class="nav-link text-danger" id="btnLogout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-navy btn-sm d-md-none" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
                <div>
                    <h4 class="fw-bold text-navy mb-0">Kelola Artikel BLog</h4>
                    <small class="text-muted">Tulis dan terbitkan kisah inspiratif atau edukasi bisnis.</small>
                </div>
            </div>
            
            <div class="d-none d-md-flex align-items-center gap-3">
                <div class="text-end">
                    <small class="d-block fw-bold text-navy" id="userNameDisplay">Memuat...</small>
                    <small class="text-muted" style="font-size: 0.7rem;" id="userRoleDisplay">Administrator</small>
                </div>
                <div class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" id="headerUserPhoto">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-navy">Semua Artikel</h6>
                <button class="btn btn-navy fw-bold px-3 btn-sm" onclick="openAddModal()">
                    <i class="fa-solid fa-pen-nib me-1"></i> Tulis Artikel Baru
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="px-3 py-3" style="width: 80px;">COVER</th>
                                <th>JUDUL & KATEGORI</th>
                                <th>TANGGAL / PENULIS</th>
                                <th class="text-end px-4">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="blogTableBody">
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted"><i class="fa-solid fa-spinner fa-spin me-2"></i> Memuat artikel...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Form Blog -->
    <div class="modal fade" id="blogModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h5 class="modal-title fw-bold" id="modalTitle">Tulis Artikel Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="blogForm" enctype="multipart/form-data">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <input type="hidden" name="id" id="blogId" value="0">
                    <div class="modal-body p-4">
                        
                        <div class="row g-4">
                            <!-- Kolom Kiri: Detil SEO & Meta -->
                            <div class="col-lg-4 border-end-lg">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">GAMBAR COVER</label>
                                    <img src="" id="previewCover" class="cover-preview shadow-sm mb-2 d-none">
                                    <div class="bg-light border rounded text-center py-5 mb-2" id="placeholderCover">
                                        <i class="fa-regular fa-image fs-1 text-muted"></i>
                                    </div>
                                    <input type="file" name="image" id="imageInput" class="form-control form-control-sm" accept="image/png, image/jpeg, image/webp">
                                    <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">Resolusi disarankan: 1200x630px. Max 2MB.</small>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">KATEGORI</label>
                                    <input type="text" name="category" id="inputCategory" class="form-control" placeholder="Edukasi, Teknologi, Pengumuman" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">WARNA BADGE KATEGORI</label>
                                    <select name="badge_class" id="inputBadge" class="form-select">
                                        <option value="bg-navy-subtle text-navy">Biru Navy</option>
                                        <option value="bg-gold-subtle text-gold">Emas (Gold)</option>
                                        <option value="bg-success-subtle text-success">Hijau Sukses</option>
                                        <option value="bg-danger-subtle text-danger">Merah Peringatan</option>
                                        <option value="bg-info-subtle text-info">Biru Muda Info</option>
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">KUTIPAN (EXCERPT)</label>
                                    <textarea name="excerpt" id="inputExcerpt" class="form-control" rows="3" placeholder="Ringkasan singkat artikel untuk ditampilkan di halaman depan" required></textarea>
                                </div>
                            </div>
                            
                            <!-- Kolom Kanan: Teks Utama -->
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted lh-1 mb-1">JUDUL ARTIKEL</label>
                                    <input type="text" name="title" id="inputTitle" class="form-control form-control-lg fs-5 fw-bold" placeholder="Tuliskan judul artikel yang memikat..." required>
                                </div>
                                
                                <div class="mb-2">
                                    <label class="form-label small fw-bold text-muted mb-1">ISI ARTIKEL</label>
                                    <!-- Editor Quill Di Sini -->
                                    <div id="editor-container" class="bg-white"></div>
                                    <input type="hidden" name="content" id="inputContent">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy px-4" id="btnSave"><i class="fa-solid fa-paper-plane me-2"></i> Terbitkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Quill JS -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    
    <script>
        const API_URL = '../../api/blog_api.php';
        let modalInstance;
        let quill;

        document.addEventListener("DOMContentLoaded", function () {
            // Sidebar mobile
            document.getElementById('sidebarToggle')?.addEventListener('click', () => {
                document.getElementById('sidebar').classList.toggle('active');
            });

            // Set Header user name & photo
            document.getElementById('userNameDisplay').innerText = localStorage.getItem('userName') || 'Admin';
            const role = localStorage.getItem('userRole');
            if(role) document.getElementById('userRoleDisplay').innerText = role;
            
            const pUrl = localStorage.getItem('userPhoto');
            if (pUrl && document.getElementById('headerUserPhoto')) {
                document.getElementById('headerUserPhoto').innerHTML = `<img src="${pUrl}" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;" alt="Profile">`;
                document.getElementById('headerUserPhoto').classList.remove('bg-navy', 'text-white');
            }

            // Init Quill Editor
            quill = new Quill('#editor-container', {
                theme: 'snow',
                placeholder: 'Mulai menulis mahakarya Anda di sini...',
                modules: {
                    toolbar: [
                        [{ 'header': [2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'color': [] }, { 'background': [] }],
                        ['link', 'image', 'video'],
                        ['clean']
                    ]
                }
            });

            // Logout Event
            document.getElementById('btnLogout')?.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Keluar Sistem?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0d2e5c'
                }).then((res) => {
                    if(res.isConfirmed) {
                        fetch('../../api/logout.php').then(() => {
                            localStorage.clear();
                            window.location.href = '../../auth/index.php';
                        });
                    }
                });
            });

            // Modal Init
            modalInstance = new bootstrap.Modal(document.getElementById('blogModal'), {
                backdrop: 'static'
            });

            // Image Preview
            document.getElementById('imageInput').addEventListener('change', function(e) {
                const preview = document.getElementById('previewCover');
                const ph = document.getElementById('placeholderCover');
                if(this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(evt) {
                        preview.src = evt.target.result;
                        preview.classList.remove('d-none');
                        ph.classList.add('d-none');
                    };
                    reader.readAsDataURL(this.files[0]);
                } else {
                    preview.classList.add('d-none');
                    ph.classList.remove('d-none');
                }
            });

            // Form Submit
            document.getElementById('blogForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Pindahkan isi Quill ke Input Hidden
                document.getElementById('inputContent').value = quill.root.innerHTML;

                if (quill.getText().trim().length === 0) {
                    Swal.fire('Periksa Kembali', 'Isi artikel tidak boleh kosong!', 'warning');
                    return;
                }

                const btn = document.getElementById('btnSave');
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
                btn.disabled = true;

                const formData = new FormData(this);
                
                fetch(API_URL, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        modalInstance.hide();
                        Swal.fire('Berhasil!', data.message, 'success');
                        loadBlogs();
                    } else {
                        Swal.fire('Gagal', data.message, 'error');
                    }
                })
                .finally(() => {
                    btn.innerHTML = '<i class="fa-solid fa-paper-plane me-2"></i> Terbitkan';
                    btn.disabled = false;
                });
            });

            // Load Initial Data
            loadBlogs();
        });

        function loadBlogs() {
            const tbody = document.getElementById('blogTableBody');
            fetch(API_URL)
                .then(res => res.json())
                .then(data => {
                    tbody.innerHTML = '';
                    if (!data.data || data.data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-muted">Belum ada artikel yang ditulis.</td></tr>';
                        return;
                    }

                    data.data.forEach(blog => {
                        let coverImg = blog.image;
                        if (!coverImg) coverImg = 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&w=100&q=80';
                        else if (!coverImg.startsWith('http')) coverImg = '../../' + coverImg;

                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="px-3 py-2">
                                <img src="${coverImg}" class="rounded shadow-sm" style="width: 70px; height: 50px; object-fit: cover;">
                            </td>
                            <td>
                                <h6 class="fw-bold text-navy mb-1" style="font-size: 0.95rem;">${blog.title}</h6>
                                <span class="badge ${blog.badge_class} fw-normal" style="font-size: 0.7rem;">${blog.category}</span>
                            </td>
                            <td>
                                <small class="d-block fw-bold">${blog.date}</small>
                                <small class="text-muted"><i class="fa-solid fa-pen-nib me-1" style="font-size: 0.65rem;"></i> ${blog.author}</small>
                            </td>
                            <td class="text-end px-4">
                                <button class="btn btn-sm btn-outline-primary py-1 px-2 me-1" onclick='editBlog(${JSON.stringify(blog).replace(/'/g, "\\'")})'>
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger py-1 px-2" onclick="deleteBlog(${blog.id})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                });
        }

        window.openAddModal = function() {
            document.getElementById('formAction').value = 'add';
            document.getElementById('blogId').value = '0';
            document.getElementById('blogForm').reset();
            quill.setContents([]);
            
            document.getElementById('modalTitle').innerText = 'Tulis Artikel Baru';
            document.getElementById('btnSave').innerHTML = '<i class="fa-solid fa-paper-plane me-2"></i> Terbitkan';
            
            document.getElementById('previewCover').classList.add('d-none');
            document.getElementById('placeholderCover').classList.remove('d-none');
            
            modalInstance.show();
        };

        window.editBlog = function(blog) {
            document.getElementById('formAction').value = 'edit';
            document.getElementById('blogId').value = blog.id;
            document.getElementById('inputTitle').value = blog.title;
            document.getElementById('inputCategory').value = blog.category;
            document.getElementById('inputBadge').value = blog.badge_class;
            document.getElementById('inputExcerpt').value = blog.excerpt;
            
            quill.root.innerHTML = blog.content;
            
            document.getElementById('modalTitle').innerText = 'Edit Artikel';
            document.getElementById('btnSave').innerHTML = '<i class="fa-solid fa-save me-2"></i> Simpan Peringatan';

            if (blog.image) {
                const coverImg = blog.image.startsWith('http') ? blog.image : '../../' + blog.image;
                document.getElementById('previewCover').src = coverImg;
                document.getElementById('previewCover').classList.remove('d-none');
                document.getElementById('placeholderCover').classList.add('d-none');
            } else {
                document.getElementById('previewCover').classList.add('d-none');
                document.getElementById('placeholderCover').classList.remove('d-none');
            }
            
            modalInstance.show();
        };

        window.deleteBlog = function(id) {
            Swal.fire({
                title: 'Hapus artikel ini?',
                text: "Artikel ini tidak akan tampil lagi di halaman publik!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    const fd = new FormData();
                    fd.append('action', 'delete');
                    fd.append('id', id);
                    fetch(API_URL, { method: 'POST', body: fd })
                    .then(res => res.json())
                    .then(data => {
                        if(data.status === 'success') {
                            Swal.fire('Terhapus!', data.message, 'success');
                            loadBlogs();
                        } else {
                            Swal.fire('Gagal', data.message, 'error');
                        }
                    });
                }
            });
        };
    </script>
</body>
</html>
