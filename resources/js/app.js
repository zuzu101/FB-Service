import.meta.glob([
  '../images/**',
]);

document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementsByClassName('navbar')[0];

    if(!navbar) return;

    const updateNavbar = () => {
        if (window.scrollY > 0) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    }

    updateNavbar();


    window.addEventListener('scroll', updateNavbar)
})
