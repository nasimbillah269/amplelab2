$(document).ready(function () {
    $('.prod-line-slider').slick({
        centerMode: true,
        centerPadding: '0px',
        slidesToShow: 3,
        arrows: true,
        prevArrow: '<button type="button" class="prod-slider-btn prev"><i class="fa-solid fa-angle-left"></i></button>',
        nextArrow: '<button type="button" class="prod-slider-btn next"><i class="fa-solid fa-angle-right"></i></button>',
        infinite: true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.testimonials-slider').slick({
        centerMode: true,
        centerPadding: '0px',
        slidesToShow: 3,
        arrows: true,
        prevArrow: '<button type="button" class="testi-slider-arrow prev"><i class="fa-solid fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="testi-slider-arrow next"><i class="fa-solid fa-chevron-right"></i></button>',
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 768,
                settings: {
                    arrows: true,
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 1
                }
            }
        ]
    });

    $('.brands-slider').slick({
        centerMode: true,
        centerPadding: '0px',
        slidesToShow: 5,
        arrows: true,
        prevArrow: '<button type="button" class="brands-slider-arrow prev"><i class="fa-solid fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="brands-slider-arrow next"><i class="fa-solid fa-chevron-right"></i></button>',
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    centerMode: true,
                    centerPadding: '0px'
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3,
                    centerMode: true,
                    centerPadding: '0px',
                    arrows: false
                }
            }
        ]
    });
});
