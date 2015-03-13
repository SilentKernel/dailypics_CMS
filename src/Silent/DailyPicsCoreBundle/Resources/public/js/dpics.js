function fbResponsive(imgSlug, fb_ct_w) {
    $('#fb_comments_box').html('<div class="fb-comments" data-href="'+ Routing.generate('silent_daily_pics_core_show',{slug : imgSlug}, true) +'" data-colorscheme="light" data-numposts="10" data-width="' + fb_ct_w +'"></div>');
    FB.XFBML.parse( );
}

function facebookBindResponsive(imgSlug) {
    loadFacebookCommentBoxJs();
	sessionStorage.setItem("divFbW", $('#fb_comments_box').width());
	// Bind mooving event
	$(window).bind("resize", function(){
        if (sessionStorage.getItem("divFbW") != $('#fb_comments_box').width()) 
		{
			sessionStorage.setItem("divFbW", $('#fb_comments_box').width());
            fbResponsive(imgSlug, sessionStorage.getItem("divFbW") );
		}
    });
	// Shwowing at page loading
	fbResponsive(imgSlug, sessionStorage.getItem("divFbW") );
}
