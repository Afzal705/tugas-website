document.addEventListener("DOMContentLoaded", function () {
  // Array of films (example data)
  const films = [
    {
      id: 1,
      title: "Film 1",
      description: "Deskripsi singkat film 1.",
      image: "img/0dd36c1f-b938-42d9-9806-f86bd9a4c6b8.webp",
    },
    {
      id: 2,
      title: "Film 2",
      description: "Deskripsi singkat film 2.",
      image: "img/010c4dbc-1b66-4f60-b203-6dcd831bd6fc.webp",
    },
    {
      id: 3,
      title: "Film 3",
      description: "Deskripsi singkat film 3.",
      image: "img/137fc190-a739-4826-91ac-afc05f740dbb.webp",
    },
    {
      id: 4,
      title: "Film 4",
      description: "Deskripsi singkat film 4.",
      image: "img/fourth-movie.webp",
    },
    {
      id: 5,
      title: "Film 5",
      description: "Deskripsi singkat film 5.",
      image: "img/fifth-movie.webp",
    },
    {
      id: 6,
      title: "Film 6",
      description: "Deskripsi singkat film 6.",
      image: "img/sixth-movie.webp",
    },
    {
      id: 7,
      title: "Film 7",
      description: "Deskripsi singkat film 7.",
      image: "img/seventh-movie.webp",
    },
    {
      id: 8,
      title: "Film 8",
      description: "Deskripsi singkat film 8.",
      image: "img/eighth-movie.webp",
    },
    {
      id: 9,
      title: "Film 9",
      description: "Deskripsi singkat film 9.",
      image: "img/ninth-movie.webp",
    },
  ];

  const filmRow = document.getElementById("filmRow");

  // Group films in sets of 4
  for (let i = 0; i < films.length; i += 4) {
    const carouselItemDiv = document.createElement("div");
    carouselItemDiv.classList.add("carousel-item");
    if (i === 0) {
      carouselItemDiv.classList.add("active");
    }

    const rowDiv = document.createElement("div");
    rowDiv.classList.add("row");

    // Create card for each film in the group
    for (let j = i; j < i + 4 && j < films.length; j++) {
      const film = films[j];

      const colDiv = document.createElement("div");
      colDiv.classList.add("col-md-3", "mb-4");

      const cardDiv = document.createElement("div");
      cardDiv.classList.add("card", "h-100");

      const imgElement = document.createElement("img");
      imgElement.classList.add("card-img-top");
      imgElement.src = film.image;
      imgElement.alt = film.title;

      const cardBodyDiv = document.createElement("div");
      cardBodyDiv.classList.add("card-body", "d-flex", "flex-column");

      const titleElement = document.createElement("h5");
      titleElement.classList.add("card-title");
      titleElement.textContent = film.title;

      const descElement = document.createElement("p");
      descElement.classList.add("card-text");
      descElement.textContent = film.description;

      const btnElement = document.createElement("a");
      btnElement.classList.add("btn", "btn-primary", "mt-auto");
      btnElement.href = `pesan.php?filmId=${film.id}`;
      btnElement.textContent = "Pesan Tiket";
      btnElement.style.color = "black";

      cardBodyDiv.appendChild(titleElement);
      cardBodyDiv.appendChild(descElement);
      cardBodyDiv.appendChild(btnElement);

      cardDiv.appendChild(imgElement);
      cardDiv.appendChild(cardBodyDiv);

      colDiv.appendChild(cardDiv);

      rowDiv.appendChild(colDiv);
    }

    carouselItemDiv.appendChild(rowDiv);
    filmRow.appendChild(carouselItemDiv);
  }
});
