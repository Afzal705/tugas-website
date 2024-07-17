<?php
header('Content-Type: application/json');

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dapatkan data dari form
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $durasi = $_POST['durasi'];
    $tanggal_rilis = $_POST['tanggal_rilis'];
    $description = $_POST['description'];
    $trailer_url = $_POST['trailer'];

    // Unggah gambar
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $uploadDir = 'img/'; // Menggunakan direktori 'image'
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmpPath, $imagePath)) {
            // Koneksi ke database
            $conn = new mysqli('localhost', 'root', '', 'bioskop');

            // Periksa koneksi
            if ($conn->connect_error) {
                $response['message'] = 'Database connection failed: ' . $conn->connect_error;
                echo json_encode($response);
                exit();
            }

            // Query untuk memasukkan data baru
            $sql = "INSERT INTO films (title, genre, durasi, tanggal_rilis, description, image, trailer_url) VALUES ('$title', '$genre', '$durasi', '$tanggal_rilis', '$description', '$imagePath', '$trailer_url')";

            if ($conn->query($sql) === TRUE) {
                $response['success'] = true;
            } else {
                $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
            }

            $conn->close();
        } else {
            $response['message'] = 'Failed to move uploaded file.';
        }
    } else {
        $response['message'] = 'No file uploaded or file upload error.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
