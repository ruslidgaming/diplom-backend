// МЕНЮ
const navOpen = document.querySelector('.nav__open');
const navClose = document.querySelector('.nav__close');
const navMenu = document.querySelector('.nav__panel');

if (navOpen) {
    navOpen.addEventListener('click', function () {
        navMenu.classList.toggle('nav__pannel-active');
    });
}

if (navClose) {
    navClose.addEventListener('click', function () {
        navMenu.classList.toggle('nav__pannel-active');
    });
}
