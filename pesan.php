<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

include 'koneksi.php';

// Ambil data film dari database berdasarkan filmId yang diterima dari URL
if (isset($_GET['filmId'])) {
    $filmId = $_GET['filmId'];
    $stmt = $pdo->prepare("SELECT * FROM films WHERE id = ?");
    $stmt->execute([$filmId]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($film) {
        $filmTitle = htmlspecialchars($film['title']);
        $filmDescription = htmlspecialchars($film['description']);
        $filmImage = htmlspecialchars($film['image']);
        $filmDurasi = htmlspecialchars($film['durasi']);
        $filmTrailer = htmlspecialchars($film['trailer_url'])
        

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Tiket untuk <?= $filmTitle ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style_pesan.css">
    <style>
        body {
            background-image: url('img/background1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 989px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .film-info {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .film-image {
            width: 250px;
            height: auto;
            margin-right: 4%;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .film-details {
            flex: 1;
            margin-left: 20px;
        }
        .film-details p {
            font-size: 18px;
            line-height: 1.6;
            margin-right: 10%;
            word-wrap: break-word;
        }
        .button-trailer {
        display: flex;
        align-items: center;
        margin-top:28%;
        }
        .button-trailer h5 {
        font-weight:bold;
        }
        .play-button {
            display: inline-block;
            width: 50px; /* Sesuaikan ukuran gambar play-button.png */
            height: 50px; /* Sesuaikan ukuran gambar play-button.png */
            background-color: transparent;
            border: none;
            cursor: pointer;
            margin-right: 10px; 
        }

        .play-button img {
            width: 100%;
            height: auto;
            margin-top:-10%;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            color: #fff;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        }
        .seat-container {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .seat-row {
            display: flex;
            margin-bottom: 5px;
        }
        .seat {
            width: 40px;
            height: 30px;
            line-height: 50px;
            text-align: center;
            border: 1px solid #ccc;
            margin: 5px;
            cursor: pointer;
            font-size: 14px;
            transform: skewX(-10deg);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .occupied {
            background-color: #ff8080;
            color: #fff;
        }
        .selected {
            background-color: #40bf80;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="film-info">
            <img src="<?= $filmImage ?>" alt="<?= $filmTitle ?>" class="film-image">
            <div class="film-details">
                <h2><?= $filmTitle ?></h2>
                <p><?= $filmDescription ?></p>
                <div class="button-trailer">
                    <a href="<?= $filmTrailer ?>" target="_blank" class="play-button">
                        <img src="img\play-button.png" alt="Play Trailer">
                    </a>
                    <h5>TONTON TRAILER |  </h5>
                    <h5> <?= $filmDurasi ?></h5>
                </div>
            </div>
        </div>
        <form id="orderForm" action="proses_pesan.php" method="post">
            <div class="form-group">
                <label for="nama">Nama Pemesan</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="seat-container">
                <?php
                $occupiedSeatsStmt = $pdo->prepare("SELECT seat FROM orders WHERE film_id = ?");
                $occupiedSeatsStmt->execute([$filmId]);
                $occupiedSeats = $occupiedSeatsStmt->fetchAll(PDO::FETCH_COLUMN);

                $rows = ['A', 'B', 'C', 'D'];
                $cols = 10;
                foreach ($rows as $row) {
                    echo "<div class='seat-row'>";
                    for ($col = 1; $col <= $cols; $col++) {
                        $seat = $row . $col;
                        $class = in_array($seat, $occupiedSeats) ? 'seat occupied' : 'seat';
                        echo "<div class='$class' id='$seat' data-seat='$seat'>$seat</div>";
                    }
                    echo "</div>";
                }
                ?>
            </div>
            <input type="hidden" name="selectedSeat" id="selectedSeat">
            <input type="hidden" name="filmId" value="<?= $filmId ?>">
            
            <button type="submit" class="btn btn-primary mt-3">Pesan Tiket</button>
        </form>
    </div>

    <script src="js/seat_selection.js"></script>
</body>
</html>
<?php
    } else {
        echo "<p>Film tidak ditemukan.</p>";
    }
} else {
    echo "<p>Film tidak ditemukan.</p>";
}
?>
    