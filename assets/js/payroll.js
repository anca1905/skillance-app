document.addEventListener("DOMContentLoaded", function () {
    loadPayrolls();

    // Handle role change to show/hide complexity for designer
    document.getElementById('pRole').addEventListener('change', function () {
        const complexityContainer = document.getElementById('complexityContainer');
        if (this.value === 'Designer') {
            complexityContainer.classList.remove('d-none');
        } else {
            complexityContainer.classList.add('d-none');
        }
        calculateEstimasi();
    });

    // Handle qty and complexity change for estimation
    document.getElementById('pQty').addEventListener('input', calculateEstimasi);
    document.getElementById('pComplexity').addEventListener('change', calculateEstimasi);

    // Handle form submit
    document.getElementById('payrollForm').addEventListener('submit', function (e) {
        e.preventDefault();
        savePayroll();
    });
});

function calculateEstimasi() {
    const role = document.getElementById('pRole').value;
    const complexity = document.getElementById('pComplexity').value;
    const qty = parseInt(document.getElementById('pQty').value) || 0;
    
    let rate = 0;
    if (role === 'Programmer') {
        rate = 500000;
    } else if (role === 'Designer') {
        rate = (complexity === 'Complex') ? 25000 : 15000;
    }
    
    const total = rate * qty;
    document.getElementById('pTotalEstimasi').innerText = formatRp(total);
}

function formatRp(num) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num || 0);
}

function loadPayrolls() {
    fetch('../../api/payroll.php')
        .then(response => response.json())
        .then(res => {
            if (res.status === 'success') {
                const container = document.getElementById('payrollList');
                container.innerHTML = '';
                
                let totalPending = 0;
                let totalPaid = 0;

                res.data.forEach(item => {
                    let totalAmt = parseFloat(item.total_amount);
                    if (item.status === 'Pending') totalPending += totalAmt;
                    if (item.status === 'Dibayar') totalPaid += totalAmt;
                    
                    let roleBadge = item.role_type === 'Programmer' ? 'role-badge programmer' : 'role-badge designer';
                    let statusBadge = item.status === 'Dibayar' ? 'bg-success' : 'bg-warning text-dark';
                    
                    let actionHtml = '';
                    if (item.status === 'Pending') {
                        actionHtml = `
                            <button class="btn btn-sm btn-outline-success me-1" onclick="markPaid(${item.id})" title="Tandai Dibayar"><i class="fa-solid fa-check"></i></button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deletePayroll(${item.id})" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                        `;
                    } else {
                        actionHtml = `<span class="text-muted small"><i class="fa-solid fa-check-double text-success"></i> Selesai</span>`;
                    }

                    const html = `
                        <tr>
                            <td class="ps-4 fw-bold text-navy">${item.user_name}</td>
                            <td><span class="badge ${roleBadge}">${item.role_type}</span></td>
                            <td>
                                <div>${item.description}</div>
                                ${item.role_type === 'Designer' ? `<small class="text-muted">Tipe: ${item.complexity}</small>` : ''}
                            </td>
                            <td>${item.qty}</td>
                            <td class="fw-bold">${formatRp(totalAmt)}</td>
                            <td>
                                <span class="badge ${statusBadge}">${item.status}</span>
                                ${item.payment_date ? `<br><small class="text-muted">${item.payment_date}</small>` : ''}
                            </td>
                            <td class="text-end pe-4">${actionHtml}</td>
                        </tr>
                    `;
                    container.insertAdjacentHTML('beforeend', html);
                });
                
                if (res.data.length === 0) {
                    container.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-muted">Belum ada data penggajian</td></tr>';
                }

                // Update totals
                document.getElementById('totalPending').innerText = formatRp(totalPending);
                document.getElementById('totalPaid').innerText = formatRp(totalPaid);

                // Populate user dropdown
                const userSelect = document.getElementById('pUser');
                if (userSelect.options.length <= 1) { // only if not populated
                    res.users.forEach(user => {
                        userSelect.insertAdjacentHTML('beforeend', `<option value="${user.id}">${user.name} (${user.role})</option>`);
                    });
                }
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Error', 'Gagal memuat data', 'error');
        });
}

function savePayroll() {
    const payload = {
        user_id: document.getElementById('pUser').value,
        role_type: document.getElementById('pRole').value,
        complexity: document.getElementById('pComplexity').value,
        description: document.getElementById('pDesc').value,
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
            const modal = bootstrap.Modal.getInstance(document.getElementById('addPayrollModal'));
            modal.hide();
            document.getElementById('payrollForm').reset();
            calculateEstimasi(); // reset estimasi to 0
            loadPayrolls();
            Swal.fire('Sukses', res.message, 'success');
        } else {
            Swal.fire('Gagal', res.message, 'error');
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire('Error', 'Terjadi kesalahan saat menyimpan', 'error');
    });
}

function markPaid(id) {
    Swal.fire({
        title: 'Tandai Dibayar?',
        text: "Gaji ini akan ditandai sebagai sudah dibayar hari ini.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Tandai!'
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
                    Swal.fire('Gagal!', data.message, 'error');
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
        text: "Data penggajian ini akan dihapus permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!'
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
                    Swal.fire('Gagal!', data.message, 'error');
                }
            })
            .catch(err => {
                console.error(err);
                Swal.fire('Error!', 'Terjadi kesalahan jaringan.', 'error');
            });
        }
    });
}
