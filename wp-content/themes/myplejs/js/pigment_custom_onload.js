    // =========== PIGMENT.JS BELOW ONREADY ============= // 

    $(document).ready(function() {



        // Disable checkbox gravity form
        $(".gform_wrapper .disable input").attr('disabled', 'disabled');

        // ---------------------------------------------------------------------------------
        // mob mneu
        $("#mobile-nav").mmenu({
            slidingSubmenus: false
        });

        // ---------------------------------------------------------------------------------
        // trigger the effect on scroll 
        $('#menu-trigger-id').waypoint(function(direction) {
            $('.menu-wrap').toggleClass('isScrolled');
        }, {
            offset: -90
        });

        // ---------------------------------------------------------------------------------
        // scroll top top functions     
        $(".scroll-toTop").click(function(event) {
            $('html, body').animate({
                scrollTop: $(".topMe").offset().top - 70
            }, 600);
        });

        // ---------------------------------------------------------------------------------
        // trigger scroll top top
        $('.menu-wrap').waypoint(function(direction) {
            $('.scroll-toTop').toggleClass('isScrolled');
            $('.logo.wrap').toggleClass('isScrolled');
        }, {
            offset: -330
        });

        // ---------------------------------------------------------------------------------
        // slick scroller
        $('.slickslider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2500,
            speed: 900,
            pauseOnHover: true
        });

        $('.slicksliderobj').slick({
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            centerMode: true,
            variableWidth: true
        });


        // ---------------------------------------------------------------------------------
        // FAQ

        $(".faq-show").click(function() {
            $(this).next(".faq-a").slideToggle(500);
            $(this).toggleClass("faq-off");
        });

        $(".faq-show-all").click(function() {
            $(".faq-a").slideDown(500);
        });


        // ---------------------------------------------------------------------------------
        // List view change (objects)
        $("#list-change").click(function() {
            $(".objlist").addClass("list");
            $(".objlist").removeClass("grid");
            $("#list-change").addClass("lc-sel");
            $("#view-change").removeClass("vc-sel");
            $(".objlist-last").removeClass("hidden");
        });
        $("#view-change").click(function() {
            $(".objlist").addClass("grid");
            $(".objlist").removeClass("list");
            $("#view-change").addClass("vc-sel");
            $("#list-change").removeClass("lc-sel");
            $(".objlist-last").addClass("hidden");
        });










    });
