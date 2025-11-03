<?php
// Ambil data dari form
$kecamatan = $_POST['kecamatan'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];
$luas = $_POST['luas'];
$jumlah_penduduk = $_POST['jumlah_penduduk'];

// Konfigurasi koneksi Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_8";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk menyimpan data ke tabel
$sql = "INSERT INTO data_kecamatan (kecamatan, longitude, latitude, luas, jumlah_penduduk)
        VALUES ('$kecamatan', '$longitude', '$latitude', '$luas', '$jumlah_penduduk')";

// Menyimpan data dan memeriksa apakah berhasil
if ($conn->query($sql) === TRUE) {
    echo "Record berhasil ditambahkan!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi
$conn->close();

// Redirect kembali ke halaman utama
// header("Location: ../index.php");
?>
