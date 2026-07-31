document.addEventListener("DOMContentLoaded", function () {

    // ==========================================
    // 1. EFEK NAVBAR & SCROLLSPY (Menu Active Otomatis)
    // ==========================================
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

    window.addEventListener("scroll", function () {
        const nav = document.querySelector("nav");

        // Efek Transparan ke Solid
        if (window.scrollY > 50) {
            nav.classList.add("shadow-sm", "bg-navy");
            nav.style.backgroundColor = "rgba(13, 46, 92, 0.98)";
        } else {
            nav.classList.remove("shadow-sm");
        }

        // ScrollSpy Logika
        let current = "";
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            // Angka 150 adalah jarak offset agar pas saat discroll
            if (scrollY >= (sectionTop - 150)) {
                current = section.getAttribute("id");
            }
        });

        // Pindahkan warna kuning (active) ke menu yang sedang dilihat
        navLinks.forEach((link) => {
            link.classList.remove("active");
            if (link.getAttribute("href") === `#${current}`) {
                link.classList.add("active");
            }
        });
    });

    // ==========================================
    // 2. LOAD DATA PORTFOLIO & PRODUK
    // ==========================================
    loadPortfolio();
    loadProducts();
    loadBlogs();

    // ==========================================
    // 3. FORM KONTAK SIMULASI
    // ==========================================
    const contactForm = document.getElementById("contactForm");
    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            e.preventDefault();
            let btn = document.getElementById("btnSend");
            let originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';
            btn.disabled = true;

            setTimeout(() => {
                Swal.fire({
                    title: 'Pesan Terkirim!',
                    text: 'Terima kasih, tim kami akan segera menghubungi Anda.',
                    icon: 'success',
                    confirmButtonColor: '#0d2e5c'
                });
                contactForm.reset();
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 1500);
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
                res.data.forEach(item => {
                    let badgeClass = 'bg-navy-subtle text-navy';
                    if (item.platform.toLowerCase().includes('android')) badgeClass = 'bg-success-subtle text-success';
                    else if (item.platform.toLowerCase().includes('wordpress')) badgeClass = 'bg-info-subtle text-info';

                    const cardHtml = `
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-up">
                                <div class="bg-light" style="height: 200px; overflow: hidden;">
                                    <img src="${item.image}" alt="${item.name}" class="w-100 h-100 object-fit-cover" onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                                </div>
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge ${badgeClass}">${item.platform}</span>
                                        <small class="text-muted fw-bold">${item.client_name}</small>
                                    </div>
                                    <h5 class="fw-bold text-navy mb-3">${item.name}</h5>
                                    <div class="mt-auto">
                                        <a href="#" class="text-gold fw-bold text-decoration-none small hover-navy" data-bs-toggle="modal" data-bs-target="#modalPortfolioKlinik">
                                            Lihat Detail Laporan <i class="fa-solid fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', cardHtml);
                });
            } else {
                container.innerHTML = '<div class="col-12 text-center py-4 text-muted">Belum ada portfolio Selesai.</div>';
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

                    // Generate list fitur (li)
                    let featuresHtml = '';
                    prod.features.forEach(f => {
                        featuresHtml += `<li><i class="fa-solid fa-check text-success me-2"></i> ${f}</li>`;
                    });

                    // Rakit HTML Produk
                    const cardHtml = `
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden border-top border-4 border-${prod.color_class} p-4 hover-up">
                                <div class="d-flex align-items-start gap-4">
                                    <div class="bg-${prod.color_class}-subtle p-3 rounded-3 text-${prod.color_class}">
                                        <i class="fa-solid ${prod.icon} fa-3x"></i>
                                    </div>
                                    <div>
                                        <h4 class="fw-bold text-navy mb-1">${prod.name}</h4>
                                        <p class="text-muted small mb-3">${prod.description}</p>
                                        <ul class="list-unstyled small text-muted mb-4">
                                            ${featuresHtml}
                                        </ul>
                                        <div class="d-flex gap-2">
                                            <a href="https://wa.me/6281234567890?text=${encodeURIComponent(prod.wa_text)}" target="_blank" class="btn btn-sm btn-navy px-3 fw-bold">Tanya Harga</a>
                                            <a href="#" class="btn btn-sm btn-outline-secondary px-3" onclick="alert('Demo sedang disiapkan')">Lihat Demo</a>
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
                res.data.forEach(blog => {
                    // Perhatikan link pada tag <a> yang mengirimkan ?id=
                    const cardHtml = `
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden hover-up">
                                <img src="${blog.image}" alt="${blog.title}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <div class="card-body p-4 d-flex flex-column">
                                    <div class="mb-2">
                                        <span class="badge ${blog.badge_class} mb-2">${blog.category}</span>
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
