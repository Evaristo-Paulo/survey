/* HANDLE ANIMATION BANNER  */
var bannercarrossel = document.querySelectorAll('#banner-carrossel li');
if (bannercarrossel.length > 0) {
    var current = 1;
    setInterval(function () {
        for (let i = 0; i < bannercarrossel.length; i++) {
            bannercarrossel[i].classList.remove('active-carrossel');
        }
        bannercarrossel[current].classList.add('active-carrossel');

        current++
        if (current >= bannercarrossel.length) {
            current = 0;
        }
    }, 5000);
}

/* HANDLE VOTE OPTION */
var radioInput = document.querySelectorAll('.radio input');
if (radioInput) {
    for (let i = 0; i < radioInput.length; i++) {
        radioInput[i].addEventListener('change', (e) => {
            var form = document.querySelector('#vote-form')
            form.submit()
        })
    }
}


/* HANDLE PROGRESS BAR */
const progressBarInners = document.querySelectorAll('#options .inner');
if (progressBarInners) {
    for (let i = 0; i < progressBarInners.length; i++) {
        progressBarInners[i].style.width = progressBarInners[i].dataset.vote + '%'
    }
}


/* HANDLE ADD OPTIONS */
$(document).ready(function () {
    $("#addOption").click(function () {
        let fieldsets = document.querySelector('#form-group-fieldset');
        let contInputs = document.querySelectorAll('#form-group-fieldset input');
        if (contInputs.length < 10) {
            let input = $("<input type=\"text\" name=\"options[]\" placeholder=\"" + (contInputs.length + 1) + "ª Alternativa  \" />");
            let div = $('<div class="form-group"></div>');
            div.append(input);
            $("#form-group-fieldset").append(div);
        }
    });
});

/* HANDLE MODAL */
const modalCloseButtom = document.querySelectorAll('.modal-close');
const modalBody = document.querySelectorAll('.modal-body');
const modal = document.querySelector('.modal');

if (modalCloseButtom) {
    for (let i = 0; i < modalCloseButtom.length; i++) {
        modalCloseButtom[i].addEventListener('click', (e) => {
            for (let ii = 0; ii < modalBody.length; ii++) {
                modalBody[ii].style.display = 'none'
            }
            modal.style.display = 'none'
        })
    }
}

/* HANDLE MENU MOBILE */
let menuMobileButton = document.querySelector('#menu-mobile');
let menuMobileModal = document.querySelector('#menu-mobile-modal');

if (menuMobileButton) {
    menuMobileButton.addEventListener('click', () => {
        modal.style.display = 'flex'
        menuMobileModal.style.display = 'grid'
    })
}


/* HANDLE ANOUCEMENT SIGNIN */
let anoucementSigninButton = document.querySelectorAll('.anoucement-signin-button');
let anoucementSigninModal = document.querySelector('#anoucement-signin-modal');

if (anoucementSigninButton) {
    for (let i = 0; i < anoucementSigninButton.length; i++) {
        anoucementSigninButton[i].addEventListener('click', (e) => {
            for (let ii = 0; ii < modalBody.length; ii++) {
                modalBody[ii].style.display = 'none'
            }
            modal.style.display = 'flex'
            anoucementSigninModal.style.display = 'grid'
        })
    }
}

/* HANDLE ANOUCEMENT SIGNUP */
let anoucementSignupButton = document.querySelectorAll('.anoucement-signup-button');
let anoucementSignupModal = document.querySelector('#anoucement-signup-modal');

if (anoucementSignupButton) {
    for (let i = 0; i < anoucementSignupButton.length; i++) {
        anoucementSignupButton[i].addEventListener('click', (e) => {
            for (let ii = 0; ii < modalBody.length; ii++) {
                modalBody[ii].style.display = 'none'
            }
            modal.style.display = 'flex'
            anoucementSignupModal.style.display = 'grid'
        })
    }
}



let liHighLight = document.querySelector('#create-anoucement .highlight');
let authenticate = document.querySelector('#authenticate');

if (liHighLight && authenticate) {
    /* MOUSE OVER */
    liHighLight.addEventListener('mouseover', e => {
        authenticate.style.display = 'block'
    })
    /* MOUSE OUT*/
    liHighLight.addEventListener('mouseout', e => {
        let liNavItemMain = document.querySelector('.nav-item-main');
        liNavItemMain.addEventListener('mouseover', e => {
            if (authenticate && authenticate.style.display == 'block')
                authenticate.style.display = 'none'
        })
    })
    /* CLICK */
    liHighLight.addEventListener('click', e => {
        authenticate.style.display = 'block'
    })

    document.addEventListener('mouseup', e => {
        if (authenticate.style.display == 'block')
            authenticate.style.display = 'none'
    })
}

let year = document.querySelector('#year');

if (year) {
    year.innerHTML = new Date().getFullYear();
}

/* SMOOTH LINK REFERENCE */
$(document).ready(function () {
    // Add smooth scrolling to all links
    $("a").on('click', function (event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 3000, function () {

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        } // End if
    });
});

let goUp = document.querySelector('#go-up');

/* SCROLL EVENT */
window.onscroll = function () {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        goUp.style.display = "flex";
    } else {
        goUp.style.display = "none";
    }
}

if (goUp) {
    goUp.addEventListener('click', () => {
        goTop();
    })
}


/* HANDLE TOP EVENT */
const goTop = () => {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    // HANDLE LAZY LOAD 
    ! function (window) {
        var $q = function (q, res) {
                if (document.querySelectorAll) {
                    res = document.querySelectorAll(q);
                } else {
                    var d = document,
                        a = d.styleSheets[0] || d.createStyleSheet();
                    a.addRule(q, 'f:b');
                    for (var l = d.all, b = 0, c = [], f = l.length; b < f; b++)
                        l[b].currentStyle.f && c.push(l[b]);

                    a.removeRule(0);
                    res = c;
                }
                return res;
            },
            addEventListener = function (evt, fn) {
                window.addEventListener ?
                    this.addEventListener(evt, fn, false) :
                    (window.attachEvent) ?
                    this.attachEvent('on' + evt, fn) :
                    this['on' + evt] = fn;
            },
            _has = function (obj, key) {
                return Object.prototype.hasOwnProperty.call(obj, key);
            };

        function loadImage(el, fn) {
            var img = new Image(),
                src = el.getAttribute('data-src');
            img.onload = function () {
                if (!!el.parent)
                    el.parent.replaceChild(img, el)
                else
                    el.src = src;

                fn ? fn() : null;
            }
            img.src = src;
        }

        function elementInViewport(el) {
            var rect = el.getBoundingClientRect()

            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.top <= (window.innerHeight || document.documentElement.clientHeight)
            )
        }

        var images = new Array(),
            query = $q('img.lazy'),
            processScroll = function () {
                for (var i = 0; i < images.length; i++) {
                    if (elementInViewport(images[i])) {
                        loadImage(images[i], function () {
                            images.splice(i, i);
                        });
                    }
                };
            };
        // Array.prototype.slice.call is not callable under our lovely IE8 
        for (var i = 0; i < query.length; i++) {
            images.push(query[i]);
        };

        processScroll();
        addEventListener('scroll', processScroll);

    }(this);



/* ADD PLUGIN CODE */

!(function ($) {
    "use strict";

    // Init AOS
    function aos_init() {
        AOS.init({
            duration: 1000,
            easing: "ease-in-out",
            once: true,
            mirror: false
        });
    }
    $(window).on('load', function () {
        aos_init();
    });

})(jQuery);
