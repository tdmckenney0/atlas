window.addEventListener('DOMContentLoaded', docReady => {
    const nodes = document.querySelectorAll('.menu-tree-toggle');

    nodes.forEach((v, i, o) => {
        const icon = v.querySelector('i.fas');

        v.nextElementSibling.classList.toggle('is-hidden');

        v.addEventListener('click', (click) => {
            // click.preventDefault();
            v.nextElementSibling.classList.toggle('is-hidden');

            if(icon) {
                if (icon.classList.contains('fa-book')) {
                    icon.classList.replace('fa-book', 'fa-book-open');
                } else {
                    icon.classList.replace('fa-book-open', 'fa-book');
                }
            }
        });
    });
});