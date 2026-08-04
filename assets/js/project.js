document.addEventListener("DOMContentLoaded", function () {
    loadProjects();

    document.getElementById('projectForm').addEventListener('submit', function (e) {
        e.preventDefault();

        let pName = document.getElementById('pName').value;
        let pPlatform = document.getElementById('pPlatform').value;
        let pDeadline = document.getElementById('pDeadline').value;
        let pClient = document.getElementById('pClient').value;
        let pClientContact = document.getElementById('pClientContact').value;
        let pClientInst = document.getElementById('pClientInst').value;
        let pPrice = document.getElementById('pPrice').value;
        let pDpAmount = document.getElementById('pDpAmount').value;
        let pStatus = document.getElementById('pStatus').value;
        let pPayment = document.getElementById('pPayment').value;

        let payload = {
            name: pName,
            platform: pPlatform,
            deadline: pDeadline,
            client_name: pClient,
            client_contact: pClientContact,
            client_institution: pClientInst,
            price: pPrice,
            dp_amount: pDpAmount,
            status: pStatus,
            payment: pPayment
        };

        fetch('../../api/projects.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        })
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success') {
                    Swal.fire('Sukses', res.message, 'success');
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addProjectModal'));
                    modal.hide();
                    this.reset();
                    loadProjects();
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            })
            .catch(err => {
                Swal.fire('Error', 'Terjadi kesalahan jaringan/server', 'error');
                console.error(err);
            });
    });
});

function loadProjects() {
    fetch('../../api/projects.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('projectList');
            container.innerHTML = '';

            data.forEach(item => {
                let statusBadge = item.status === 'Selesai' ? 'bg-success' : (item.status === 'Testing' ? 'bg-info' : 'bg-warning text-dark');
                let platformIcon = item.platform.includes('Android') ? 'fa-android text-success' : 'fa-globe text-primary';

                const html = `
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold d-block text-navy">${item.name}</span>
                            <small class="text-muted"><i class="fa-brands ${platformIcon} me-1"></i> ${item.platform}</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-navy text-white d-flex align-items-center justify-content-center me-2" style="width:30px; height:30px; font-size:0.8rem;">
                                    ${item.client_name.charAt(0)}
                                </div>
                                <div><div class="fw-bold">${item.client_name}</div></div>
                            </div>
                        </td>
                        <td>${item.deadline}</td>
                        <td><span class="badge ${statusBadge}">${item.status}</span></td>
                        <td><span class="badge bg-light text-dark border">${item.payment}</span></td>
                        <td class="text-end pe-4">
                            <a href="board.php?id=${item.id}" class="btn btn-sm btn-outline-primary" title="Task Board"><i class="fa-solid fa-list-check"></i></a>
                            <button class="btn btn-sm btn-light border" onclick="editProject(${item.id})"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-sm btn-outline-info" onclick="viewProject(${item.id})"><i class="fa-solid fa-book"></i></button>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteProject(${item.id})"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                `;
                container.insertAdjacentHTML('beforeend', html);
            });
        });
}

function editProject(id) {
    fetch(`../../api/projects.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                Swal.fire('Error', data.message, 'error');
                return;
            }

            // Isi form
            document.getElementById('editId').value = data.id;
            document.getElementById('editName').value = data.name;
            document.getElementById('editPlatform').value = data.platform;
            document.getElementById('editDeadline').value = data.deadline;
            document.getElementById('editClient').value = data.client_name;
            document.getElementById('editClientContact').value = data.client_contact || '';
            document.getElementById('editClientInst').value = data.client_institution || '';
            document.getElementById('editClientInst').value = data.client_institution || '';
            document.getElementById('editPrice').value = data.price || 0;
            document.getElementById('editDpAmount').value = data.dp_amount || 0;
            document.getElementById('editStatus').value = data.status;
            document.getElementById('editPayment').value = data.payment_status;

            // Render Addons
            const addonsContainer = document.getElementById('addonsContainer');
            addonsContainer.innerHTML = ''; // clear existing
            if (data.addons && data.addons.length > 0) {
                data.addons.forEach(addon => {
                    addAddonRow(addon.name, addon.price);
                });
            } else {
                // Optionally start with one empty row if none exist
                addAddonRow('', 0);
            }

            // Tampilkan modal
            const modal = new bootstrap.Modal(document.getElementById('editProjectModal'));
            modal.show();
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Error', 'Gagal memuat data project', 'error');
        });
}

function viewProject(id) {
    fetch(`../../api/projects.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                Swal.fire('Error', data.message, 'error');
                return;
            }

            document.getElementById('viewName').innerText = data.name;
            document.getElementById('viewPlatform').innerText = data.platform;

            // Calculate timeline string
            let created = new Date(data.created_at);
            let deadline = new Date(data.deadline);
            let fmtOpts = { day: 'numeric', month: 'short', year: 'numeric' };
            let tmLnStr = `${created.toLocaleDateString('id-ID', fmtOpts)} - ${deadline.toLocaleDateString('id-ID', fmtOpts)}`;
            document.getElementById('viewTimeline').innerText = tmLnStr;

            document.getElementById('viewClientName').innerText = data.client_name;
            document.getElementById('viewClientInst').innerText = data.client_institution || '-';
            document.getElementById('viewClientContact').innerText = data.client_contact || '-';

            // Format format rupiah
            const formatRp = (num) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num || 0);

            let price = parseInt(data.price) || 0;
            let totalAddons = parseInt(data.total_addons) || 0;
            let totalPrice = price + totalAddons;
            let dpAmount = parseInt(data.dp_amount) || 0;
            let balance = totalPrice - dpAmount;

            document.getElementById('viewPrice').innerText = formatRp(price);
            document.getElementById('viewTotalPrice').innerText = formatRp(totalPrice);
            document.getElementById('viewDpAmount').innerText = formatRp(dpAmount);
            document.getElementById('viewBalance').innerText = formatRp(balance);

            const addonsContainer = document.getElementById('viewAddonsContainer');
            addonsContainer.innerHTML = '';

            if (data.addons && data.addons.length > 0) {
                data.addons.forEach(addon => {
                    let aPrice = parseInt(addon.price) || 0;
                    let row = `<tr class="bg-light">
                        <td class="text-muted small"><i class="fa-solid fa-plus text-secondary me-1"></i> <span>${addon.name}</span></td>
                        <td class="fw-bold">${formatRp(aPrice)}</td>
                    </tr>`;
                    addonsContainer.insertAdjacentHTML('beforeend', row);
                });
            }

            // Update Cetak links
            document.getElementById('btnCetakInvoice').href = `invoice.html?id=${data.id}`;
            document.getElementById('btnCetakMOU').href = `mou.html?id=${data.id}`;

            // Status Badge
            let statusClass = data.status === 'Selesai' ? 'bg-success' : (data.status === 'Testing' ? 'bg-info' : 'bg-warning text-dark');
            document.getElementById('viewStatusBadge').innerHTML = `<span class="badge ${statusClass} fs-6">${data.status}</span>`;

            // Payment Badge
            document.getElementById('viewPaymentBadge').innerHTML = `<span class="badge bg-light border text-dark fs-6">${data.payment_status}</span>`;

            // Setup cover image display if exists based on logic plan (Not requested explicitly but good practice if cover_image was there)

            const modal = new bootstrap.Modal(document.getElementById('viewProjectModal'));
            modal.show();
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Error', 'Gagal memuat detail project', 'error');
        });
}

