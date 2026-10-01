'use strict';

/* ─────────────────────────────────────────────
   Turbo Drive remplace le <body> sans recharger la page : "load" ne se
   déclenche donc qu'une fois. "turbo:load" se déclenche au chargement
   initial ET après chaque navigation Turbo, on ré-exécute tout ici.
───────────────────────────────────────────── */
document.addEventListener('turbo:load', function () {
    _hidePreloader();
    _initStickyNavbar();
    _initFullHeightSections();
    _initStatCounters();
    _initTooltips();
    _initCoursesSwiper();
});

/* ─────────────────────────────────────────────
   Loader
───────────────────────────────────────────── */
function _hidePreloader() {
    var preloader = document.getElementById('preloader');
    if (!preloader) {
        _initAOS();
        return;
    }
    setTimeout(function () {
        preloader.style.transition = 'opacity 0.5s ease';
        preloader.style.opacity = '0';
    }, 300);
    setTimeout(function () {
        preloader.style.display = 'none';
        _initAOS(); // AOS init après suppression du preloader
    }, 850);
}

/* ─────────────────────────────────────────────
   Navbar sticky (remplace jQuery affix BS3)
───────────────────────────────────────────── */
function _initStickyNavbar() {
    var header = document.querySelector('.header');
    if (!header) return;

    function onScroll() {
        if (window.scrollY > 100) {
            header.classList.add('affix');
        } else {
            header.classList.remove('affix');
        }
    }
    // Affectation directe (et non addEventListener) pour remplacer le
    // gestionnaire précédent au lieu de l'empiler à chaque navigation Turbo.
    window.onscroll = onScroll;
    onScroll();
}

/* ─────────────────────────────────────────────
   Sections pleine hauteur
───────────────────────────────────────────── */
function _initFullHeightSections() {
    function setHeights() {
        document.querySelectorAll('.js-height-full').forEach(function (el) {
            el.style.height = window.innerHeight + 'px';
        });
        document.querySelectorAll('.js-height-parent').forEach(function (el) {
            el.style.height = (el.parentElement ? el.parentElement.offsetHeight : 0) + 'px';
        });
    }
    setHeights();
    window.onresize = setHeights;
}

/* ─────────────────────────────────────────────
   Compteur de statistiques (stat-timer)
───────────────────────────────────────────── */
function _initStatCounters() {
    document.querySelectorAll('.stat-timer').forEach(function (el) {
        var target = parseInt(el.textContent.trim(), 10);
        if (isNaN(target)) return;
        el.textContent = '0';
        var step = Math.max(1, Math.ceil(target / 60));
        var current = 0;
        var interval = setInterval(function () {
            current += step;
            if (current >= target) {
                current = target;
                clearInterval(interval);
            }
            el.textContent = current;
        }, 25);
    });
}

/* ─────────────────────────────────────────────
   Bootstrap 5 Tooltips
───────────────────────────────────────────── */
function _initTooltips() {
    if (typeof bootstrap === 'undefined') return;
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function (el) {
        new bootstrap.Tooltip(el);
    });
}

/* ─────────────────────────────────────────────
   Swiper (carousel de cours — index uniquement)
───────────────────────────────────────────── */
var _coursesSwiper = null;
function _initCoursesSwiper() {
    var el = document.querySelector('.swiper-courses');
    if (!el || typeof Swiper === 'undefined') return;
    // Turbo remplace le DOM à chaque navigation : détruire l'instance
    // précédente évite de laisser tourner un autoplay sur un nœud détaché.
    if (_coursesSwiper) {
        _coursesSwiper.destroy(true, true);
        _coursesSwiper = null;
    }
    _coursesSwiper = new Swiper(el, {
        loop: true,
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        breakpoints: {
            0: { slidesPerView: 1 },
            576: { slidesPerView: 2 },
            992: { slidesPerView: 3 },
        },
    });
}

/* ─────────────────────────────────────────────
   AOS (Animate On Scroll) — initialisé après le preloader
───────────────────────────────────────────── */
function _initAOS() {
    if (typeof AOS === 'undefined') return;
    AOS.init({
        once: true,
        duration: 800,
        offset: 80,
        easing: 'ease-out-cubic',
    });
}
