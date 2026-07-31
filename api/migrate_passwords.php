<?php
require_once '../config/config.php';

// Cek dan tampilkan semua user yang password-nya belum di-hash (panjang password Bcrypt = 60 karakter)
// Untuk keamanan, script ini TIDAK menampilkan pesan detail ke publik kecuali dijalankan secara internal
$query = "SELECT id, password FROM users";
$result = $conn->query($query);

$updated = 0;
while ($row = $result->fetch_assoc()) {
    $current_pass = $row['password'];
    
    // Periksa apakah password bukan hash bcrypt (Bcrypt selalu berawal dengan $2y$ dan panjangnya 60)
    if (strlen($current_pass) != 60 || substr($current_pass, 0, 4) !== '$2y$') {
        $hashed = password_hash($current_pass, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hashed, $row['id']);
        if ($stmt->execute()) {
            $updated++;
        }
    }
}

echo "Migrasi Selesai. Total $updated akun berhasil dienkripsi password-nya.";
$conn->close();
?>
