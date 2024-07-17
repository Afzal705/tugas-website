document.addEventListener('DOMContentLoaded', function() {
    // Get the modal
    var modal = document.getElementById("addModal");

    // Get the button that opens the modal
    var btn = document.querySelector(".create");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Fetch film data and populate the table
    fetch('manage_movie.php')
        .then(response => response.json())
        .then(films => {
            const tableBody = document.getElementById('film-table-body');
            films.forEach(film => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${film.title}</td>
                    <td>${film.genre}</td>
                    <td>${film.durasi}</td>
                    <td>${film.tanggal_rilis}</td>
                    <td>${film.description}</td>
                    <td><img src="${film.image}" alt="${film.title}" style="width: 100px;"></td>
                    <td><a href="${film.trailer_url}" target="_blank">Trailer</a></td>
                    <td class="icons">
                        <i class="fas fa-pencil-alt edit-icon" data-id="${film.id}"></i>
                        <i class="fas fa-trash delete-icon" data-id="${film.id}"></i>
                    </td>
                `;
                tableBody.appendChild(row);
            });

            // Add event listeners to delete icons
            document.querySelectorAll('.delete-icon').forEach(icon => {
                icon.addEventListener('click', function() {
                    const filmId = this.getAttribute('data-id');
                    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                        deleteFilm(filmId);
                    }
                });
            });

            // Add event listeners to edit icons
            document.querySelectorAll('.edit-icon').forEach(icon => {
                icon.addEventListener('click', function() {
                    const filmId = this.getAttribute('data-id');
                    // Implement edit functionality here
                    alert('Edit film ID: ' + filmId);
                });
            });
        })
        .catch(error => console.error('Error fetching film data:', error));

    // Function to delete a film
    function deleteFilm(filmId) {
        fetch('delete_movie.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: filmId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data berhasil dihapus');
                location.reload();
            } else {
                alert('Terjadi kesalahan saat menghapus data');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Handle form submission
    document.getElementById('addFilmForm').onsubmit = function(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        fetch('add_movie.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Data berhasil ditambahkan');
                modal.style.display = "none";
                // Optionally, refresh the table data
                location.reload();
            } else {
                alert('Terjadi kesalahan saat menambahkan data: ' + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    };

    // Optional: Preview image before upload
    document.getElementById('image').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = document.createElement('img');
            preview.src = URL.createObjectURL(file);
            preview.style.width = '100px';
            document.querySelector('.modal-content').appendChild(preview);
        }
    });
});
