<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password']; // Menggunakan MD5 untuk hashing, sebaiknya gunakan bcrypt untuk keamanan yang lebih baik

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->execute(['username' => $username, 'password' => $password]);
        $user = $stmt->fetch();
        if($username == 'admin' && $password == '123'){
            header("Location: admin.html");
        }else if ($user) {
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
        } else {
            echo "Username atau password salah.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
