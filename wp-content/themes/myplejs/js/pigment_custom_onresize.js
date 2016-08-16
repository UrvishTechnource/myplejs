    // =========== PIGMENT.JS BELOW RESIZE ============= // 

    $(document).ready(function() {
        var adjust_size = function() {

            var getWindowHeight = $(window).height();

            // close mob menu on screen width
            if ($(window).width() < 768) {
                // just show screen menu
            } else {
                $("#mobmenu").trigger("close.mm");
            }
            /*------------------------------------------------------*/
            // set image front page slider
            var getImage = $("#backImageOut").attr("src");
            $("#backImageOut").hide();

            if (getImage)
                $(".topp-block-front").backstretch(getImage);





        };
        adjust_size();
        $(window).resize(adjust_size);
    });
