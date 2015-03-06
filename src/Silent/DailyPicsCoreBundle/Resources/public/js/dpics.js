function fbResponsive(imgSlug, fb_ct_w) {
    $('#fb_comments_box').html('<div class="fb-comments" data-href="'+ Routing.generate('silent_daily_pics_core_show',{slug : imgSlug}, true) +'" data-colorscheme="light" data-numposts="10" data-width="' + fb_ct_w +'"></div>');
    FB.XFBML.parse( );
}

function facebookBindResponsive(imgSlug) {
    $(window).bind("resize", function(){
        if (divFbW != $('#fb_comments_box').width()) {
            fbResponsive(imgSlug, divFbW);
            divFbW = $('#fb_comments_box').width();
        }
    });
}
