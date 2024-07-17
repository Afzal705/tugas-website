<?php
// manage_movies.php

// Include koneksi ke database
require_once 'koneksi.php';

// Query untuk mengambil data film dari database
$query = "SELECT * FROM films";
$statement = $pdo->prepare($query);
$statement->execute();
$films = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Film</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        nav {
            background-color: #444;
            overflow: hidden;
        }
        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        nav ul li {
            float: left;
            position: relative; /* Tambahkan posisi relatif untuk elemen li */
        }
        nav ul li a {
            display: block;
            color: white;
            padding: 1rem;
            text-decoration: none;
        }
        nav ul li a:hover {
            background-color: #555;
        }
        .dropdown {
            display: none;
            position: absolute;
            background-color: #444;
            z-index: 1; /* Atur z-index agar dropdown muncul di atas konten lain */
        }
        nav ul li:hover .dropdown {
            display: block;
        }
        .dropdown li {
            float: none;
        }
        main {
            padding: 1rem;
            position: relative; /* Tambahkan posisi relatif untuk elemen main */
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 1rem;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        .chart-container {
            width: 100%;
            height: 400px;
            margin-bottom: 1rem;
        }
    
    </style>
</head>
<body>
    <header>
        <h1>Admin Bioskop</h1>
    </header>
    <nav>
        <ul>
            <!-- Sesuaikan link aktif -->
            <li><a href="dashboard.php">Jadwal film</a></li>
            <li>
                <a href="#">Kelola <i class="fas fa-caret-down"></i></a>
                <ul class="dropdown">
                    <li><a href="manage_movies.php">Kelola Film</a></li>
                    <li><a href="manage_showtimes.php">Kelola Jadwal Tayang</a></li>
                    <li><a href="manage_tickets.php">Kelola Tiket</a></li>
                    <li><a href="manage_users.php">Kelola Pengguna</a></li>
                </ul>
            </li>
            <li><a href="reports.php">Laporan</a></li>
            <li><a href="settings.php">Pengaturan</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <main>
        <section class="table-container">
            <h2>Data Film</h2>
            <table>
                <thead>
                    <tr>
                        <th>Judul Film</th>
                        <th>Genre</th>
                        <th>Durasi</th>
                        <th>Tanggal Rilis</th>
                        <th>Deskripsi</th> <!-- Tambah kolom deskripsi -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($films as $film): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($film['title']); ?></td>
                            <td><?php echo htmlspecialchars($film['genre']); ?></td>
                            <td><?php echo htmlspecialchars($film['durasi']); ?></td>
                            <td><?php echo htmlspecialchars($film['tanggal_rilis']); ?></td>
                            <td><?php echo htmlspecialchars($film['description']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
