document.addEventListener("DOMContentLoaded", function () {
  const seats = document.querySelectorAll(".seat");
  let selectedSeatInput = document.getElementById("selectedSeat");

  seats.forEach((seat) => {
    seat.addEventListener("click", function () {
      if (!seat.classList.contains("occupied")) {
        seats.forEach((s) => s.classList.remove("selected"));
        seat.classList.add("selected");
        selectedSeatInput.value = seat.dataset.seat;
      }
    });
  });

  // Ambil data kursi yang sudah dipesan dari HTML (diatur di PHP)
  const occupiedSeats = JSON.parse(
    document.getElementById("occupiedSeatsData").value
  );
  occupiedSeats.forEach((seatId) => {
    const seat = document.getElementById(seatId);
    if (seat) {
      seat.classList.add("occupied");
    }
  });
});
