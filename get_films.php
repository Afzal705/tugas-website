<?php
include 'koneksi.php';

header('Content-Type: application/json'); // Set header untuk menunjukkan bahwa ini adalah JSON

try {
    $stmt = $pdo->prepare("SELECT * FROM films");
    $stmt->execute();
    $films = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($films); // Outputkan data dalam format JSON
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]); // Jika terjadi kesalahan, keluarkan pesan error dalam JSON
}
?>
