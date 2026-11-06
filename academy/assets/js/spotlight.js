/**
 * Skillance Academy - Spotlight Search Engine (Ctrl + K)
 */

let spotlightDebounce = null;
let spotlightActiveIndex = -1;

function openSpotlightSearch() {
    const modal = document.getElementById('spotlightModal');
    const input = document.getElementById('spotlightInput');
    if (!modal || !input) return;

    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    input.value = '';
    input.focus();
    spotlightActiveIndex = -1;
    fetchSpotlightResults('');
}

function closeSpotlightSearch() {
    const modal = document.getElementById('spotlightModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

// Global Keyboard Shortcut: Ctrl + K or Cmd + K
document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && (e.key === 'k' || e.key === 'K')) {
        e.preventDefault();
        const modal = document.getElementById('spotlightModal');
        if (modal && modal.style.display === 'flex') {
            closeSpotlightSearch();
        } else {
            openSpotlightSearch();
        }
    } else if (e.key === 'Escape') {
        closeSpotlightSearch();
    }
});

// Input typing listener with debounce
document.addEventListener('DOMContentLoaded', function() {
    const input = document.getElementById('spotlightInput');
    if (input) {
        input.addEventListener('input', function(e) {
            clearTimeout(spotlightDebounce);
            const val = e.target.value.trim();
            spotlightDebounce = setTimeout(() => {
                fetchSpotlightResults(val);
            }, 250);
        });

        // Keyboard arrow navigation
        input.addEventListener('keydown', function(e) {
            const items = document.querySelectorAll('.spotlight-item');
            if (items.length === 0) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                spotlightActiveIndex = (spotlightActiveIndex + 1) % items.length;
                updateSpotlightActive(items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                spotlightActiveIndex = (spotlightActiveIndex - 1 + items.length) % items.length;
                updateSpotlightActive(items);
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (spotlightActiveIndex >= 0 && items[spotlightActiveIndex]) {
                    window.location.href = items[spotlightActiveIndex].getAttribute('href');
                } else if (items.length > 0) {
                    window.location.href = items[0].getAttribute('href');
                }
            }
        });
    }
});

function updateSpotlightActive(items) {
    items.forEach((item, idx) => {
        if (idx === spotlightActiveIndex) {
            item.classList.add('active');
            item.scrollIntoView({ block: 'nearest' });
        } else {
            item.classList.remove('active');
        }
    });
}

function fetchSpotlightResults(q) {
    const list = document.getElementById('spotlightResults');
    const loading = document.getElementById('spotlightLoading');
    if (!list) return;

    if (loading) loading.style.display = 'block';

    fetch('api/search.php?q=' + encodeURIComponent(q))
        .then(res => res.json())
        .then(data => {
            if (loading) loading.style.display = 'none';
            if (data.status !== 'success' || !data.results || data.results.length === 0) {
                list.innerHTML = `
                    <div style="text-align:center; padding:30px 10px; color:#94a3b8;">
                        <i class="fa-solid fa-magnifying-glass-chart fs-2 mb-2 text-muted"></i>
                        <p class="mb-1 fw-bold text-dark">Tidak ada materi yang cocok</p>
                        <small>Coba gunakan kata kunci umum seperti: flexbox, flutter, figma, api, vue, python</small>
                    </div>
                `;
                return;
            }

            let html = '';
            if (data.is_featured) {
                html += `<div style="font-size:0.75rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; padding:6px 14px 4px 14px;">🔥 Rekomendasi Materi Populer</div>`;
            } else {
                html += `<div style="font-size:0.75rem; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.5px; padding:6px 14px 4px 14px;">Ditemukan ${data.total} Materi Terkait</div>`;
            }

            data.results.forEach((r, idx) => {
                html += `
                    <a href="${r.url}" class="spotlight-item ${idx === 0 ? 'active' : ''}">
                        <span class="spotlight-badge" style="background:${r.course_color};">${r.course_name}</span>
                        <div class="spotlight-item-content">
                            <div class="spotlight-item-title">${escapeHtml(r.title)}</div>
                            <div class="spotlight-item-summary">${escapeHtml(r.summary)}</div>
                            <div class="spotlight-item-cat"><i class="fa-solid fa-folder-tree me-1 opacity-75"></i>${escapeHtml(r.category)}</div>
                        </div>
                        <i class="fa-solid fa-arrow-turn-down text-muted small mt-2" style="transform:rotate(90deg); opacity:0.5;"></i>
                    </a>
                `;
            });

            list.innerHTML = html;
            spotlightActiveIndex = 0;
        })
        .catch(err => {
            if (loading) loading.style.display = 'none';
            list.innerHTML = `<div style="text-align:center; padding:20px; color:#ef4444;">Gagal memuat hasil pencarian.</div>`;
        });
}

function escapeHtml(str) {
    if (!str) return '';
    return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}
