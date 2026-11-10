document.addEventListener("DOMContentLoaded", function () {
    const today = new Date().toISOString().split('T')[0];
    if (document.getElementById('trxDate')) {
        document.getElementById('trxDate').value = today;
    }

    let currentYear = document.getElementById('selectTaxYear') ? document.getElementById('selectTaxYear').value : 2026;
    let currentUnit = document.getElementById('filterUnit') ? document.getElementById('filterUnit').value : '';

    loadFinance(currentYear, currentUnit);

    // Filter Unit Bisnis
    document.getElementById('filterUnit')?.addEventListener('change', function () {
        currentUnit = this.value;
        loadFinance(currentYear, currentUnit);
    });

    // Filter Tax Year
    document.getElementById('selectTaxYear')?.addEventListener('change', function () {
        currentYear = this.value;
        const printBtn = document.getElementById('linkPrintSpt');
        if (printBtn) {
            printBtn.href = `print_spt.php?year=${currentYear}`;
        }
        loadFinance(currentYear, currentUnit);
    });

    // Form Submit Transaksi Baru
    const form = document.getElementById('trxForm');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const btn = document.getElementById('btnSaveTrx');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Menyimpan...';
            btn.disabled = true;

            const type = document.getElementById('typeIn').checked ? 'income' : 'expense';
            const amount = document.getElementById('trxAmount').value;
            const desc = document.getElementById('trxDesc').value;
            const date = document.getElementById('trxDate').value;
            const unit = document.getElementById('trxUnit').value;
            const category = document.getElementById('trxCategory').value;

            const payload = {
                type: type,
                amount: amount,
                description: desc,
                date: date,
                unit_bisnis: unit,
                category: category
            };

            fetch('../../api/finance.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            })
                .then(response => response.json())
                .then(res => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;

                    if (res.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Tersimpan!',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        const modalEl = document.getElementById('addTrxModal');
                        const modalInstance = bootstrap.Modal.getInstance(modalEl);
                        if (modalInstance) modalInstance.hide();
                        
                        form.reset();
                        if (document.getElementById('trxDate')) {
                            document.getElementById('trxDate').value = today;
                        }
                        loadFinance(currentYear, currentUnit);
                    } else {
                        Swal.fire('Gagal', res.message, 'error');
                    }
                })
                .catch(err => {
                    btn.innerHTML = originalText;
                    btn.disabled = false;
                    Swal.fire('Error', 'Terjadi kesalahan sistem/jaringan', 'error');
                    console.error(err);
                });
        });
    }

    // Delete Transaksi
    window.deleteTrx = function (id, desc) {
        Swal.fire({
            title: 'Hapus Transaksi?',
            text: `Yakin ingin menghapus catatan: "${desc}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('../../api/finance.php', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ id: id })
                })
                    .then(r => r.json())
                    .then(res => {
                        if (res.status === 'success') {
                            Swal.fire({ icon: 'success', title: 'Terhapus', text: res.message, timer: 1200, showConfirmButton: false });
                            loadFinance(currentYear, currentUnit);
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire('Error', 'Gagal menghubungi server.', 'error');
                    });
            }
        });
    };
});

function loadFinance(year = 2026, unit = '') {
    const url = `../../api/finance.php?year=${year}&unit=${encodeURIComponent(unit)}`;
    const fmt = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.status !== 'success') return;

            // 1. Render Top Stats
            if (document.getElementById('statBalance')) {
                document.getElementById('statBalance').innerText = fmt.format(data.stats.balance);
            }
            if (document.getElementById('statIncome')) {
                document.getElementById('statIncome').innerText = "+ " + fmt.format(data.stats.income);
            }
            if (document.getElementById('statExpense')) {
                document.getElementById('statExpense').innerText = "- " + fmt.format(data.stats.expense);
            }
            if (document.getElementById('statPph') && data.spt_summary) {
                document.getElementById('statPph').innerText = fmt.format(data.spt_summary.yearly_pph_final);
            }
            if (document.getElementById('archiveCountBadge') && data.stats && data.stats.archive_count !== undefined) {
                document.getElementById('archiveCountBadge').innerText = data.stats.archive_count;
            }

            // 2. Render Transactions Table
            const container = document.getElementById('trxList');
            if (container) {
                container.innerHTML = '';
                if (!data.transactions || data.transactions.length === 0) {
                    container.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-muted">Belum ada transaksi pada unit usaha ini.</td></tr>';
                } else {
                    data.transactions.forEach(trx => {
                        const isIncome = trx.type === 'income';
                        const typeBadge = isIncome
                            ? '<span class="badge bg-success-subtle text-success border border-success border-opacity-25 px-2 py-1"><i class="fa-solid fa-arrow-down me-1"></i> Masuk</span>'
                            : '<span class="badge bg-danger-subtle text-danger border border-danger border-opacity-25 px-2 py-1"><i class="fa-solid fa-arrow-up me-1"></i> Keluar</span>';

                        const textClass = isIncome ? 'text-success' : 'text-danger';
                        const sign = isIncome ? '+' : '-';

                        // Unit Badge colors
                        let unitBadgeClass = 'bg-secondary';
                        if (trx.unit_bisnis === 'Software House') unitBadgeClass = 'bg-primary';
                        else if (trx.unit_bisnis === 'Bursa Freelance') unitBadgeClass = 'bg-info text-dark';
                        else if (trx.unit_bisnis === 'Skillance Academy') unitBadgeClass = 'bg-success';
                        else if (trx.unit_bisnis === 'Aquirist Print') unitBadgeClass = 'bg-warning text-dark';
                        else if (trx.unit_bisnis === 'Penyewaan Akrilik') unitBadgeClass = 'bg-dark';
                        else if (trx.unit_bisnis === 'Media Pemberitaan') unitBadgeClass = 'bg-danger';

                        const html = `
                            <tr>
                                <td class="ps-3"><small class="text-muted font-monospace">${trx.date}</small></td>
                                <td>
                                    <span class="fw-bold text-navy d-block">${escapeHtml(trx.desc)}</span>
                                </td>
                                <td>
                                    <span class="badge ${unitBadgeClass} px-2 py-1" style="font-size: 0.72rem;">${trx.unit_bisnis}</span>
                                </td>
                                <td><span class="badge bg-light text-dark border">${trx.category}</span></td>
                                <td>${typeBadge}</td>
                                <td class="text-end fw-bold ${textClass}">
                                    ${sign} ${fmt.format(trx.amount)}
                                </td>
                                <td class="text-center pe-3">
                                    <button class="btn btn-sm btn-outline-danger py-0 px-2" title="Hapus Catatan" onclick="deleteTrx(${trx.id}, '${escapeHtml(trx.desc).replace(/'/g, "\\'")}')">
                                        <i class="fa-solid fa-trash-can" style="font-size: 0.75rem;"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        container.insertAdjacentHTML('beforeend', html);
                    });
                }
            }

            // 3. Render SPT 12-Month Table
            const sptBody = document.getElementById('sptTableBody');
            if (sptBody && data.spt_summary) {
                sptBody.innerHTML = '';
                const s = data.spt_summary;

                s.monthly.forEach((m, idx) => {
                    const hasOmzet = m.income > 0;
                    const statusBadge = hasOmzet 
                        ? '<span class="badge bg-warning text-dark px-2 py-1"><i class="fa-solid fa-clock me-1"></i> PP 55 Terutang</span>'
                        : '<span class="badge bg-light text-muted border px-2 py-1">Nihil</span>';

                    sptBody.innerHTML += `
                        <tr>
                            <td class="text-center">${idx + 1}</td>
                            <td class="fw-bold text-navy">${m.month_name}</td>
                            <td class="text-end text-success fw-bold">${fmt.format(m.income)}</td>
                            <td class="text-center text-muted">0,5%</td>
                            <td class="text-end text-warning-emphasis fw-bold">${fmt.format(m.pph_final)}</td>
                            <td class="text-end text-danger">${fmt.format(m.expense)}</td>
                            <td class="text-end fw-bold ${m.net_profit >= 0 ? 'text-primary' : 'text-danger'}">${fmt.format(m.net_profit)}</td>
                            <td class="text-center">${statusBadge}</td>
                        </tr>
                    `;
                });

                document.getElementById('sptTotalOmzet').innerText = fmt.format(s.yearly_income);
                document.getElementById('sptTotalPph').innerText = fmt.format(s.yearly_pph_final);
                document.getElementById('sptTotalBiaya').innerText = fmt.format(s.yearly_expense);
                document.getElementById('sptTotalLaba').innerText = fmt.format(s.yearly_net_profit);
            }

            // 4. Render Business Units Grid (Tab 3)
            const unitsGrid = document.getElementById('unitsGrid');
            if (unitsGrid && data.business_units) {
                unitsGrid.innerHTML = '';
                
                const unitIcons = {
                    'Software House': 'fa-laptop-code text-primary',
                    'Bursa Freelance': 'fa-handshake text-info',
                    'Skillance Academy': 'fa-graduation-cap text-success',
                    'Aquirist Print': 'fa-print text-warning',
                    'Penyewaan Akrilik': 'fa-shapes text-dark',
                    'Media Pemberitaan': 'fa-newspaper text-danger',
                    'Operasional Kantor': 'fa-building text-secondary'
                };

                data.business_units.forEach(u => {
                    const iconClass = unitIcons[u.unit] || 'fa-briefcase text-navy';
                    const netColor = u.net >= 0 ? 'text-success' : 'text-danger';

                    unitsGrid.innerHTML += `
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm unit-card border-0">
                                <div class="card-body p-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-solid ${iconClass} fs-5"></i>
                                            <h6 class="fw-bold mb-0 text-navy">${u.unit}</h6>
                                        </div>
                                        <span class="badge bg-light text-muted border">${u.count} Transaksi</span>
                                    </div>
                                    <div class="bg-light p-2.5 rounded-3 mb-2" style="font-size: 0.8rem;">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="text-muted">Pemasukan:</span>
                                            <strong class="text-success">${fmt.format(u.income)}</strong>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1">
                                            <span class="text-muted">Pengeluaran:</span>
                                            <strong class="text-danger">${fmt.format(u.expense)}</strong>
                                        </div>
                                        <div class="d-flex justify-content-between pt-1 border-top">
                                            <span class="fw-bold text-navy">Laba Bersih:</span>
                                            <strong class="${netColor}">${fmt.format(u.net)}</strong>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-navy btn-sm w-100" style="font-size: 0.75rem;" onclick="filterByUnit('${u.unit}')">
                                        <i class="fa-solid fa-filter me-1"></i> Lihat Transaksi Unit
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }
        })
        .catch(err => {
            console.error('Error fetching finance:', err);
        });
}

function filterByUnit(unitName) {
    const sel = document.getElementById('filterUnit');
    if (sel) {
        sel.value = unitName;
        // Switch to tab 1
        const tabBtn = document.getElementById('tab-trx-btn');
        if (tabBtn) {
            bootstrap.Tab.getOrCreateInstance(tabBtn).show();
        }
        loadFinance(document.getElementById('selectTaxYear')?.value || 2026, unitName);
    }
}

function escapeHtml(text) {
    if (!text) return '';
    return String(text)
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

let cachedArchiveList = [];

window.loadArchiveData = function () {
    const tbody = document.getElementById('archiveTableBody');
    if (!tbody) return;
    
    tbody.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-muted"><i class="fa-solid fa-spinner fa-spin me-2"></i>Memuat arsip 42 catatan proyek pra-PT...</td></tr>`;

    fetch('../../api/finance.php?archive=1')
        .then(r => r.json())
        .then(data => {
            if (data.status === 'success' && data.transactions) {
                cachedArchiveList = data.transactions;
                renderArchiveRows(cachedArchiveList);

                if (document.getElementById('archiveTotalIncome') && data.stats) {
                    const fmt = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });
                    document.getElementById('archiveTotalIncome').innerText = fmt.format(data.stats.income);
                }
            } else {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center py-3 text-muted">Tidak ada data arsip ditemukan.</td></tr>`;
            }
        })
        .catch(err => {
            console.error('Error fetching archive:', err);
            tbody.innerHTML = `<tr><td colspan="5" class="text-center py-3 text-danger">Gagal memuat arsip transaksi.</td></tr>`;
        });
};

