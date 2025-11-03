<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌸 Data Kecamatan Yogyakarta 🌸</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #ffe6f2, #ffd9ec, #fff0f6);
            color: #4a4a4a;
            padding: 40px;
        }

        h1 {
            text-align: center;
            color: #e75480;
            margin-bottom: 25px;
            font-size: 28px;
            letter-spacing: 1px;
        }

        a {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 16px;
            background-color: #ff8cb4;
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: bold;
            transition: 0.3s;
        }

        a:hover {
            background-color: #ff5cfaff;
            transform: scale(1.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 4px 10px rgba(255, 182, 193, 0.4);
            background-color: #fff5fa;
        }

        th {
            background-color: #b58093ff;
            color: white;
            padding: 12px;
            font-size: 16px;
            text-align: center;
        }

        td {
            text-align: center;
            padding: 10px;
            border-bottom: 1px solid #ffe1ed;
        }

        tr:nth-child(even) td {
            background-color: #fff0f6;
        }

        tr:hover td {
            background-color: #ffe8f1;
            transform: scale(1.01);
        }

        footer {
            text-align: center;
            margin-top: 30px;
            color: #777;
            font-size: 13px;
        }

        .emoji {
            font-size: 20px;
        }
    </style>
</head>
<body>

<h1>💕 Data Kecamatan DIY 💕</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_8"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM data_kecamatan";
$result = $conn->query($sql);

echo "<a href='input/index.html'>➕ Tambah Data Baru 💖</a>";

if ($result->num_rows > 0) {
    echo "<table>
    <tr>
        <th>🌸 ID</th>
        <th>🏡 Kecamatan</th>
        <th>📍 Longitude</th>
        <th>📍 Latitude</th>
        <th>🌿 Luas (km²)</th>
        <th>👨‍👩‍👧‍👦 Jumlah Penduduk</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row["id"]."</td>
            <td>".$row["kecamatan"]."</td>
            <td>".$row["longitude"]."</td>
            <td>".$row["latitude"]."</td>
            <td>".$row["luas"]."</td>
            <td align='right'>".$row["jumlah_penduduk"]."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>😿 Belum ada data nih...</p>";
}

$conn->close();
?>

<footer>
    🌸 Made with love by <b>Nadhifa Qori Aulia (24/543614/SV/25238)</b> 💕 <br>
    <small>SIG UGM</small>
</footer>

</body>
</html>
