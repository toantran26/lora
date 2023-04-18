$(document).ready(function() {
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 15,
        responsiveClass: true,
        nav:true,
        navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fas fa-chevron-circle-right'></i>"],
        responsive: {
            0: {
                items: 2,
                nav: true,
                margin:15
            },
            600: {
                items: 3,
                nav: false,
                margin:15
            },
            1000: {
                items: 4,
                nav: true,
                loop: true,
                margin: 20
            }
        }
    })
})
