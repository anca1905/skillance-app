document.addEventListener("DOMContentLoaded", function () {

    // 1. CEK AUTH (Proteksi Tampilan JS)
    // Walaupun PHP Session sudah dijalankan, ini membantu UX
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    if (!isLoggedIn) {
        window.location.href = '../auth/index.php';
        return;
    }

    // Tampilkan Nama User
    document.getElementById('userNameDisplay').innerText = localStorage.getItem('userName') || 'User';
    
    // Tampilkan Foto Profil jika ada
    const userPhotoUrl = localStorage.getItem('userPhoto');
    if (userPhotoUrl) {
        const photoContainers = document.querySelectorAll('.bg-navy.text-white.rounded-circle');
        photoContainers.forEach(container => {
            const icon = container.querySelector('.fa-user');
            if (icon && container.style.width === '40px') {
                container.innerHTML = `<img src="${userPhotoUrl}" class="rounded-circle shadow-sm" style="width: 100%; height: 100%; object-fit: cover;" alt="Profile">`;
                container.classList.remove('bg-navy', 'text-white');
            }
        });
    }

    // 2. LOAD DATA DASHBOARD
    loadDashboardData();

    // 3. EVENT: LOGOUT
    const btnLogout = document.getElementById('btnLogout');
    if (btnLogout) {
        btnLogout.addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Keluar Sistem?',
                text: "Sesi Anda akan diakhiri.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0d2e5c',
                confirmButtonText: 'Ya, Logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('../api/logout.php')
                    .then(() => {
                        localStorage.clear();
                        window.location.href = '../auth/index.php';
                    });
                }
            });
        });
    }

    // 4. EVENT: TAMBAH AGENDA
    const agendaForm = document.getElementById('agendaForm');
    agendaForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Simulasi Kirim Data ke API (Nanti diganti fetch POST)
        // Di PHP Native, kita bisa kirim ke api/agenda_store.php

        // Tutup Modal
        const modalEl = document.getElementById('addAgendaModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();

        Swal.fire('Berhasil', 'Agenda berhasil ditambahkan (Simulasi)', 'success');

        // Refresh Data (Simulasi nambah list manual dulu)
        loadDashboardData();
        agendaForm.reset();
    });

    // 5. TOGGLE SIDEBAR MOBILE
    const toggleBtn = document.getElementById('sidebarToggle');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });
    }

    // 6. EVENT: DOWNLOAD REPORT (Chart)
    const btnDownloadReport = document.getElementById('btnDownloadReport');
    if (btnDownloadReport) {
        btnDownloadReport.addEventListener('click', function () {
            if (omzetChartInstance) {
                const link = document.createElement('a');
                link.download = 'Statistik_Performa_Mingguan.png';
                link.href = omzetChartInstance.toBase64Image();
                link.click();
            }
        });
    }
});

function loadDashboardData() {
    fetch('../api/dashboard.php')
        .then(response => response.json())
        .then(data => {
            renderStats(data);
            renderProjects(data.recent_projects);
            renderAgendas(data.agendas);
            if (data.chart_data) {
                renderChart(data.chart_data);
            }
        })
        .catch(error => console.error('Gagal ambil data:', error));
}

function renderStats(data) {
    // Format Rupiah
    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency', currency: 'IDR', minimumFractionDigits: 0
    });

    document.getElementById('totalOmzet').innerText = formatter.format(data.total_omzet);
    document.getElementById('activeProjects').innerText = data.active_projects + " Project";
}

