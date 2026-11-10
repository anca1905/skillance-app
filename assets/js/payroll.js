document.addEventListener("DOMContentLoaded", function () {
    loadPayrolls();

    const roleSelect = document.getElementById('pRole');
    const complexitySelect = document.getElementById('pComplexity');
    const complexityContainer = document.getElementById('complexityContainer');
    const rateInput = document.getElementById('pRate');
    const qtyInput = document.getElementById('pQty');

    // Handle role change to set preset rate and show/hide complexity for designer
    roleSelect.addEventListener('change', function () {
        const role = this.value;
        if (role === 'Designer') {
            complexityContainer.classList.remove('d-none');
        } else {
            complexityContainer.classList.add('d-none');
        }
        applyPresetRate();
        calculateEstimasi();
    });

    // Handle complexity change for designer
    complexitySelect.addEventListener('change', function () {
        if (roleSelect.value === 'Designer') {
            applyPresetRate();
            calculateEstimasi();
        }
    });

    // Handle manual rate and qty changes
    rateInput.addEventListener('input', calculateEstimasi);
    qtyInput.addEventListener('input', calculateEstimasi);

    // Initial calculation
    calculateEstimasi();

    // Handle form submit
    document.getElementById('payrollForm').addEventListener('submit', function (e) {
        e.preventDefault();
        savePayroll();
    });
});

function applyPresetRate() {
    const role = document.getElementById('pRole').value;
    const complexity = document.getElementById('pComplexity').value;
    const rateInput = document.getElementById('pRate');

    if (role === 'Programmer') {
        rateInput.value = 500000;
    } else if (role === 'Designer') {
        rateInput.value = (complexity === 'Complex') ? 25000 : 15000;
    } else if (role === 'Operator Toko') {
        rateInput.value = 50000;
    } else if (role === 'Instruktur') {
        rateInput.value = 200000;
    } else if (role === 'Jurnalis') {
        rateInput.value = 35000;
    } else {
        rateInput.value = 100000;
    }
}

function calculateEstimasi() {
    const rate = parseFloat(document.getElementById('pRate').value) || 0;
    const qty = parseInt(document.getElementById('pQty').value) || 0;
    const total = rate * qty;
    document.getElementById('pTotalEstimasi').innerText = formatRp(total);
}

function formatRp(num) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num || 0);
}

function getUnitBadge(unit) {
    if (!unit) unit = 'Software House';
    let style = 'background-color: #e0e7ff; color: #3730a3;';
    let icon = 'fa-laptop-code';

    if (unit.indexOf('Aquirist') !== -1) {
        style = 'background-color: #fef3c7; color: #92400e; border: 1px solid #fcd34d;';
        icon = 'fa-print';
    } else if (unit.indexOf('Academy') !== -1) {
        style = 'background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd;';
        icon = 'fa-graduation-cap';
    } else if (unit.indexOf('Media') !== -1 || unit.indexOf('Berita') !== -1) {
        style = 'background-color: #f3e8ff; color: #6b21a8; border: 1px solid #e9d5ff;';
        icon = 'fa-newspaper';
    } else if (unit.indexOf('Operasional') !== -1 || unit.indexOf('Kantor') !== -1) {
        style = 'background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;';
        icon = 'fa-building';
    }

    return `<span class="badge fw-semibold px-2 py-1" style="${style}"><i class="fa-solid ${icon} me-1"></i>${unit}</span>`;
}

function getRoleBadge(role) {
    if (role === 'Programmer') {
        return '<span class="badge bg-primary px-2 py-1"><i class="fa-solid fa-code me-1"></i>Programmer</span>';
    } else if (role === 'Designer') {
        return '<span class="badge bg-info text-dark px-2 py-1"><i class="fa-solid fa-palette me-1"></i>Desainer</span>';
    } else if (role === 'Operator Toko') {
        return '<span class="badge bg-warning text-dark px-2 py-1"><i class="fa-solid fa-store me-1"></i>Operator Toko</span>';
    } else if (role === 'Instruktur') {
        return '<span class="badge bg-success px-2 py-1"><i class="fa-solid fa-chalkboard-user me-1"></i>Instruktur</span>';
    } else if (role === 'Jurnalis') {
        return '<span class="badge text-white px-2 py-1" style="background:#7c3aed;"><i class="fa-solid fa-pen-nib me-1"></i>Jurnalis</span>';
    }
    return `<span class="badge bg-secondary px-2 py-1">${role || 'Staf'}</span>`;
}

