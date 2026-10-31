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

// --- FUNGSI LOAD PORTFOLIO ---
function loadPortfolio() {
    const container = document.getElementById('portfolio-list');
    if (!container) return;

    fetch('api/get_portfolio.php')
        .then(response => response.ok ? response.json() : Promise.reject(response))
        .then(res => {
            container.innerHTML = '';
            if (res.status === 'success' && res.data.length > 0) {
                const limit = parseInt(container.dataset.limit) || res.data.length;
                const itemsToRender = res.data.slice(0, limit);

                itemsToRender.forEach(item => {
                    let badgeClass = 'bg-navy-subtle text-navy';
                    if (item.platform && item.platform.toLowerCase().includes('android')) badgeClass = 'bg-success-subtle text-success';
                    else if (item.platform && item.platform.toLowerCase().includes('wordpress')) badgeClass = 'bg-info-subtle text-info';

                    const cardHtml = `
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-up">
                                <div class="bg-light" style="height: 200px; overflow: hidden;">
                                    <img src="${item.image}" alt="${item.name}" class="w-100 h-100 object-fit-cover" onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                                </div>
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge ${badgeClass}">${item.platform || 'Web App'}</span>
                                        <small class="text-muted fw-bold">${item.client_name || 'Klien'}</small>
                                    </div>
                                    <h5 class="fw-bold text-navy mb-3">${item.name}</h5>
                                    <div class="mt-auto">
                                        <a href="portfolio.html" class="text-gold fw-bold text-decoration-none small hover-navy">
                                            Lihat Selengkapnya <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
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
