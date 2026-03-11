<?php
// 1. Konfigurasi Database
$servername = "localhost";
$username = "root";        // Username default XAMPP
$password = "";            // Password default XAMPP (kosong)
$dbname = "db_paketwisata"; // Nama database yang Anda buat

// 2. Buat Koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// 3. Cek Koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// 4. Ambil Data dari Form (Pastikan method="POST")
$nama = $_POST["nama_lengkap"];
$email = $_POST["email"];
$telepon = $_POST["nomor_telepon"];
$paket = $_POST["paket_wisata"];
$tanggal = $_POST["tanggal_keberangkatan"];
$jumlah = $_POST["jumlah_peserta"];
$pesan = $_POST["pesan_tambahan"];

// 5. Siapkan Perintah SQL (Prepared Statements agar aman)
$stmt = $conn->prepare("INSERT INTO pemesanan (nama_lengkap, email, nomor_telepon, paket_wisata, tanggal_keberangkatan, jumlah_peserta, pesan_tambahan) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssis", $nama, $email, $telepon, $paket, $tanggal, $jumlah, $pesan);

// 6. Eksekusi Perintah
if ($stmt->execute()) {
    // Jika berhasil, tampilkan pesan dan kembali ke halaman contact
    echo "<script>
            alert('Yeee Pesanan Anda Berhasil Terkirim');
            window.location.href = 'contact.html';
          </script>";
} else {
    // Jika gagal
    echo "<script>
            alert('Terjadi kesalahan: " . $stmt->error . "');
            window.location.href = 'contact.html';
          </script>";
}

// 7. Tutup Koneksi
$stmt->close();
$conn->close();

?> 