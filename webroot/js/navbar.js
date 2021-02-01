window.addEventListener('DOMContentLoaded', docReady => {
    const navbarToggle = document.querySelector('#navbarToggle');
    const navbarMenu = document.querySelector('#navbarMenu');
    const navbarMenuToggles = document.querySelectorAll('div.navbar-item.has-dropdown > a.navbar-link');

    if (navbarToggle != null && navbarMenu != null) {
        navbarToggle.addEventListener('click', navbarToggleClick => {
            navbarMenu.classList.toggle('is-active');
        });
    }

    navbarMenuToggles.forEach((v, i, o) => {
        v.addEventListener('click', (click) => {
            v.nextElementSibling.classList.toggle('is-hidden-mobile');
        });

        v.nextElementSibling.classList.toggle('is-hidden-mobile');
    });
});
