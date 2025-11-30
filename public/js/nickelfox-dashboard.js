document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('[data-nf-sidebar]');
    const toggleButtons = document.querySelectorAll('[data-nf-toggle]');

    toggleButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            sidebar?.classList.toggle('nf-sidebar--open');
        });
    });
});

