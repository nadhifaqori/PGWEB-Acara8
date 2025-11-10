<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_8";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM data_kecamatan WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>💖 Edit Data Kecamatan</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #ffe6f2, #ffd9ec, #fff0f6);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff9fc;
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0px 6px 14px rgba(255, 182, 193, 0.5);
            width: 380px;
            border: 2px solid #ffc6dc;
        }

        h2 {
            text-align: center;
            color: #e75480;
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
            color: #5f3b46;
            display: block;
            margin-bottom: 6px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 14px;
            border: 1px solid #ffb6c1;
            border-radius: 10px;
            font-size: 14px;
            transition: 0.3s;
            background-color: #fff0f6;
        }

        input[type="text"]:focus {
            border-color: #ff80aa;
            outline: none;
            box-shadow: 0 0 5px rgba(255, 128, 170, 0.6);
            background-color: #fff9fb;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #b19cd9;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #9c8fc4;
            transform: scale(1.05);
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color: #ff8cb4;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>✏️ Edit Data Kecamatan 💕</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label>🏡 Kecamatan:</label>
        <input type="text" name="kecamatan" value="<?php echo $row['kecamatan']; ?>">

        <label>📍 Longitude:</label>
        <input type="text" name="longitude" value="<?php echo $row['longitude']; ?>">

        <label>📍 Latitude:</label>
        <input type="text" name="latitude" value="<?php echo $row['latitude']; ?>">

        <label>🌿 Luas (km²):</label>
        <input type="text" name="luas" value="<?php echo $row['luas']; ?>">

        <label>👨‍👩‍👧‍👦 Jumlah Penduduk:</label>
        <input type="text" name="jumlah_penduduk" value="<?php echo $row['jumlah_penduduk']; ?>">

        <input type="submit" value="💾 Simpan Perubahan">
    </form>

    <div class="back-link">
        <a href="index.php">← Kembali ke Data 🌸</a>
    </div>
</div>

</body>
</html>

<?php $conn->close(); ?>