let omzetChartInstance = null;
function renderChart(chartData) {
    const ctx = document.getElementById('omzetChart');
    if (!ctx) return;

    if (omzetChartInstance) {
        omzetChartInstance.destroy();
    }

    omzetChartInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: chartData.data_omzet,
                    borderColor: '#28a745', // Green
                    backgroundColor: 'rgba(40, 167, 69, 0.1)', // Light Green Fill
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                },
                {
                    label: 'Pengeluaran',
                    data: chartData.data_pengeluaran,
                    borderColor: '#dc3545', // Red
                    backgroundColor: 'rgba(220, 53, 69, 0.1)', // Light Red Fill
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let value = context.raw || 0;
                            return context.dataset.label + ': ' + new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function (value) {
                            if (value >= 1000000) {
                                return 'Rp ' + (value / 1000000) + 'M';
                            } else if (value >= 1000) {
                                return 'Rp ' + (value / 1000) + 'K';
                            }
                            return 'Rp ' + value;
                        }
                    }
                }
            }
        }
    });
}

function renderProjects(projects) {
    const container = document.getElementById('recentProjectsList');
    container.innerHTML = ''; // Kosongkan loader

    if (projects.length === 0) {
        container.innerHTML = '<div class="p-3 text-center text-muted">Tidak ada project terbaru.</div>';
        return;
    }

    projects.forEach(item => {
        // Logika Badge Status
        let badgeClass = 'bg-secondary';
        if (item.status === 'Development') badgeClass = 'bg-warning text-dark border';
        else if (item.status === 'On Hold') badgeClass = 'bg-info text-dark border';
        else if (item.status === 'Selesai') badgeClass = 'bg-success text-white border';

        const html = `
            <div class="list-group-item p-3">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <h6 class="mb-1 fw-bold text-navy">${item.name}</h6>
                    <small class="text-muted">${item.deadline_formatted}</small>
                </div>
                <p class="mb-1 small text-muted">Klien: ${item.client_name}</p>
                <small class="badge ${badgeClass}">${item.status}</small>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    });
}

function renderAgendas(agendas) {
    const container = document.getElementById('agendaList');
    container.innerHTML = '';

    if (agendas.length === 0) {
        container.innerHTML = `
            <div class="text-center p-4 text-muted">
                <i class="fa-solid fa-mug-hot fa-2x mb-2 text-secondary"></i>
                <p class="small mb-0">Tidak ada agenda mendesak.<br>Nikmati kopi Anda.</p>
            </div>`;
        return;
    }

    agendas.forEach(item => {
        let priorityBadge = '';
        let titleClass = 'text-navy';
        if (item.priority === 'critical') {
            priorityBadge = '<span class="badge bg-danger blink-badge">CRITICAL</span>';
            titleClass = 'text-danger';
        } else if (item.priority === 'high') {
            priorityBadge = '<span class="badge bg-warning text-dark">High</span>';
        }

        const html = `
            <div class="list-group-item p-3 border-bottom">
                <div class="d-flex w-100 justify-content-between align-items-start mb-1">
                    <div>
                        <h6 class="mb-0 fw-bold ${titleClass}">${item.title}</h6>
                        <div class="small text-muted mt-1">
                            <i class="fa-regular fa-clock me-1"></i> ${item.time}
                            <span class="badge bg-light text-dark border ms-1">${item.date_formatted}</span>
                        </div>
                        <small class="d-block text-muted mt-1">
                            <i class="fa-solid fa-location-dot me-1 text-secondary"></i> ${item.location || '-'}
                        </small>
                    </div>
                    ${priorityBadge}
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-success py-0 px-2" style="font-size: 0.75rem;" onclick="markAgendaDone(${item.id})">
                        <i class="fa-solid fa-check me-1"></i> Selesai
                    </button>
                    <button class="btn btn-sm btn-outline-secondary py-0 px-2" style="font-size: 0.75rem;" onclick="deleteAgenda(${item.id})">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
    });
}

function markAgendaDone(id) {
    fetch('../api/agenda.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'complete', id: id })
    }).then(() => loadDashboardData());
}

function deleteAgenda(id) {
    Swal.fire({
        title: 'Hapus agenda ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0d2e5c'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('../api/agenda.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'delete', id: id })
            }).then(() => loadDashboardData());
        }
    });
}