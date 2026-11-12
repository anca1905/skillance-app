document.addEventListener("DOMContentLoaded", function () {

    // ==========================================
    // 1. EFEK NAVBAR SHADOW PADA SCROLL
    // ==========================================
    const nav = document.querySelector(".navbar");
    if (nav) {
        window.addEventListener("scroll", function () {
            if (window.scrollY > 30) {
                nav.classList.add("shadow-sm");
            } else {
                nav.classList.remove("shadow-sm");
            }
        });
    }

    // ==========================================
    // 2. LOAD DATA PORTFOLIO, PRODUK & BLOGS
    // ==========================================
    if (document.getElementById('portfolio-list')) {
        loadPortfolio();
    }
    if (document.getElementById('products-list')) {
        loadProducts();
    }
    if (document.getElementById('blog-list')) {
        loadBlogs();
    }

    // ==========================================
    // VISITOR COUNTER & GLOBAL REACH ANALYTICS
    // ==========================================
    if (document.querySelector('.visitorTotalViews')) {
        initVisitorMetrics();
    }

    // ==========================================
    // 3. FORM KONTAK SIMULASI
    // ==========================================
    const contactForm = document.getElementById("contactForm");
    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            e.preventDefault();
            let btn = document.getElementById("btnSend");
            let originalText = btn ? btn.innerHTML : 'Kirim Pesan';
            if (btn) {
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Mengirim...';
                btn.disabled = true;
            }

            setTimeout(() => {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Pesan Terkirim!',
                        text: 'Terima kasih, tim kami akan segera menghubungi Anda.',
                        icon: 'success',
                        confirmButtonColor: '#0d2e5c'
                    });
                } else {
                    alert('Terima kasih, tim kami akan segera menghubungi Anda.');
                }
                contactForm.reset();
                if (btn) {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                }
            }, 1200);
        });
    }

});

