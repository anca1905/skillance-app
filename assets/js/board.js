document.addEventListener("DOMContentLoaded", function () {
    const projectId = document.getElementById('currentProjectId').value;
    let allTasks = [];
    let usersList = [];

    // Initialize Sortable for each column
    const columns = document.querySelectorAll('.task-list');
    columns.forEach(col => {
        new Sortable(col, {
            group: 'shared', // set both lists to same group
            animation: 150,
            ghostClass: 'sortable-ghost',
            dragClass: 'sortable-drag',
            onEnd: function (evt) {
                const itemEl = evt.item;  // dragged HTMLElement
                const toList = evt.to;    // target list
                
                const taskId = itemEl.getAttribute('data-id');
                const newStatus = toList.getAttribute('data-status');
                
                // Only update if it actually moved to a different column or changed position significantly
                // Here we just trigger update if status changed
                if (evt.from !== evt.to) {
                    updateTaskStatus(taskId, newStatus);
                }
            },
        });
    });

    loadBoardData(projectId);

    document.getElementById('taskForm').addEventListener('submit', function (e) {
        e.preventDefault();
        saveTask(projectId);
    });

    const coverInput = document.getElementById('tCover');
    if (coverInput) {
        coverInput.addEventListener('change', function() {
            const file = this.files[0];
            const previewContainer = document.getElementById('coverPreviewContainer');
            const previewImage = document.getElementById('coverPreview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            } else {
                previewImage.src = '';
                previewContainer.classList.add('d-none');
            }
        });
    }
});

