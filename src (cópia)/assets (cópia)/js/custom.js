/***************************************************************************************************************
||||||||||||||||||||||||||||        CUSTOM SCRIPT FOR ASSURANCE            |||||||||||||||||||||||||||||||||||||
****************************************************************************************************************
||||||||||||||||||||||||||||              TABLE OF CONTENT                  ||||||||||||||||||||||||||||||||||||
****************************************************************************************************************
****************************************************************************************************************
01. Revolution slider
02. Sticky header
03. scoll to Top
04. Project Masonary
06. Testimonial Slider
07. magnificPopup
08. Fact counter 
09. Prealoder
10. ContactFormValidation
11. services-select


****************************************************************************************************************
||||||||||||||||||||||||||||            End TABLE OF CONTENT                ||||||||||||||||||||||||||||||||||||
****************************************************************************************************************/
"use strict";

/*----------------------------
   Preloader
  ------------------------------ */
    function prealoader () {
        if($('.loader-container').length) {
          $('.loader-container').fadeOut(1000);
        }
    }
/*=================== Sticky Header ===================*/
    function stickyHeader () {
        var scroll = $(window).scrollTop();
        if (scroll > 200) {
            $(".mainmenu-area.stick, .header-lower.stick, .header-area.stick").addClass("sticky animated fadeInDown");
            var nav_height = $(".mainmenu-area.stick, .header-lower.stick, .header-area.stick").innerHeight();
            $(".menu-height").css({
                "height": nav_height
            });
        } else if (scroll < 200) {
            $(".mainmenu-area.stick, .header-lower.stick, .header-area.stick").removeClass("sticky animated fadeInDown");
            $(".menu-height").css({
                "height": 0
            });
        }
    }

//====Main menu===
    function mainmenu() {
        //Submenu Dropdown Toggle
        if($('.main-menu li.dropdown ul').length){
            $('.main-menu li.dropdown').append('<div class="dropdown-btn"></div>');
            
            //Dropdown Button
            $('.main-menu li.dropdown .dropdown-btn').click(function() {
                $(this).prev('ul').slideToggle(500);
            });
        }

    }

//===RevolutionSliderActiver===
    function revolutionSliderActiver () {
        if ($('.rev_slider_wrapper #slider1').length) {
            $("#slider1").revolution({
                sliderType:"standard",
                sliderLayout:"auto",
                delay:5000,
                
                navigationType:"bullet",
                navigationArrows:"0",
                navigationStyle:"preview3",
                
                dottedOverlay:'yes',
                
                hideTimerBar:"off",
                onHoverStop:"off",
                navigation: {
                    arrows:{enable:true}
                }, 
                responsiveLevels:[1920,1280,975,600,300],
                gridwidth: [1170, 720, 500, 500, 300],
                gridheight: [650, 600, 550, 450, 400]
            });
        };
    }


//===scoll to Top===
    function scrollToTop() {
        if ($('.scroll-to-target').length) {
            $(".scroll-to-target").click(function() {
                var target = $(this).attr('data-target');
                // animate
                $('html, body').animate({
                    scrollTop: $(target).offset().top
                }, 1000);

            });
        }
    }

//===Testmonial Slider Style 2===
    function testimcarousel () {
        if ($('.testim-carousel').length) {
            $('.testim-carousel').owlCarousel({
                loop:true,
                margin:30,
                nav:false,
                dots: false,
                autoplayHoverPause:true,
                autoplay: 6000,
                smartSpeed: 700,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    800:{
                        items:2
                    },
                    1024:{
                        items:2
                    },
                    1100:{
                        items:3
                    },
                    1200:{
                        items:3
                    }
                }
            })
        }
    }


//===Testmonial Slider Style 2===
    function clientscarousel () {
        if ($('.clients-carousel').length) {
            $('.clients-carousel').owlCarousel({
                loop:true,
                margin:30,
                nav:true,
                dots: true,
                items:1,
                autoplayHoverPause:true,
                autoplay: 6000,
                smartSpeed: 700,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    800:{
                        items:1
                    },
                    1024:{
                        items:1
                    },
                    1100:{
                        items:1
                    },
                    1200:{
                        items:1
                    }
                }
            })
        }
    }

//===Testmonial Slider Style 2===
    function clientsstyletwocarousel () {
        if ($('.clients-style-two-carousel').length) {
            $('.clients-style-two-carousel').owlCarousel({
                loop:true,
                margin:30,
                dots: false,
                items:1,
                autoplayHoverPause:true,
                autoplay: 6000,
                smartSpeed: 700,
                navigation: true,
                navigationText: ["<i class='fa fa-chevron-left'></i>",
                                 "<i class='fa fa-chevron-righ'></i>"],
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    800:{
                        items:1
                    },
                    1024:{
                        items:1
                    },
                    1100:{
                        items:1
                    },
                    1200:{
                        items:1
                    }
                }
            })
        }
    }