function renderArchiveRows(list) {
    const tbody = document.getElementById('archiveTableBody');
    if (!tbody) return;
    tbody.innerHTML = '';

    if (list.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5" class="text-center py-3 text-muted">Tidak ada data yang cocok dengan pencarian.</td></tr>`;
        return;
    }

    const fmt = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 });

    list.forEach(trx => {
        const isInc = trx.type === 'income';
        const typeBadge = isInc 
            ? '<span class="badge bg-success-subtle text-success border border-success-subtle">Masuk</span>' 
            : '<span class="badge bg-danger-subtle text-danger border border-danger-subtle">Keluar</span>';
        const amtClass = isInc ? 'text-success' : 'text-danger';
        const sign = isInc ? '+' : '-';

        tbody.innerHTML += `
            <tr>
                <td class="ps-3 text-muted font-monospace">${trx.date}</td>
                <td>
                    <span class="fw-semibold text-navy d-block">${escapeHtml(trx.desc)}</span>
                </td>
                <td><span class="badge bg-light text-dark border">${escapeHtml(trx.category)}</span></td>
                <td>${typeBadge}</td>
                <td class="text-end pe-3 fw-bold ${amtClass}">${sign} ${fmt.format(trx.amount)}</td>
            </tr>
        `;
    });
}

// Live search in archive
document.addEventListener('input', function (e) {
    if (e.target && e.target.id === 'searchArchiveInput') {
        const q = e.target.value.toLowerCase().trim();
        const filtered = cachedArchiveList.filter(t => 
            (t.desc && t.desc.toLowerCase().includes(q)) ||
            (t.category && t.category.toLowerCase().includes(q)) ||
            (t.date && t.date.includes(q))
        );
        renderArchiveRows(filtered);
    }
});
