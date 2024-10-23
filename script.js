document.addEventListener('DOMContentLoaded', function() {
    const burger = document.querySelector('.burger');
    const navLinks = document.querySelector('.nav-links');
    const navItems = document.querySelectorAll('.nav-links ul li a');

    burger.addEventListener('click', function() {
        navLinks.classList.toggle('nav-active');
    });

    navItems.forEach(item => {
        item.addEventListener('click', function() {
            navLinks.classList.remove('nav-active');
        });
    });
});