function loadPayrolls() {
    fetch('../../api/payroll.php')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: Silakan refresh atau periksa hak akses.`);
            }
            return response.json();
        })
        .then(res => {
            if (res.status === 'success') {
                const container = document.getElementById('payrollList');
                container.innerHTML = '';
                
                let totalPending = 0;
                let totalPaid = 0;

                res.data.forEach(item => {
                    let totalAmt = parseFloat(item.total_amount);
                    let rateAmt = parseFloat(item.rate);
                    if (item.status === 'Pending') totalPending += totalAmt;
                    if (item.status === 'Dibayar') totalPaid += totalAmt;
                    
                    let unitHtml = getUnitBadge(item.unit_bisnis);
                    let roleHtml = getRoleBadge(item.role_type);
                    let statusBadge = item.status === 'Dibayar' 
                        ? '<span class="badge bg-success px-2 py-1"><i class="fa-solid fa-check me-1"></i>Dibayar</span>' 
                        : '<span class="badge bg-warning text-dark px-2 py-1"><i class="fa-solid fa-clock me-1"></i>Pending</span>';
                    
                    let actionHtml = '';
                    if (item.status === 'Pending') {
                        actionHtml = `
                            <button class="btn btn-sm btn-success me-1 py-1 px-2 fw-semibold" onclick="markPaid(${item.id})" title="Tandai Sudah Ditransfer">
                                <i class="fa-solid fa-check me-1"></i>Bayar
                            </button>
                            <button class="btn btn-sm btn-outline-danger py-1 px-2" onclick="deletePayroll(${item.id})" title="Hapus Catatan">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        `;
                    } else {
                        actionHtml = `
                            <span class="text-success small fw-semibold">
                                <i class="fa-solid fa-circle-check me-1"></i>Masuk Kas PT
                            </span>
                        `;
                    }

                    const html = `
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-navy">${item.user_name}</div>
                                <small class="text-muted" style="font-size: 0.72rem;">User ID #${item.user_id}</small>
                            </td>
                            <td>${unitHtml}</td>
                            <td>${roleHtml}</td>
                            <td>
                                <div class="fw-semibold text-dark">${item.description}</div>
                                ${item.role_type === 'Designer' ? `<small class="text-muted" style="font-size: 0.72rem;">Tingkat: ${item.complexity}</small>` : ''}
                            </td>
                            <td>
                                <span class="small text-muted">${item.qty} × ${formatRp(rateAmt)}</span>
                            </td>
                            <td class="fw-bold text-navy">${formatRp(totalAmt)}</td>
                            <td>
                                ${statusBadge}
                                ${item.payment_date ? `<br><small class="text-muted" style="font-size: 0.72rem;">Tgl: ${item.payment_date}</small>` : ''}
                            </td>
                            <td class="text-end pe-4">${actionHtml}</td>
                        </tr>
                    `;
                    container.insertAdjacentHTML('beforeend', html);
                });
                
                if (res.data.length === 0) {
                    container.innerHTML = `
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-clipboard-check fs-3 d-block mb-2 opacity-50"></i>
                                Belum ada catatan honorarium tim.<br>
                                <small class="text-muted">Gunakan tombol <strong>"Tambah Catatan Honor Tim"</strong> di atas untuk mencatat honor programmer, desainer, atau staf.</small>
                            </td>
                        </tr>
                    `;
                }

                // Update totals
                document.getElementById('totalPending').innerText = formatRp(totalPending);
                document.getElementById('totalPaid').innerText = formatRp(totalPaid);

                // Populate user dropdown
                const userSelect = document.getElementById('pUser');
                if (userSelect.options.length <= 1 && res.users) {
                    res.users.forEach(user => {
                        userSelect.insertAdjacentHTML('beforeend', `<option value="${user.id}">${user.name} (${user.role})</option>`);
                    });
                }
            } else {
                Swal.fire('Error', res.message || 'Gagal memuat data', 'error');
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Error', err.message || 'Gagal memuat data penggajian', 'error');
        });
}

function savePayroll() {
    const payload = {
        user_id: document.getElementById('pUser').value,
        unit_bisnis: document.getElementById('pUnit').value,
        role_type: document.getElementById('pRole').value,
        complexity: document.getElementById('pComplexity').value,
        description: document.getElementById('pDesc').value,
        rate: document.getElementById('pRate').value,
        qty: document.getElementById('pQty').value
    };

    fetch('../../api/payroll.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(res => {
        if (res.status === 'success') {
            const modalEl = document.getElementById('addPayrollModal');
            const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
            modal.hide();
            document.getElementById('payrollForm').reset();
            applyPresetRate();
            calculateEstimasi();
            loadPayrolls();
            Swal.fire('Sukses', res.message, 'success');
        } else {
            Swal.fire('Gagal', res.message || 'Gagal menyimpan catatan.', 'error');
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire('Error', 'Terjadi kesalahan saat menyimpan catatan honor.', 'error');
    });
}

function markPaid(id) {
    Swal.fire({
        title: 'Tandai Dibayar?',
        text: "Honor ini akan ditandai lunas dan otomatis dipotong/dicatat sebagai pengeluaran di Buku Kas PT Skillance.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fa-solid fa-check me-1"></i> Ya, Tandai Dibayar!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch('../../api/payroll.php', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id, mark_paid: true })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire('Sukses!', data.message, 'success');
                    loadPayrolls();
                } else {
                    Swal.fire('Gagal!', data.message || 'Gagal memproses pembayaran.', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
            });
        }
    });
}

function deletePayroll(id) {
    Swal.fire({
        title: 'Hapus Catatan?',
        text: "Data penggajian ini akan dihapus secara permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`../../api/payroll.php?id=${id}`, {
                method: 'DELETE'
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire('Terhapus!', data.message, 'success');
                    loadPayrolls();
                } else {
                    Swal.fire('Gagal!', data.message || 'Gagal menghapus data.', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
            });
        }
    });
}