//===Testmonial Slider Style 2===
    function teamcarousal () {
        if ($('.team-carousel').length) {
            $('.team-carousel').owlCarousel({
                loop:true,
                margin:30,
                nav:true,
                dots: false,
                items:1,
                autoplayHoverPause:true,
                autoplay: 6000,
                smartSpeed: 700,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    800:{
                        items:1
                    },
                    1024:{
                        items:1
                    },
                    1100:{
                        items:1
                    },
                    1200:{
                        items:1
                    }
                }
            })
        }
    }

//===Team Carousal===
    function teamtopcarousal () {
        if ($('.teamtop-carousal').length) {
            $('.teamtop-carousal').owlCarousel({
                loop:true,
                margin:30,
                nav:false,
                dots: false,
                autoplayHoverPause:true,
                autoplay: 6000,
                smartSpeed: 700,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    800:{
                        items:2
                    },
                    1024:{
                        items:2
                    },
                    1100:{
                        items:3
                    },
                    1200:{
                        items:3
                    }
                }
            })
        }
    }

//===Sponser Slider Style 2===
    function sponsercarousel () {
        if ($('.sponser-carousel').length) {
            $('.sponser-carousel').owlCarousel({
                loop:true,
                margin:30,
                nav:false,
                dots: false,
                autoplayHoverPause:true,
                autoplay: 6000,
                smartSpeed: 700,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    800:{
                        items:3
                    },
                    1024:{
                        items:4
                    },
                    1100:{
                        items:4
                    },
                    1200:{
                        items:4
                    }
                }
            })
        }
    }

//===Testmonial Slider Style 2===
    function bannercarousel () {
        if ($('.banner-carousel').length) {
            $('.banner-carousel').owlCarousel({
                loop:true,
                margin:30,
                nav:true,
                dots: true,
                items:1,
                autoplayHoverPause:true,
                autoplay: 6000,
                smartSpeed: 700,
                transitionStyle : "fadeInDown",
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    800:{
                        items:1
                    },
                    1024:{
                        items:1
                    },
                    1100:{
                        items:1
                    },
                    1200:{
                        items:1
                    }
                }
            })
        }
    }

//===Testmonial Slider Style 3===
    function bannerthreecarousel () {
        if ($('.banner-three-carousel').length) {
            $('.banner-three-carousel').owlCarousel({
                loop:true,
                margin:0,
                nav:true,
                dots: true,
                items:3,
                autoplayHoverPause:true,
                autoplay: 6000,
                smartSpeed: 700,
                transitionStyle : "fadeInDown",
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    800:{
                        items:2
                    },
                    1024:{
                        items:3
                    },
                    1100:{
                        items:3
                    },
                    1200:{
                        items:3
                    }
                }
            })
        }
    }

/*--------------------magnificPopup------------------*/
    function magnificPopup () {
        if($(".video").is("#video")){

          var videoPlay = $('.video-play');
          videoPlay.magnificPopup({
              type: 'iframe',
              closeBtnInside: false,
              closeOnContentClick: true,
              tLoading: '', // remove text from preloader


          });
        }
    }

//===Search box ===
    function searchbox() {
        //Search Box Toggle
        if($('.search-toggle').length){
            //Dropdown Button
            $('.search-toggle').click(function() {
                $(this).toggleClass('active');
                $(this).next('.search-box').toggleClass('now-visible');
            });
        }

    }

    $('.toggle').click(function(e) {
    e.preventDefault();
  
    var $this = $(this);
  
    if ($this.next().hasClass('show')) {
        $this.next().removeClass('show');
        $this.next().slideUp(350);
    } else {
        $this.parent().parent().find('li .inner').removeClass('show');
        $this.parent().parent().find('li .inner').slideUp(350);
        $this.next().toggleClass('show');
        $this.next().slideToggle(350);
    }
});

/*=================== Accordion ===================*/
    function accordion () {
        $(".toggle").each(function(){
            $(this).find('.content').hide();
            $(this).find('h2:first').addClass('active').next().slideDown(500).parent().addClass("activate");
            $('h2', this).click(function() {
                if ($(this).next().is(':hidden')) {
                    $(this).parent().parent().find("h2").removeClass('active').next().slideUp(500).removeClass('animated fadeInUp').parent().removeClass("activate");
                    $(this).toggleClass('active').next().slideDown(500).addClass('animated fadeInUp').parent().toggleClass("activate");
                }
            });
        });
    }

//=== Fact counter ===
    function CounterNumberChanger () {
        var timer = $('.timer');
        if(timer.length) {
            timer.appear(function () {
                timer.countTo();
            })
        }
    }

