<?php
session_start();

// Pastikan user sudah login sebagai admin
if(!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

include 'header.php';
?>

<main>
    <h2>Dashboard</h2>
    <p>Selamat datang di halaman admin.</p>
</main>

<?php include 'footer.php'; ?>
