<?php
header('Content-Type: application/json');

$response = ['success' => false];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $id = $data['id'];

        // Koneksi ke database
        $conn = new mysqli('localhost', 'root', '', 'bioskop');

        // Periksa koneksi
        if ($conn->connect_error) {
            $response['message'] = 'Database connection failed: ' . $conn->connect_error;
            echo json_encode($response);
            exit();
        }

        // Query untuk menghapus data
        $sql = "DELETE FROM films WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            $response['success'] = true;
        } else {
            $response['message'] = 'Error: ' . $sql . '<br>' . $conn->error;
        }

        $conn->close();
    } else {
        $response['message'] = 'Invalid data.';
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>
