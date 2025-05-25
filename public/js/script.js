// wow js
new WOW().init()

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


if (document.querySelector('.constructor__items')) {
    const swiperComments = new Swiper('.constructor__items', {
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },

        navigation: {
            nextEl: '.btn-next',
            prevEl: '.btn-prev',
        },

        slidesPerView: 1,
        spaceBetween: 15,

        slidesPerView: 1.2,
        slidesPerGroup: 1,

        breakpoints: {
            991: {
                slidesPerView: 2.3,
                slidesPerGroup: 1,
                spaceBetween: 30,
            },
            468: {
                slidesPerView: 1.5,
                slidesPerGroup: 1,
            }
        }
    });
}