function loadBoardData(projectId) {
    fetch(`../../api/tasks.php?project_id=${projectId}`)
        .then(response => response.json())
        .then(res => {
            if (res.status === 'success') {
                allTasks = res.data;
                usersList = res.users;
                
                populateAssigneeDropdown();
                renderBoard();
            } else {
                Swal.fire('Error', res.message, 'error');
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire('Error', 'Gagal memuat data board', 'error');
        });
}

function populateAssigneeDropdown() {
    const select = document.getElementById('tAssignee');
    select.innerHTML = '<option value="">-- Pilih Anggota --</option>';
    usersList.forEach(user => {
        select.insertAdjacentHTML('beforeend', `<option value="${user.id}">${user.name}</option>`);
    });
}

function renderBoard() {
    // Clear all columns
    const statuses = ['Backlog', 'To Do', 'Development', 'Testing', 'Bug & Improvement', 'Selesai'];
    let counts = { 'Backlog': 0, 'To Do': 0, 'Development': 0, 'Testing': 0, 'Bug & Improvement': 0, 'Selesai': 0 };

    statuses.forEach(status => {
        document.getElementById(`col-${status}`).innerHTML = '';
    });

    allTasks.forEach(task => {
        const status = task.status;
        if (counts[status] !== undefined) {
            counts[status]++;
            const col = document.getElementById(`col-${status}`);
            col.insertAdjacentHTML('beforeend', createTaskCard(task));
        }
    });

    // Update counts
    statuses.forEach(status => {
        document.getElementById(`count-${status}`).innerText = counts[status];
    });
}

function createTaskCard(task) {
    let priorityClass = 'priority-normal';
    if (task.priority === 'High') priorityClass = 'priority-high';
    if (task.priority === 'Low') priorityClass = 'priority-low';

    let tagsHtml = '';
    if (task.tags) {
        const tags = task.tags.split(',').map(t => t.trim()).filter(t => t);
        tagsHtml = tags.map(t => `<span class="task-tag">${t}</span>`).join('');
    }
    
    let assigneeHtml = '';
    if (task.assignee_name) {
        const initials = task.assignee_name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
        assigneeHtml = `<div class="assignee-avatar" title="${task.assignee_name}">${initials}</div>`;
    }

    let dueDateHtml = '';
    if (task.due_date) {
        let dateObj = new Date(task.due_date);
        let dateStr = dateObj.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
        
        let isOverdue = false;
        if (task.status !== 'Selesai' && dateObj < new Date(new Date().setHours(0,0,0,0))) {
            isOverdue = true;
        }
        
        dueDateHtml = `<span class="${isOverdue ? 'text-danger fw-bold' : ''}"><i class="fa-regular fa-clock me-1"></i> ${dateStr}</span>`;
    }

    let coverHtml = '';
    if (task.cover_photo) {
        coverHtml = `<div class="task-cover mb-2" style="height: 120px; border-radius: 6px; overflow: hidden; margin: -15px -15px 15px -15px;">
                        <img src="../../${task.cover_photo}" style="width: 100%; height: 100%; object-fit: cover; cursor: pointer;" alt="Cover" onclick="event.stopPropagation(); openFullImage(this.src)">
                     </div>`;
    }

    return `
        <div class="task-card ${priorityClass}" data-id="${task.id}" onclick="editTask(${task.id})">
            ${coverHtml}
            <div class="task-title">${task.title}</div>
            ${tagsHtml ? `<div class="task-tags">${tagsHtml}</div>` : ''}
            <div class="task-footer">
                <div>
                    <i class="fa-solid fa-flag ${
                        task.priority === 'High' ? 'text-danger' : 
                        (task.priority === 'Low' ? 'text-success' : 'text-warning')
                    }" title="Priority: ${task.priority}"></i>
                    ${dueDateHtml ? `<span class="ms-2">${dueDateHtml}</span>` : ''}
                </div>
                ${assigneeHtml}
            </div>
        </div>
    `;
}

function openTaskModal() {
    document.getElementById('taskForm').reset();
    document.getElementById('taskId').value = '';
    if(document.getElementById('tCover')) document.getElementById('tCover').value = '';
    if(document.getElementById('coverPreviewContainer')) {
        document.getElementById('coverPreviewContainer').classList.add('d-none');
        document.getElementById('coverPreview').src = '';
    }
    document.getElementById('taskModalTitle').innerText = 'Tambah Task';
    document.getElementById('btnDeleteTask').classList.add('d-none');
    
    const modal = new bootstrap.Modal(document.getElementById('taskModal'));
    modal.show();
}

function editTask(id) {
    const task = allTasks.find(t => t.id == id);
    if (!task) return;

    document.getElementById('taskId').value = task.id;
    document.getElementById('tTitle').value = task.title;
    document.getElementById('tDescription').value = task.description || '';
    document.getElementById('tStatus').value = task.status;
    document.getElementById('tPriority').value = task.priority;
    document.getElementById('tDueDate').value = task.due_date || '';
    document.getElementById('tAssignee').value = task.assignee_id || '';
    document.getElementById('tTags').value = task.tags || '';
    if(document.getElementById('tCover')) document.getElementById('tCover').value = '';
    if(document.getElementById('coverPreviewContainer')) {
        if(task.cover_photo) {
            document.getElementById('coverPreview').src = '../../' + task.cover_photo;
            document.getElementById('coverPreviewContainer').classList.remove('d-none');
        } else {
            document.getElementById('coverPreview').src = '';
            document.getElementById('coverPreviewContainer').classList.add('d-none');
        }
    }

    document.getElementById('taskModalTitle').innerText = 'Edit Task';
    document.getElementById('btnDeleteTask').classList.remove('d-none');

    const modal = new bootstrap.Modal(document.getElementById('taskModal'));
    modal.show();
}

function saveTask(projectId) {
    const id = document.getElementById('taskId').value;
    const coverFile = document.getElementById('tCover') ? document.getElementById('tCover').files[0] : null;
    
    const formData = new FormData();
    formData.append('project_id', projectId);
    formData.append('title', document.getElementById('tTitle').value);
    formData.append('description', document.getElementById('tDescription').value);
    formData.append('status', document.getElementById('tStatus').value);
    formData.append('priority', document.getElementById('tPriority').value);
    formData.append('due_date', document.getElementById('tDueDate').value);
    formData.append('assignee_id', document.getElementById('tAssignee').value);
    formData.append('tags', document.getElementById('tTags').value);
    
    if (coverFile) {
        formData.append('cover_photo', coverFile);
    }
    
    let url = '../../api/tasks.php';
    
    if (id) {
        formData.append('id', id);
    }

    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(res => {
        if (res.status === 'success') {
            const modal = bootstrap.Modal.getInstance(document.getElementById('taskModal'));
            modal.hide();
            loadBoardData(projectId); // Reload to get fresh data
        } else {
            Swal.fire('Gagal', res.message, 'error');
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire('Error', 'Terjadi kesalahan saat menyimpan', 'error');
    });
}

function updateTaskStatus(taskId, newStatus) {
    const payload = {
        id: taskId,
        update_status: true,
        status: newStatus
    };

    fetch('../../api/tasks.php', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
    })
    .then(response => response.json())
    .then(res => {
        if (res.status === 'success') {
            // Update local array so counts refresh correctly if we call renderBoard
            const taskIndex = allTasks.findIndex(t => t.id == taskId);
            if (taskIndex > -1) {
                allTasks[taskIndex].status = newStatus;
                
                // Just update the counts without full re-render to avoid flicker
                updateCountsOnly();
            }
        } else {
            Swal.fire('Gagal', res.message, 'error');
            loadBoardData(document.getElementById('currentProjectId').value); // revert
        }
    })
    .catch(err => {
        console.error(err);
        Swal.fire('Error', 'Terjadi kesalahan jaringan', 'error');
        loadBoardData(document.getElementById('currentProjectId').value); // revert
    });
}

function updateCountsOnly() {
    const statuses = ['Backlog', 'To Do', 'Development', 'Testing', 'Bug & Improvement', 'Selesai'];
    let counts = { 'Backlog': 0, 'To Do': 0, 'Development': 0, 'Testing': 0, 'Bug & Improvement': 0, 'Selesai': 0 };

    allTasks.forEach(task => {
        if (counts[task.status] !== undefined) {
            counts[task.status]++;
        }
    });

    statuses.forEach(status => {
        document.getElementById(`count-${status}`).innerText = counts[status];
    });
}

function deleteTask() {
    const id = document.getElementById('taskId').value;
    if (!id) return;
    
    const projectId = document.getElementById('currentProjectId').value;

    Swal.fire({
        title: 'Hapus Task?',
        text: "Data task ini akan dihapus permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`../../api/tasks.php?id=${id}`, {
                method: 'DELETE'
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('taskModal'));
                    modal.hide();
                    loadBoardData(projectId);
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

function openFullImage(src) {
    if (!src) return;
    document.getElementById('fullImagePreview').src = src;
    const modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
    modal.show();
}
