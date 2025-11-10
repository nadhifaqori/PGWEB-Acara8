<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>🌸 Web GIS Kecamatan Sleman DIY 🌸</title>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #ffe9e9ff, #ffe1e1ff, #ffe6e6ff);
      color: #4a4a4a;
      padding: 40px;
      margin: 0;
      min-height: 100vh;
    }

    h1 {
      text-align: center;
      color: #b74f6eff;
      margin-bottom: 25px;
      font-size: 28px;
      letter-spacing: 1px;
    }

    a {
      display: inline-block;
      margin-bottom: 20px;
      padding: 10px 16px;
      background-color: #fc9fbfff;
      color: white;
      text-decoration: none;
      border-radius: 12px;
      font-weight: bold;
      transition: 0.3s;
    }

    a:hover {
      background-color: #e29ae0ff;
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
    }

    .aksi-btn {
      padding: 6px 10px;
      margin: 2px;
      border-radius: 8px;
      font-size: 13px;
      font-weight: bold;
      text-decoration: none;
      transition: 0.3s;
    }

    .edit {
      background-color: #b19cd9;
      color: white;
    }

    .hapus {
      background-color: #ff8ca7ff;
      color: white;
    }

    .hapus:hover {
      background-color: #ff4d6d;
    }

    /* 🌸 Kotak Map */
    .map-card {
      background-color: #fff9fc;
      border-radius: 20px;
      box-shadow: 0 6px 18px rgba(255, 182, 193, 0.5);
      padding: 25px;
      margin-top: 40px;
      max-width: 950px;
      margin-left: auto;
      margin-right: auto;
      border: 3px solid transparent;
      background-image: linear-gradient(#fff9fc, #fff9fc),
                        linear-gradient(135deg,  #ffe6f2, #ffd9ec, #fff0f6);
      background-origin: border-box;
      background-clip: content-box, border-box;
      animation: fadeIn 1s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .map-card h2 {
      text-align: center;
      color: #b74f6eff;
      margin-bottom: 15px;
      font-size: 22px;
      letter-spacing: 0.5px;
    }

    #map {
      height: 450px;
      width: 100%;
      border-radius: 15px;
      box-shadow: inset 0 0 8px rgba(0,0,0,0.1);
    }

    footer {
      text-align: center;
      margin-top: 30px;
      color: #777;
      font-size: 13px;
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
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM data_kecamatan";
$result = $conn->query($sql);

echo "<a href='input/index.html'>➕ Tambah Data Baru 💖</a>";

$kecamatan_data = [];

if ($result->num_rows > 0) {
  echo "<table>
  <tr>
      <th>🌸 ID</th>
      <th>🏡 Kecamatan</th>
      <th>📍 Longitude</th>
      <th>📍 Latitude</th>
      <th>🌿 Luas (km²)</th>
      <th>👨‍👩‍👧‍👦 Jumlah Penduduk</th>
      <th>🛠️ Aksi</th>
  </tr>";

  while($row = $result->fetch_assoc()) {
      echo "<tr>
          <td>".$row["id"]."</td>
          <td>".$row["kecamatan"]."</td>
          <td>".$row["longitude"]."</td>
          <td>".$row["latitude"]."</td>
          <td>".$row["luas"]."</td>
          <td align='right'>".$row["jumlah_penduduk"]."</td>
          <td>
              <a href='edit.php?id=".$row["id"]."' class='aksi-btn edit'>✏️ Edit</a>
              <a href='delete.php?id=".$row["id"]."' class='aksi-btn hapus' onclick=\"return confirm('Yakin mau hapus data ini? 😿');\">🗑️ Delete</a>
          </td>
      </tr>";

      $kecamatan_data[] = [
        'nama' => $row['kecamatan'],
        'lat' => floatval($row['latitude']),
        'lng' => floatval($row['longitude']),
        'luas' => $row['luas'],
        'penduduk' => $row['jumlah_penduduk']
      ];
  }
  echo "</table>";
} else {
  echo "<p style='text-align:center;'>😿 Belum ada data...</p>";
}

$conn->close();
?>

<!-- 🌸 MAP SECTION -->
<div class="map-card">
  <h2>🗺️ Lokasi Kecamatan</h2>
  <div id="map"></div>
</div>

<footer>
  🌸 Made with love by <b>Nadhifa Qori Aulia (24/543614/SV/25238)</b> 💕 <br>
  <small>SIG UGM</small>
</footer>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
var map = L.map('map').setView([-7.8, 110.4], 11);

// Tambah tile peta
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 19,
  attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

var kecamatanData = <?php echo json_encode($kecamatan_data); ?>;
var bounds = [];

kecamatanData.forEach(function(kec) {
  if (kec.lat && kec.lng) {
    L.marker([kec.lat, kec.lng])
      .addTo(map)
      .bindPopup("<b>" + kec.nama + "</b><br>Luas: " + kec.luas + " km²<br>Penduduk: " + kec.penduduk);
    bounds.push([kec.lat, kec.lng]);
  }
});

// Auto-zoom
if (bounds.length > 0) {
  map.fitBounds(bounds, { padding: [50, 50] });
}

// Pastikan peta tampil penuh setelah render
window.addEventListener('load', () => {
  setTimeout(() => map.invalidateSize(), 400);
});
</script>

</body>
</html>
