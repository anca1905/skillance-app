<!-- SPOTLIGHT SEARCH MODAL (Ctrl + K) -->
<div id="spotlightModal" class="spotlight-overlay" style="display:none;" onclick="if(event.target === this) closeSpotlightSearch();">
    <div class="spotlight-dialog">
        <div class="spotlight-search-header">
            <i class="fa-solid fa-magnifying-glass fs-5 text-muted"></i>
            <input type="text" id="spotlightInput" class="spotlight-input" placeholder="Cari materi koding (misal: flexbox, BLoC, pointer, gemini, figma)..." autocomplete="off">
            <button type="button" class="btn-close-spotlight" onclick="closeSpotlightSearch()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="spotlight-body">
            <div id="spotlightLoading" style="display:none; text-align:center; padding:20px; color:#0284c7;">
                <i class="fa-solid fa-circle-notch fa-spin fs-4"></i>
                <span class="d-block mt-2 small text-muted">Mencari materi terbaik...</span>
            </div>
            <div id="spotlightResults" class="spotlight-results-list">
                <!-- Injected via JavaScript -->
            </div>
        </div>
        <div class="spotlight-footer">
            <span><kbd>↑</kbd> <kbd>↓</kbd> Navigasi</span>
            <span><kbd>Enter</kbd> Pilih</span>
            <span><kbd>ESC</kbd> Tutup</span>
        </div>
    </div>
</div>

<style>
.spotlight-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(15, 23, 42, 0.65);
    backdrop-filter: blur(6px);
    z-index: 99999;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding-top: 10vh;
}
.spotlight-dialog {
    background: #ffffff;
    width: 90%;
    max-width: 640px;
    border-radius: 16px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    animation: spotlightPop 0.2s cubic-bezier(0.16, 1, 0.3, 1);
}
@keyframes spotlightPop {
    from { opacity: 0; transform: scale(0.96) translateY(-10px); }
    to { opacity: 1; transform: scale(1) translateY(0); }
}
.spotlight-search-header {
    display: flex;
    align-items: center;
    padding: 14px 18px;
    border-bottom: 1px solid #e2e8f0;
    gap: 12px;
}
.spotlight-input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 1.05rem;
    font-family: inherit;
    color: #0f172a;
    background: transparent;
}
.spotlight-input::placeholder {
    color: #94a3b8;
    font-size: 0.95rem;
}
.btn-close-spotlight {
    background: transparent;
    border: none;
    color: #94a3b8;
    font-size: 1.1rem;
    cursor: pointer;
    padding: 4px;
    border-radius: 6px;
    transition: color 0.15s;
}
.btn-close-spotlight:hover {
    color: #0f172a;
}
.spotlight-body {
    max-height: 400px;
    overflow-y: auto;
    padding: 8px;
}
.spotlight-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 10px 14px;
    border-radius: 10px;
    text-decoration: none;
    color: inherit;
    transition: all 0.15s ease;
    cursor: pointer;
}
.spotlight-item:hover, .spotlight-item.active {
    background: #f1f5f9;
}
.spotlight-item.active {
    outline: 2px solid #0d2e5c;
}
.spotlight-badge {
    padding: 3px 8px;
    border-radius: 6px;
    font-size: 0.72rem;
    font-weight: 700;
    color: white;
    flex-shrink: 0;
    margin-top: 2px;
}
.spotlight-item-content {
    flex: 1;
    min-width: 0;
}
.spotlight-item-title {
    font-weight: 700;
    font-size: 0.92rem;
    color: #0d2e5c;
    margin-bottom: 2px;
}
.spotlight-item-summary {
    font-size: 0.78rem;
    color: #64748b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.spotlight-item-cat {
    font-size: 0.7rem;
    color: #94a3b8;
    margin-top: 2px;
}
.spotlight-footer {
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    padding: 8px 18px;
    display: flex;
    justify-content: flex-end;
    gap: 16px;
    font-size: 0.75rem;
    color: #64748b;
}
.spotlight-footer kbd {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 4px;
    padding: 2px 6px;
    font-family: monospace;
    font-size: 0.7rem;
    color: #475569;
}
</style>
