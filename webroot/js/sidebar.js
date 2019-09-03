window.addEventListener('DOMContentLoaded', docReady => {
    const sidebarToggle = document.querySelector('#sidebar-toggle');
    const sidebarMenu = document.querySelector('#sidebar-menu');

    if (sidebarToggle != null && sidebarMenu != null) {
        sidebarToggle.addEventListener('click', sidebarToggleClick => {
            sidebarMenu.classList.toggle('is-hidden-mobile');
        });
    }
});
