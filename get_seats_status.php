<?php
// Include koneksi ke database
include 'koneksi.php';

// Query untuk mengambil status kursi dari database
$stmt = $pdo->query("SELECT seat, COUNT(*) as occupied FROM orders GROUP BY seat");

$seatStatus = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $seatStatus[] = [
        'seat' => $row['seat'],
        'occupied' => intval($row['occupied']) > 0 ? true : false,
    ];
}

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($seatStatus);
?>
