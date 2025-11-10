<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgweb_8";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, kecamatan, longitude, latitude, luas, jumlah_penduduk FROM data_kecamatan";
$result = $conn->query($sql);

$features = array();

while($row = $result->fetch_assoc()) {
    $feature = array(
        'type' => 'Feature',
        'geometry' => array(
            'type' => 'Point',
            'coordinates' => [(float)$row['longitude'], (float)$row['latitude']]
        ),
        'properties' => array(
            'id' => $row['id'],
            'kecamatan' => $row['kecamatan'],
            'luas' => $row['luas'],
            'jumlah_penduduk' => $row['jumlah_penduduk']
        )
    );
    array_push($features, $feature);
}

$featureCollection = array(
    'type' => 'FeatureCollection',
    'features' => $features
);

$conn->close();

echo json_encode($featureCollection);
?>
