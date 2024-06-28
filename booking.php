<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $film = $_POST['film'];
    $jumlah = $_POST['jumlah'];

    // Simpan data ke dalam session (untuk contoh sederhana)
    session_start();
    $_SESSION['film'] = $film;
    $_SESSION['jumlah'] = $jumlah;

    header("Location: confirm.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>

