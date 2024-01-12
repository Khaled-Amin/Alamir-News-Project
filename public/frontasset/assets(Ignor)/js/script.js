'use strict';

/**
 * add event on element
 */

const addEventOnElem = function (elem, type, callback) {
  if (elem.length > 1) {
    for (let i = 0; i < elem.length; i++) {
      elem[i].addEventListener(type, callback);
    }
  } else {
    elem.addEventListener(type, callback);
  }
}



/**
 * toggle navbar
 */

const navbar = document.querySelector("[data-navbar]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");
const navToggler = document.querySelector("[data-nav-toggler]");

const toggleNavbar = function () {
  navbar.classList.toggle("active");
  navToggler.classList.toggle("active");
}

addEventOnElem(navToggler, "click", toggleNavbar);

const closeNavbar = function () {
  navbar.classList.remove("active");
  navToggler.classList.remove("active");
}

addEventOnElem(navbarLinks, "click", closeNavbar);



/**
 * header active
 */

const header = document.querySelector("[data-header]");
const backTopBtn = document.querySelector("[data-back-top-btn]");

window.addEventListener("scroll", function () {
  if (window.scrollY > 100) {
    header.classList.add("active");
    backTopBtn.classList.add("active");
  } else {
    header.classList.remove("active");
    backTopBtn.classList.remove("active");
  }
});


// text typing animations

document.addEventListener('DOMContentLoaded', function () {
  var typing = new Typed(".text", {
      strings: ["", "Information Technology."],
      typeSpeed: 120,
      backSpeed: 50,
      loop: true,
  });
});
var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: false,
    dots: false,
    freeMode: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      // when window width is <= 320px
      320: {
        slidesPerView: 1,
        spaceBetween: 10
      },
      // when window width is <= 768px
      768: {
        slidesPerView: 2,
        spaceBetween: 20
      },
      // when window width is <= 992px
      992: {
        slidesPerView: 3,
        spaceBetween: 30
      }
      // Add more breakpoints as needed
    }
  });

// Clients

var swiper = new Swiper(".modiSwipper", {
  slidesPerView: 4,
  spaceBetween: 30,
  autoplay: true,
  Infinity:true,
  autoplaySpeed: 1500,
  arrows: false,
  dots: false,
  freeMode: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    // when window width is <= 320px
    320: {
      slidesPerView: 1,
      spaceBetween: 10
    },
    // when window width is <= 768px
    768: {
      slidesPerView: 2,
      spaceBetween: 20
    },
    // when window width is <= 992px
    992: {
      slidesPerView: 4,
      spaceBetween: 30
    }
    // Add more breakpoints as needed
  }
});

 /**
   * Initiate Pure Counter
   */
  // Initialize Purecounter
  var counters = document.querySelectorAll('.purecounter');

  counters.forEach(function(counter) {
    var start = parseInt(counter.getAttribute('data-purecounter-start'));
    var end = parseInt(counter.getAttribute('data-purecounter-end'));
    var duration = parseFloat(counter.getAttribute('data-purecounter-duration'));

    var range = end - start;
    var increment = end > start ? 1 : -1;
    var step = Math.abs(Math.floor(duration * 1000 / range));

    var timer = setInterval(function() {
      start += increment;
      counter.textContent = start;

      if (start == end) {
        clearInterval(timer);
      }
    }, step);
  });





