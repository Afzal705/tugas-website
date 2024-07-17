document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('nav ul li');

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('mouseenter', function() {
            this.querySelector('.dropdown').style.display = 'block';
        });

        dropdown.addEventListener('mouseleave', function() {
            this.querySelector('.dropdown').style.display = 'none';
        });
    });
});