//=== Select menu === 
    function selectDropdown () {
        if($(".selectmenu").length) {
            $( ".selectmenu" ).selectmenu();
        };
    }



 

//=== Thm scroll anim===
    function thmScrollAnim() {
        if ($('.wow').length) {
            var wow = new WOW({
                mobile: false
            });
            wow.init();
        };
    }


// ===Project===
    function projectMasonaryLayout() {
        if ($('.masonary-layout').length) {
            $('.masonary-layout').isotope({
                layoutMode: 'masonry'
            });
        }

        if ($('.post-filter').length) {
            $('.post-filter li').children('span').click(function() {
                var Self = $(this);
                var selector = Self.parent().attr('data-filter');
                $('.post-filter li').children('span').parent().removeClass('active');
                Self.parent().addClass('active');


                $('.filter-layout').isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 500,
                        easing: 'linear',
                        queue: false
                    }
                });
                return false;
            });
        }

        if ($('.post-filter.has-dynamic-filter-counter').length) {
            // var allItem = $('.single-filter-item').length;

            var activeFilterItem = $('.post-filter.has-dynamic-filter-counter').find('li');

            activeFilterItem.each(function() {
                var filterElement = $(this).data('filter');
                console.log(filterElement);
                var count = $('.gallery-content').find(filterElement).length;

                $(this).children('span').append('<span class="count"><b>' + count + '</b></span>');
            });
        };
    }
// ===Date picker ===
    function datepicker () {
        if ($('#datepicker').length) {
            $('#datepicker').datepicker();
        };
    }
//=== Contact Form Validation ===
    function ContactFormValidation() {
      if(('.form-sec').length) {
        var form = $('#ajax-contact');
        var formMessages = $('.form-messages');
        $(form).submit(function(e) {
          e.preventDefault();
          var formData = $(form).serialize();
          $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
          }).done(function(response) {
            $(formMessages).removeClass('error');
            $(formMessages).addClass('success');
            $(formMessages).text(response);
            $(this).find("input").val("");
            $(form).trigger("reset");
          }).fail(function(data) {
            $(formMessages).removeClass('success');
            $(formMessages).addClass('error');
            if (data.responseText !== '') {
              $(formMessages).text(data.responseText);
            } else {
              $(formMessages).text('Oops! An error occured and your message could not be sent.');
            }
          });
        });
    }

    // In your Javascript (external .js resource or <script> tag)
    function Selectfunction() {
        $('.services-select').select2();
        };
    }

//Hidden Bar Toggler
    function hiddenBarToggler() {
        if ($('.hidden-bar-closer').length) {
            $('.hidden-bar-closer').on('click', function () {
                $('.hidden-bar').removeClass('visible-sidebar');
            });
        }
        if ($('.hidden-bar-opener').length) {
            $('.hidden-bar-opener').on('click', function () {
                $('.hidden-bar').addClass('visible-sidebar');
            });
        }
    }


    //Hidden Bar Menu Config
    function hiddenBarMenuConfig() {
        var menuWrap = $('.hidden-bar .side-menu');
        // appending expander button
        menuWrap.find('.dropdown').children('a').append(function () {
            return '<button type="button" class="btn expander"><i class="fa fa-angle-down"></i></button>';
        });
        // hidding submenu 
        menuWrap.find('.dropdown').children('ul').hide();
        // toggling child ul
        menuWrap.find('.btn.expander').each(function () {
            $(this).on('click', function () {
                $(this).parent() // return parent of .btn.expander (a) 
                    .parent() // return parent of a (li)
                        .children('ul').slideToggle();
    
                // adding class to expander container
                $(this).parent().toggleClass('current');
                // toggling arrow of expander
                $(this).find('i').toggleClass('');
    
                return false;
    
            });
        });
    }

    


// Dom Ready Function
    jQuery(document).ready(function () {
        (function ($) {
            // add your functions
            revolutionSliderActiver ();
            mainmenu ();
            teamcarousal ();
            teamtopcarousal ();
            clientscarousel ();
            clientsstyletwocarousel ();
            testimcarousel ();
            testimcarousel ();
            sponsercarousel ();
            bannercarousel ();
            bannerthreecarousel ();
            scrollToTop ();
            CounterNumberChanger ();
            accordion ();
            searchbox ();
            magnificPopup ();
            ContactFormValidation ();
            selectDropdown ();
            thmScrollAnim ();
            datepicker ();
            hiddenBarToggler();
            hiddenBarMenuConfig();
     
        })(jQuery);
    });

// Scroll Function
    jQuery(window).scroll(function(){
        (function ($) {
        stickyHeader()
        
        })(jQuery);
    });

// Instance Of Fuction while Window Load event
    jQuery(window).load(function() {
        (function($) {
            projectMasonaryLayout ();
            prealoader ()
            
        })(jQuery);
    });