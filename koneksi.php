<?php
$host = 'localhost'; // Sesuaikan dengan host Anda
$dbname = 'bioskop'; // Sesuaikan dengan nama database Anda
$username = 'root'; // Sesuaikan dengan username database Anda
$password = ''; // Sesuaikan dengan password database Anda, biasanya kosong di environment pengembangan lokal

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>