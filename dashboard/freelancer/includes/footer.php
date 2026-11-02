        <!-- Footer -->
        <footer class="mt-5 pt-4 text-center text-muted border-top">
            <small>&copy; <?= date('Y') ?> <strong>Skillance Digital Indonesia</strong>. Platform Kolaborasi Freelance Mahasiswa & Umum.</small>
        </footer>
    </div> <!-- End Main Wrapper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Sidebar Mobile Toggle
        const sidebar = document.getElementById('freelanceSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const btnToggle = document.getElementById('btnToggleSidebar');
        const btnClose = document.getElementById('btnCloseSidebar');

        if (btnToggle) {
            btnToggle.addEventListener('click', () => {
                sidebar.classList.add('show');
                overlay.classList.add('show');
            });
        }
        if (btnClose) {
            btnClose.addEventListener('click', () => {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
        }
        if (overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });
        }

        // Format Rupiah Helper
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
        }

        // Confirm Logout Handler
        function confirmLogout(e) {
            if (e) e.preventDefault();
            Swal.fire({
                title: 'Keluar dari Akun?',
                text: 'Apakah Anda yakin ingin keluar dari sistem Skillance Freelance?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#0d2e5c'
            }).then((result) => {
                if (result.isConfirmed) {
                    localStorage.clear();
                    window.location.href = '../../api/logout.php';
                }
            });
        }
    </script>
</body>
</html>
