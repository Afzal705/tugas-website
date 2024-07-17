document.addEventListener("DOMContentLoaded", function () {
  const filmRow = document.getElementById("filmRow");

  fetch("get_films.php")
    .then((response) => response.json())
    .then((films) => {
      for (let i = 0; i < films.length; i += 4) {
        const carouselItemDiv = document.createElement("div");
        carouselItemDiv.classList.add("carousel-item");
        if (i === 0) {
          carouselItemDiv.classList.add("active");
        }

        const rowDiv = document.createElement("div");
        rowDiv.classList.add("row");

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
    })
    .catch((error) => {
      console.error("Error fetching film data:", error);
    });
});