// --- FUNGSI LOAD PORTFOLIO & MODAL DETAIL INTERAKTIF ---
function loadPortfolio() {
    const container = document.getElementById('portfolio-list');
    if (!container) return;

    fetch('api/get_portfolio.php')
        .then(response => response.ok ? response.json() : Promise.reject(response))
        .then(res => {
            container.innerHTML = '';
            if (res.status === 'success' && res.data.length > 0) {
                window.portfolioItems = res.data;
                const limit = parseInt(container.dataset.limit) || res.data.length;
                const itemsToRender = res.data.slice(0, limit);

                itemsToRender.forEach((item, index) => {
                    let badgeClass = 'bg-navy-subtle text-navy';
                    if (item.platform && item.platform.toLowerCase().includes('android')) badgeClass = 'bg-success-subtle text-success';
                    else if (item.platform && item.platform.toLowerCase().includes('laravel')) badgeClass = 'bg-warning-subtle text-dark';
                    else if (item.platform && item.platform.toLowerCase().includes('wordpress')) badgeClass = 'bg-info-subtle text-info';

                    const cardHtml = `
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-up">
                                <div class="bg-light" style="height: 200px; overflow: hidden; cursor: pointer;" onclick="openPortfolioModal(${index})" title="Klik untuk lihat detail">
                                    <img src="${item.image}" alt="${item.name}" class="w-100 h-100 object-fit-cover" onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                                </div>
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge ${badgeClass}">${item.platform || 'Web App'}</span>
                                        <small class="text-muted fw-bold">${item.client_name || 'Klien'}</small>
                                    </div>
                                    <h5 class="fw-bold text-navy mb-3" style="cursor: pointer;" onclick="openPortfolioModal(${index})">${item.name}</h5>
                                    <div class="mt-auto pt-2 border-top">
                                        <button type="button" class="btn btn-link text-gold fw-bold text-decoration-none small p-0 hover-navy d-inline-flex align-items-center gap-1 shadow-none" onclick="openPortfolioModal(${index})">
                                            Lihat Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', cardHtml);
                });
            } else {
                container.innerHTML = '<div class="col-12 text-center py-4 text-muted">Belum ada portfolio selesai.</div>';
            }
        })
        .catch(err => container.innerHTML = '<div class="col-12 text-center text-danger py-4">Gagal memuat portfolio.</div>');
}

// --- FUNGSI MODAL DETAIL PORTOFOLIO ---
window.openPortfolioModal = function(index) {
    if (!window.portfolioItems || !window.portfolioItems[index]) return;
    const item = window.portfolioItems[index];

    let modalEl = document.getElementById('portfolioModal');
    if (!modalEl) {
        const modalHtml = `
            <div class="modal fade" id="portfolioModal" tabindex="-1" aria-labelledby="portfolioModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                    <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
                        <div class="modal-header bg-navy text-white py-3 px-4 d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-gold text-navy fw-bold px-2 py-1 rounded-pill small">
                                    <i class="fa-solid fa-award me-1"></i> Studi Kasus Sukses
                                </span>
                                <span class="text-white-50 small d-none d-sm-inline" id="modalProjectCategory">Web App</span>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="position-relative bg-dark" style="height: 240px; overflow: hidden;">
                                <img id="modalProjectImage" src="" alt="Cover Proyek" class="w-100 h-100 object-fit-cover" style="opacity: 0.95;">
                                <div class="position-absolute bottom-0 start-0 w-100 p-3" style="background: linear-gradient(180deg, transparent 0%, rgba(7, 26, 53, 0.95) 100%);">
                                    <span class="badge bg-primary text-white fw-semibold px-3 py-1 rounded-pill" id="modalProjectPlatform">Platform</span>
                                </div>
                            </div>
                            <div class="p-4 p-md-5">
                                <h4 class="fw-bold text-navy font-heading mb-3" id="modalProjectTitle">Nama Proyek</h4>
                                <div class="p-3 rounded-3 bg-light border mb-4">
                                    <div class="row g-2 small">
                                        <div class="col-sm-6">
                                            <span class="text-muted d-block fw-semibold" style="font-size: 0.72rem;">KLIEN / PENGEMBANG:</span>
                                            <strong class="text-navy" id="modalProjectClient">-</strong>
                                        </div>
                                        <div class="col-sm-6">
                                            <span class="text-muted d-block fw-semibold" style="font-size: 0.72rem;">INSTANSI / WILAYAH:</span>
                                            <strong class="text-navy" id="modalProjectInstitution">-</strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-layer-group text-primary me-1"></i> Teknologi & Stack yang Digunakan:</h6>
                                    <div class="d-flex flex-wrap gap-2" id="modalProjectTech"></div>
                                </div>
                                <div class="mb-4">
                                    <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-circle-info text-info me-1"></i> Ringkasan Solusi Sistem:</h6>
                                    <p class="text-secondary small mb-0" id="modalProjectDesc" style="line-height: 1.8; font-size: 0.95rem;"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check text-success me-1"></i> Fitur Utama yang Dikembangkan:</h6>
                                    <ul class="list-unstyled small text-secondary d-flex flex-column gap-2 mb-0" id="modalProjectFeatures"></ul>
                                </div>
                                <div class="card border-0 rounded-4 p-4 text-white" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #0284c7 100%);">
                                    <div class="row align-items-center g-3">
                                        <div class="col-lg-8">
                                            <h5 class="fw-bold text-white mb-1">Tertarik Membangun Sistem Serupa?</h5>
                                            <p class="text-white-50 small mb-0">Diskusikan kebutuhan spesifik, rancangan arsitektur, dan anggaran Anda bersama tim engineer Skillance.</p>
                                        </div>
                                        <div class="col-lg-4 text-lg-end">
                                            <a id="modalProjectWaBtn" href="#" target="_blank" class="btn btn-warning fw-bold text-navy px-3 py-2 rounded-pill shadow-sm w-100 w-lg-auto">
                                                <i class="fa-brands fa-whatsapp fs-5 me-1 text-success"></i> Konsultasi WA &raquo;
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light py-2 px-4 justify-content-between">
                            <small class="text-muted"><i class="fa-solid fa-shield-halved text-success me-1"></i> Garansi Purna Jual & Source Code Bersih</small>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHtml);
        modalEl = document.getElementById('portfolioModal');
    }

    document.getElementById('modalProjectCategory').innerText = item.category || item.platform || 'Studi Kasus';
    document.getElementById('modalProjectPlatform').innerText = item.platform || 'Web App';
    document.getElementById('modalProjectImage').src = item.image;
    document.getElementById('modalProjectTitle').innerText = item.name;
    document.getElementById('modalProjectClient').innerText = item.client_name || '-';
    document.getElementById('modalProjectInstitution').innerText = item.institution || '-';
    document.getElementById('modalProjectDesc').innerText = item.description || '';

    const techBox = document.getElementById('modalProjectTech');
    techBox.innerHTML = '';
    if (item.tech_stack && Array.isArray(item.tech_stack)) {
        item.tech_stack.forEach(t => {
            techBox.innerHTML += `<span class="badge bg-white text-navy border px-3 py-2 rounded-pill fw-semibold shadow-sm" style="font-size: 0.78rem;">${t}</span>`;
        });
    }

    const featBox = document.getElementById('modalProjectFeatures');
    featBox.innerHTML = '';
    if (item.features && Array.isArray(item.features)) {
        item.features.forEach(f => {
            featBox.innerHTML += `<li><i class="fa-solid fa-circle-check text-success me-2"></i> ${f}</li>`;
        });
    }

    const waText = encodeURIComponent(`Halo Tim Skillance Digital Indonesia, saya melihat studi kasus portofolio: "${item.name}" di website skillance.cloud. Saya tertarik berkonsultasi untuk pembuatan sistem serupa.`);
    document.getElementById('modalProjectWaBtn').href = `https://api.whatsapp.com/send?phone=6282291700778&text=${waText}`;

    const bsModal = bootstrap.Modal.getOrCreateInstance(modalEl);
    bsModal.show();
};

// --- FUNGSI LOAD PRODUK SIAP PAKAI ---
function loadProducts() {
    const container = document.getElementById('products-list');
    if (!container) return;

    fetch('api/get_products.php')
        .then(response => response.ok ? response.json() : Promise.reject(response))
        .then(res => {
            container.innerHTML = '';

            if (res.status === 'success' && res.data.length > 0) {
                res.data.forEach(prod => {
                    let featuresHtml = '';
                    if (prod.features && Array.isArray(prod.features)) {
                        prod.features.forEach(f => {
                            featuresHtml += `<li><i class="fa-solid fa-check text-success me-2"></i> ${f}</li>`;
                        });
                    }

                    const cardHtml = `
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden border-top border-4 border-${prod.color_class || 'primary'} p-4 hover-up">
                                <div class="d-flex align-items-start gap-4">
                                    <div class="bg-${prod.color_class || 'primary'}-subtle p-3 rounded-3 text-${prod.color_class || 'primary'}">
                                        <i class="fa-solid ${prod.icon || 'fa-box'} fa-3x"></i>
                                    </div>
                                    <div>
                                        <h4 class="fw-bold text-navy mb-1">${prod.name}</h4>
                                        <p class="text-muted small mb-3">${prod.description}</p>
                                        <ul class="list-unstyled small text-muted mb-4">
                                            ${featuresHtml}
                                        </ul>
                                        <div class="d-flex gap-2">
                                            <a href="https://wa.me/6282291700778?text=${encodeURIComponent(prod.wa_text || 'Halo Skillance')}" target="_blank" class="btn btn-sm btn-navy px-3 fw-bold">Tanya Harga</a>
                                            <a href="contact.html" class="btn btn-sm btn-outline-secondary px-3">Konsultasi</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', cardHtml);
                });
            } else {
                container.innerHTML = '<div class="col-12 text-center py-4 text-muted">Belum ada produk.</div>';
            }
        })
        .catch(err => container.innerHTML = '<div class="col-12 text-center text-danger py-4">Gagal memuat produk.</div>');
}

// --- FUNGSI LOAD BLOGS ---
function loadBlogs() {
    const container = document.getElementById('blog-list');
    if (!container) return;

    fetch('api/get_blogs.php')
        .then(response => response.json())
        .then(res => {
            container.innerHTML = '';
            if (res.status === 'success' && res.data.length > 0) {
                const limit = parseInt(container.dataset.limit) || res.data.length;
                const itemsToRender = res.data.slice(0, limit);

                itemsToRender.forEach(blog => {
                    const cardHtml = `
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-up">
                                <div style="height: 200px; overflow: hidden;" class="bg-light">
                                    <img src="${blog.image}" alt="${blog.title}" class="w-100 h-100 object-fit-cover" onerror="this.src='https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                                </div>
                                <div class="card-body p-4 d-flex flex-column bg-white">
                                    <div class="mb-2">
                                        <span class="badge ${blog.badge_class || 'bg-light text-navy border'} mb-2">${blog.category}</span>
                                        <small class="text-muted float-end"><i class="fa-regular fa-calendar me-1"></i> ${blog.date}</small>
                                    </div>
                                    <h5 class="fw-bold text-navy mb-3">${blog.title}</h5>
                                    <p class="text-muted small mb-4">${blog.excerpt}</p>
                                    
                                    <div class="mt-auto">
                                        <a href="blog-detail.html?id=${blog.id}" class="text-navy fw-bold text-decoration-none small hover-gold">
                                            Baca Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', cardHtml);
                });
            } else {
                container.innerHTML = '<div class="col-12 text-center text-muted">Belum ada artikel.</div>';
            }
        })
        .catch(err => console.error("Gagal load blog"));
}

// ==========================================
// REALTIME VISITOR METRICS FETCHER
// ==========================================
function initVisitorMetrics() {
    fetch('api/visitor_counter.php?action=hit')
        .then(res => res.json())
        .then(res => {
            if (res && res.status === 'success' && res.data) {
                const d = res.data;
                document.querySelectorAll('.visitorTotalViews').forEach(el => {
                    el.textContent = Number(d.total_visitors).toLocaleString('id-ID');
                });
                document.querySelectorAll('.visitorTodayViews').forEach(el => {
                    el.textContent = Number(d.today_visitors).toLocaleString('id-ID');
                });
                document.querySelectorAll('.visitorOnlineNow').forEach(el => {
                    el.textContent = d.online_now + ' Online';
                });

                if (d.countries && d.countries.length > 0) {
                    let html = '';
                    d.countries.forEach(c => {
                        html += `
                            <span class="badge bg-dark bg-opacity-75 text-white border border-secondary border-opacity-50 px-2 py-1 rounded-pill d-inline-flex align-items-center gap-1" style="font-size: 0.72rem;" title="${c.name}: ${Number(c.count).toLocaleString('id-ID')} views">
                                <span>${c.flag || '🌐'}</span> <span class="fw-semibold">${c.code}</span> <span class="text-gold fw-bold">${c.percent}%</span>
                            </span>
                        `;
                    });
                    document.querySelectorAll('.visitorCountryBadges').forEach(el => {
                        el.innerHTML = html;
                    });
                }
            }
        })
        .catch(() => {
            // Graceful fallback to static cached values
        });
}