// Handler untuk form Edit
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('editProjectForm').addEventListener('submit', function (e) {
        e.preventDefault();

        let addons = [];
        const addonRows = document.querySelectorAll('.addon-row');
        addonRows.forEach(row => {
            const name = row.querySelector('.addon-name').value;
            const price = row.querySelector('.addon-price').value;
            if (name.trim() !== '' && price > 0) {
                addons.push({ name: name, price: price });
            }
        });

        let payload = {
            id: document.getElementById('editId').value,
            name: document.getElementById('editName').value,
            platform: document.getElementById('editPlatform').value,
            deadline: document.getElementById('editDeadline').value,
            client_name: document.getElementById('editClient').value,
            client_contact: document.getElementById('editClientContact').value,
            client_institution: document.getElementById('editClientInst').value,
            price: document.getElementById('editPrice').value,
            dp_amount: document.getElementById('editDpAmount').value,
            status: document.getElementById('editStatus').value,
            payment: document.getElementById('editPayment').value,
            addons: addons
        };

        fetch('../../api/projects.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
            .then(response => response.json())
            .then(res => {
                if (res.status === 'success') {
                    Swal.fire('Sukses', res.message, 'success');
                    const pModal = document.getElementById('editProjectModal');
                    const modal = bootstrap.Modal.getInstance(pModal);
                    modal.hide();
                    loadProjects();
                } else {
                    Swal.fire('Gagal', res.message, 'error');
                }
            })
            .catch(err => {
                Swal.fire('Error', 'Terjadi kesalahan jaringan', 'error');
                console.error(err);
            });
    });

    // Auto-fill logic for payment
    document.getElementById('pPayment').addEventListener('change', function () {
        if (this.value === 'Belum Bayar') {
            document.getElementById('pDpAmount').value = 0;
        } else if (this.value === 'Lunas') {
            document.getElementById('pDpAmount').value = document.getElementById('pPrice').value || 0;
        }
    });

    // Handle Adding New Addon Rows
    document.getElementById('btnAddAddon').addEventListener('click', function () {
        addAddonRow('', 0);
    });

    // Handle Remove Addon Rows (Event Delegation)
    document.getElementById('addonsContainer').addEventListener('click', function (e) {
        if (e.target.closest('.btn-remove-addon')) {
            e.target.closest('.addon-row').remove();
        }
    });
    document.getElementById('editPayment').addEventListener('change', function () {
        if (this.value === 'Belum Bayar') {
            document.getElementById('editDpAmount').value = 0;
        } else if (this.value === 'Lunas') {
            document.getElementById('editDpAmount').value = document.getElementById('editPrice').value || 0;
        }
    });
});

// Helper to append dynamic row to Edit Form
function addAddonRow(name = '', price = 0) {
    const container = document.getElementById('addonsContainer');
    const row = document.createElement('div');
    row.className = 'row addon-row mb-2 align-items-end';
    row.innerHTML = `
        <div class="col-6">
            <input type="text" class="form-control form-control-sm addon-name" placeholder="Nama Tambahan/Revisi" value="${name}">
        </div>
        <div class="col-4">
            <input type="number" class="form-control form-control-sm addon-price" placeholder="Harga" value="${price}" min="0">
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-sm btn-link text-danger btn-remove-addon p-0"><i class="fa-solid fa-trash"></i></button>
        </div>
    `;
    container.appendChild(row);
}

// Delete Project Handler
function deleteProject(id) {
    Swal.fire({
        title: 'Hapus Project?',
        text: "Data project dan pemasukan terkait akan dihapus permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`../../api/projects.php?id=${id}`, {
                method: 'DELETE'
            })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire('Terhapus!', data.message, 'success');
                        loadProjects();
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