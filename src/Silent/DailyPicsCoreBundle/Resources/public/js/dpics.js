function fbResponsive(url, fb_ct_w) {
    $('#fb_comments_box').html('<div class="fb-comments" data-href="'+ url +'" data-colorscheme="dark" data-numposts="10" data-width="' + fb_ct_w +'"></div>');
    FB.XFBML.parse( );
}