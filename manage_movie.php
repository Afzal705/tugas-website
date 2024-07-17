<?php
header('Content-Type: application/json');

// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'bioskop');

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk mendapatkan data film
$sql = "SELECT * FROM films";
$result = $conn->query($sql);

$films = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $films[] = $row;
    }
}

$conn->close();

echo json_encode($films);
?>
