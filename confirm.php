<?php
session_start();
if (!isset($_SESSION['film']) || !isset($_SESSION['jumlah'])) {
    header("Location: index.php");
    exit();
}

$film = $_SESSION['film'];
$jumlah = $_SESSION['jumlah'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pemesanan</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Konfirmasi Pemesanan</h1>
        </header>
        <main>
            <p>Film: <?php echo htmlspecialchars($film); ?></p>
            <p>Jumlah Tiket: <?php echo htmlspecialchars($jumlah); ?></p>
            <button onclick="window.location.href='index.php';">Pesan Lagi</button>
        </main>
    </div>
</body>
</html>
