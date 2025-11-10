<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_8";

// Koneksi ke database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Jalankan query hapus
    $sql = "DELETE FROM data_kecamatan WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: index.php"); // balik ke halaman utama
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
