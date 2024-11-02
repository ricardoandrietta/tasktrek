(function (window, document, $, undefined) {
  "use strict";

  var chatenaiJs = {
    i: function (e) {
      chatenaiJs.d();
      chatenaiJs.methods();
    },

    d: function (e) {
      (this._window = $(window)),
        (this._document = $(document)),
        (this._body = $("body")),
        (this._html = $("html"));
    },

    methods: function (e) {
      chatenaiJs.slickSliderActivation();
    },


    slickSliderActivation: function () {
    //   $(".testimonial-activation").not(".slick-initialized").slick({
    //     infinite: true,
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots: true,
    //     arrows: true,
    //     adaptiveHeight: true,
    //     cssEase: "linear",
    //     prevArrow:
    //       '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
    //     nextArrow:
    //       '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
    //   });

      $(".sm-slider-carosel-activation").not(".slick-initialized").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true,
        cssEase: "linear",
        rtl: true,
      });

    //   $(".slider-activation").not(".slick-initialized").slick({
    //     infinite: true,
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots: true,
    //     arrows: true,
    //     adaptiveHeight: true,
    //     cssEase: "linear",
    //     prevArrow:
    //       '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
    //     nextArrow:
    //       '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
    //   });

    //   $(".blog-carousel-activation")
    //     .not(".slick-initialized")
    //     .slick({
    //       infinite: true,
    //       slidesToShow: 3,
    //       slidesToScroll: 1,
    //       dots: true,
    //       arrows: false,
    //       adaptiveHeight: true,
    //       cssEase: "linear",
    //       responsive: [
    //         {
    //           breakpoint: 769,
    //           settings: {
    //             slidesToShow: 2,
    //             slidesToScroll: 2,
    //           },
    //         },
    //         {
    //           breakpoint: 581,
    //           settings: {
    //             slidesToShow: 1,
    //             slidesToScroll: 1,
    //           },
    //         },
    //       ],
    //     });

    //   $(".brand-carousel-activation")
    //     .not(".slick-initialized")
    //     .slick({
    //       infinite: true,
    //       slidesToShow: 6,
    //       slidesToScroll: 1,
    //       dots: true,
    //       arrows: true,
    //       adaptiveHeight: true,
    //       cssEase: "linear",
    //       prevArrow:
    //         '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
    //       nextArrow:
    //         '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
    //       responsive: [
    //         {
    //           breakpoint: 769,
    //           settings: {
    //             slidesToShow: 4,
    //             slidesToScroll: 2,
    //           },
    //         },
    //         {
    //           breakpoint: 581,
    //           settings: {
    //             slidesToShow: 3,
    //           },
    //         },
    //         {
    //           breakpoint: 480,
    //           settings: {
    //             slidesToShow: 2,
    //           },
    //         },
    //       ],
    //     });

    //   $(".banner-imgview-carousel-activation")
    //     .not(".slick-initialized")
    //     .slick({
    //       infinite: true,
    //       slidesToShow: 5,
    //       slidesToScroll: 1,
    //       dots: false,
    //       autoplay: true,
    //       arrows: false,
    //       adaptiveHeight: true,
    //       centerMode: true,
    //       centerPadding: "100px",
    //       cssEase: "linear",
    //       prevArrow:
    //         '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
    //       nextArrow:
    //         '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
    //       responsive: [
    //         {
    //           breakpoint: 769,
    //           settings: {
    //             slidesToShow: 3,
    //             slidesToScroll: 2,
    //           },
    //         },
    //         {
    //           breakpoint: 581,
    //           settings: {
    //             slidesToShow: 3,
    //           },
    //         },
    //         {
    //           breakpoint: 480,
    //           settings: {
    //             slidesToShow: 2,
    //           },
    //         },
    //       ],
    //     });

    //   $(".vedio-popup-carousel-activation")
    //     .not(".slick-initialized")
    //     .slick({
    //       infinite: true,
    //       slidesToShow: 1,
    //       slidesToScroll: 1,
    //       dots: false,
    //       autoplay: false,
    //       arrows: false,
    //       adaptiveHeight: true,
    //       centerMode: true,
    //       centerPadding: "200px",
    //       cssEase: "linear",
    //       prevArrow:
    //         '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
    //       nextArrow:
    //         '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
    //       responsive: [
    //         {
    //           breakpoint: 769,
    //           settings: {
    //             slidesToShow: 2,
    //             slidesToScroll: 1,
    //           },
    //         },
    //         {
    //           breakpoint: 581,
    //           settings: {
    //             slidesToShow: 2,
    //           },
    //         },
    //         {
    //           breakpoint: 480,
    //           settings: {
    //             slidesToShow: 2,
    //           },
    //         },
    //       ],
    //     });

    //   $(".brand-carousel-init")
    //     .not(".slick-initialized")
    //     .slick({
    //       infinite: true,
    //       slidesToShow: 5,
    //       slidesToScroll: 1,
    //       dots: false,
    //       arrows: true,
    //       adaptiveHeight: true,
    //       cssEase: "linear",
    //       prevArrow:
    //         '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
    //       nextArrow:
    //         '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
    //       responsive: [
    //         {
    //           breakpoint: 769,
    //           settings: {
    //             slidesToShow: 4,
    //             slidesToScroll: 2,
    //           },
    //         },
    //         {
    //           breakpoint: 581,
    //           settings: {
    //             slidesToShow: 3,
    //           },
    //         },
    //         {
    //           breakpoint: 480,
    //           settings: {
    //             slidesToShow: 2,
    //           },
    //         },
    //       ],
    //     });

    //   $(".about-app-activation").not(".slick-initialized").slick({
    //     infinite: true,
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots: true,
    //     arrows: false,
    //     adaptiveHeight: true,
    //     cssEase: "linear",
    //     prevArrow:
    //       '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
    //     nextArrow:
    //       '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
    //   });

    //   $(".template-galary-activation")
    //     .not(".slick-initialized")
    //     .slick({
    //       infinite: true,
    //       slidesToShow: 3,
    //       slidesToScroll: 1,
    //       dots: true,
    //       arrows: true,
    //       adaptiveHeight: true,
    //       cssEase: "linear",
    //       centerMode: false,
    //       prevArrow:
    //         '<button class="slide-arrow prev-arrow"><i class="feather-arrow-left"></i></button>',
    //       nextArrow:
    //         '<button class="slide-arrow next-arrow"><i class="feather-arrow-right"></i></button>',
    //       responsive: [
    //         {
    //           breakpoint: 769,
    //           settings: {
    //             slidesToShow: 4,
    //             slidesToScroll: 2,
    //           },
    //         },
    //         {
    //           breakpoint: 581,
    //           settings: {
    //             slidesToShow: 3,
    //           },
    //         },
    //         {
    //           breakpoint: 480,
    //           settings: {
    //             slidesToShow: 2,
    //           },
    //         },
    //       ],
    //     });
    },
  };
  chatenaiJs.i();
})(window, document, jQuery);