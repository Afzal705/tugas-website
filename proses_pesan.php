<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $selectedSeat = $_POST['selectedSeat'];
    $filmId = $_POST['filmId'];

    try {
        $stmt = $pdo->prepare("INSERT INTO orders (film_id, seat, nama, email) VALUES (?, ?, ?, ?)");
        $stmt->execute([$filmId, $selectedSeat, $nama, $email]);

        echo "Tiket untuk kursi $selectedSeat pada film $filmId telah berhasil dipesan atas nama $nama.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>