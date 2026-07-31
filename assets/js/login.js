document.addEventListener("DOMContentLoaded", function () {

    const loginForm = document.getElementById("loginForm");

    loginForm.addEventListener("submit", function (e) {
        e.preventDefault(); // Mencegah reload halaman

        const btn = document.getElementById("btnLogin");
        const originalText = btn.innerHTML;

        // Ubah tombol jadi loading
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memeriksa...';
        btn.disabled = true;

        // Ambil data
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        // Kirim ke Backend PHP
        fetch('../api/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email: email, password: password })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Login Berhasil
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil',
                        text: 'Mengalihkan ke Dashboard...',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        // Simpan sesi (sederhana) di localStorage
                        localStorage.setItem('isLoggedIn', 'true');
                        localStorage.setItem('userEmail', data.user.email);
                        localStorage.setItem('userName', data.user.name);
                        localStorage.setItem('userRole', data.user.role);
                        
                        const photoUrl = data.user.photo ? `../assets/img/profile/${data.user.photo}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(data.user.name)}&background=0D2E5C&color=fff`;
                        localStorage.setItem('userPhoto', photoUrl);

                        // Redirect ke Dashboard (cek role khusus investor)
                        if (data.user.role === 'investor') {
                            window.location.href = '../dashboard/investor.php';
                        } else if (data.user.role === 'staff') {
                            window.location.href = '../dashboard/index.php'; // Redirect staff ke index admin sementara
                        } else {
                            window.location.href = '../dashboard/index.php';
                        }
                    });
                } else {
                    // Login Gagal
                    const alertHtml = `
                    <div class="alert alert-danger py-2 small fade show" role="alert">
                        <i class="fa-solid fa-circle-exclamation me-1"></i> ${data.message}
                    </div>
                `;
                    document.getElementById("alertContainer").innerHTML = alertHtml;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan sistem.' });
            })
            .finally(() => {
                // Kembalikan tombol
                btn.innerHTML = originalText;
                btn.disabled = false;
            });
    });
});