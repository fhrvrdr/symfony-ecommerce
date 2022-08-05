jQuery(document).ready(function () {
    (function ($) {

        'use strict';
        /*----------  Mean Menu   ----------*/
        jQuery('.mean-active').meanmenu({
            meanScreenWidth: "991",
            meanMenuContainer: '.mean-wrapper',
        });


        /*----------  Home Page Main Slider   ----------*/
        var homeSlider = $('.hero-slider-wrapper');
        homeSlider.on('init', function (e, slick) {
            var $firstAnimatingElements = $('div.single-slide').find('[data-animation]');
            doAnimations($firstAnimatingElements);
        });
        homeSlider.slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2500,
            cssEase: 'linear',
            speed: 500,
            nextArrow: '<button type="button" class="slick-next btn-reset"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev btn-reset"><i class="fas fa-chevron-left"></i></button>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows:false,
                        autoplay: true
                    }
                },

                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
        homeSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
            var $animatingElements = $('div.single-slide[data-slick-index="' + nextSlide + '"]')
                .find('[data-animation]');
            doAnimations($animatingElements);
        });
        function doAnimations(elements) {
            var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
            elements.each(function () {
                var $this = $(this);
                var $animationDelay = $this.data('delay');
                var $animationDuration = $this.data('duration');
                var $animationType = 'animated ' + $this.data('animation');
                $this.css({
                    'animation-delay': $animationDelay,
                    'animation-duration': $animationDuration,
                });
                $this.addClass($animationType).one(animationEndEvents, function () {
                    $this.removeClass($animationType);
                });
            });
        }
        /*----------  Dropdown Slide Down Effect  ----------*/

        $(".slide-down--btn").on('click', function (e) {
            e.stopPropagation();
            $(this).siblings('.slide-down--item').slideToggle("400");
            $(this).siblings('.slide-down--item').toggleClass("show");
            var $selectClass = $(this).parents('.single-option').siblings().children('.slide-down--item');
            $(this).parents('.single-option').siblings().children('.slide-down--item').slideUp('400');
        })
        /*----------  Slideup While clicking On Dom  ----------*/
        function clickDom() {
            $('body').on('click', function (e) {
                $('.slide-down--item').slideUp('500');
            });
            $('.slide-down--item').on('click', function (e) {
                e.stopPropagation();
            })
        };

        clickDom();

        /*----------  Product Slider   ----------*/
        $('.product-slider').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 1400,
            cssEase: 'linear',
            speed: 500,
            autoplay: false,
            dots: false,
            nextArrow: '<button type="button" class="slick-next btn-reset"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev btn-reset"><i class="fas fa-chevron-left"></i></button>',
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },

                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
        /*----------  Product Slider 2  ----------*/
        $('.product-slider-2').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: true,
            autoplaySpeed: 1400,
            cssEase: 'linear',
            rows:2,
            // slidesPerRow:4,
            speed: 500,
            autoplay: false,
            dots: false,
            nextArrow: '<button type="button" class="slick-next btn-reset"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev btn-reset"><i class="fas fa-chevron-left"></i></button>',
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        row:1,
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        row:1,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },

                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
        /*----------  Blog Details Image Slider  ----------*/
        $('.blog-image-slider').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1400,
            cssEase: 'linear',
            speed: 500,
            autoplay: false,
            dots: false,
            nextArrow: '<button type="button" class="slick-next btn-reset"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev btn-reset"><i class="fas fa-chevron-left"></i></button>'

        });
        /*----------  TTestimonial Slider  ----------*/
        $('.testimonial-slider').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplay: true,
            arrows: false,
            dots: true,
            cssEase: 'linear',
            speed: 500,
        });
        /*----------  Blog Slider  ----------*/
        $('.mini-blog-slider').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: false,
            autoplaySpeed: 1400,
            nextArrow: '<button type="button" class="slick-next btn-reset"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev btn-reset"><i class="fas fa-chevron-left"></i></button>',
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },

                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });


        /*----------  Sticky Header  ----------*/
        function stickyHeader() {

            $(window).on({
                resize: function () {
                    var width = $(window).width();
                    if ((width <= 991)) {
                        $('.sticky-init').removeClass('fixed-header');
                        if ($('.sticky-init').hasClass('sticky-header')) {
                            $('.sticky-init').removeClass('sticky-header');
                        }
                        console.log(width);
                    } else {
                        $('.sticky-init').addClass('fixed-header');
                    }
                },
                load: function () {
                    var width = $(window).width();
                    if ((width <= 991)) {
                        $('.sticky-init').removeClass('fixed-header');
                        if ($('.sticky-init').hasClass('sticky-header')) {
                            $('.sticky-init').removeClass('sticky-header');
                        }
                        console.log(width);
                    } else {
                        $('.sticky-init').addClass('fixed-header');
                    }
                }
            });
            $(window).on('scroll', function () {
                var headerHeight = $('.site-header')[0].getBoundingClientRect().height;
                if ($(window).scrollTop() >= headerHeight) {
                    $('.fixed-header').addClass('sticky-header');
                }
                else {
                    $('.fixed-header').removeClass('sticky-header');
                }
            });
        }
        stickyHeader()

        /*----------  Range Slider  ----------*/
        $(function () {
            $(".belly-range-slider").slider({
                range: true,
                min: 0,
                max: 500,
                values: [80, 320],
                slide: function (event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });
            $("#amount").val("$" + $(".belly-range-slider").slider("values", 0) +
                " - $" + $(".belly-range-slider").slider("values", 1));
        });


        $('.product-view-mode a').on('click', function (e) {
            e.preventDefault();

            var shopProductWrap = $('.shop-product-wrap');
            var viewMode = $(this).data('target');

            $('.product-view-mode a').removeClass('active');
            $(this).addClass('active');
            shopProductWrap.removeClass('grid list').addClass(viewMode);
            if (shopProductWrap.hasClass('grid')) {
                $('.belly-product').removeClass('product-view--list')
            } else {
                $('.belly-product').addClass('product-view--list')
            }
        })

        /*----------  Product View Slider  ----------*/
        $('.product-view-standered-slider').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 4,
            autoplay: false,
            autoplaySpeed: 1400,
            nextArrow: '<button type="button" class="slick-next btn-reset"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev btn-reset"><i class="fas fa-chevron-left"></i></button>',
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                },
                {
                    breakpoint: 480,
                    settings: {

                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },

                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
        $('.product-view-standered-slider-2').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: false,
            autoplaySpeed: 1400,
            nextArrow: '<button type="button" class="slick-next btn-reset"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev btn-reset"><i class="fas fa-chevron-left"></i></button>',
        });


        
        $('.product-view-vertical-slider').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            swipeToSlide:true,
            autoplay: false,
            verticalSwiping:true,
            autoplaySpeed: 1400,
            vertical: true,
            adaptiveHeight: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        vertical: false,
                        slidesToShow: 4,
                        slidesToScroll: 4
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        vertical: false,
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },

                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        /*----------  Elevate Zoom  ----------*/

        //initiate the plugin and pass the id of the div containing gallery images
        $("#zoom_03").elevateZoom({ gallery: 'product-view-gallary', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: '../image/AjaxLoader.gif' });

        //pass the images to Fancybox
        $("#zoom_03").bind("click", function (e) {
            var ez = $('#zoom_03').data('elevateZoom');
            // $.fancybox(ez.getGalleryList());
            return false;
        });


        /*----------  Quantity  ----------*/

        // $('.pro-qty').prepend('<span class="dec qtybtn">-</span>');
        // $('.pro-qty').append('<span class="inc qtybtn">+</span>');
        $('.count-btn').on('click', function () {
            var $button = $(this);
            var oldValue = $button.parent('.count-input-btns').parent().find('input').val();
            if ($button.hasClass('inc-ammount')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $button.parent('.count-input-btns').parent().find('input').val(newVal);
        });

        /*----------   Shipping Form Toggle   ----------*/

        $('[data-shipping]').on('click', function () {
            if ($('[data-shipping]:checked').length > 0) {
                $('#shipping-form').slideDown();
            } else {
                $('#shipping-form').slideUp();
            }
        })


        /*----------   Add To Cart Animation   ----------*/

        $('.add-to-cart').on('click', function (e) {
            e.preventDefault();

            if ($(this).hasClass('added')) {
                $(this).removeClass('added').find('i').removeClass('ti-check').addClass('ti-shopping-cart').siblings('span').text('add to cart');
            } else {
                $(this).addClass('added').find('i').addClass('ti-check').removeClass('ti-shopping-cart').siblings('span').text('added');
            }
        });



        /*----------   Data Background Image   ----------*/
        function bgImageSettings(){
            $('.bg-image').each(function(){
                var $this = $(this),
                    $image = $this.data('bgimage');
                    
                $this.css({
                    'background-image': 'url(' + $image + ')'
                });
            });
        }
    
        bgImageSettings();


        /*----------   NIce Select  ----------*/
        $('.nice-select').niceSelect()

        /*----------   Sticky Sidebar  ----------*/
        $('#sidebar').stickySidebar({
            topSpacing: 60,
            bottomSpacing: 60
        });


        /*----------   Payment method select  ----------*/

        $('[name="payment-method"]').on('click', function () {

            var $value = $(this).attr('value');

            $('.single-method p').slideUp();
            $('[data-method="' + $value + '"]').slideDown();

        });

       
        setTimeout(function() {
            if($.cookie('shownewsletter')==1) $('.newletter-popup').hide();
            $('#subscribe_pemail').keypress(function(e) {
                if(e.which == 13) {
                    e.preventDefault();
                    email_subscribepopup();
                }
                var name= $(this).val();
                  $('#subscribe_pname').val(name);
            });
            $('#subscribe_pemail').change(function() {
             var name= $(this).val();
                      $('#subscribe_pname').val(name);
            });
            //transition effect
            if($.cookie("shownewsletter") != 1){
                $('.newletter-popup').bPopup();
            }
            $('#newsletter_popup_dont_show_again').on('change', function(){
                if($.cookie("shownewsletter") != 1){   
                    $.cookie("shownewsletter",'1')
                }else{
                    $.cookie("shownewsletter",'0')
                }
            }); 
        }, 5000);



        /* Scroll to Top */


        // When the user clicks on the button, scroll to the top of the document
        $.scrollUp({
            scrollText: '<i class="fas fa-chevron-up"></i>',
            easingType: 'linear',
            scrollSpeed: 900,
            });
    })(jQuery);

});




