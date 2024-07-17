<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket Bioskop</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Pemesanan Tiket Bioskop</h1>
        </header>
        <main>
            <div class="film-list">
                <div class="film-item">
                    <img src="img\0dd36c1f-b938-42d9-9806-f86bd9a4c6b8.webp" alt="Film 1">
                    <h2>Film 1</h2>
                </div>
                <div class="film-item">
                    <img src="img\010c4dbc-1b66-4f60-b203-6dcd831bd6fc.webp" alt="Film 2">
                    <h2>Film 2</h2>
                </div>
                <div class="film-item">
                    <img src="img\137fc190-a739-4826-91ac-afc05f740dbb.webp" alt="Film 3">
                    <h2>Film 3</h2>
                </div>
            </div>
            <form action="booking.php" method="POST" class="booking-form">
                <label for="film">Pilih Film:</label>
                <select id="film" name="film">
                    <option value="Film 1">Film 1</option>
                    <option value="Film 2">Film 2</option>
                    <option value="Film 3">Film 3</option>
                </select>
                <label for="jumlah">Jumlah Tiket:</label>
                <input type="number" id="jumlah" name="jumlah" min="1" max="10">
                <button type="submit">Pesan Tiket</button>
            </form>
        </main>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
