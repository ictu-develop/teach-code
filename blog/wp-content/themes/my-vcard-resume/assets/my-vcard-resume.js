(function(jQuery) {
'use strict';
jQuery(document).ready(function($) {
	
	/*
	Vars
	*/
	var width = $(window).width();
	var height = $(window).height();
	
	
	/*
		slimScroll
	*/
    if(width > 1024) {
        $('.card-inner .card-wrap').slimScroll({
            height: '570px'
        });
    }
	if( $('.owlGallery').length ){
		$(".owlGallery").owlCarousel({
			
			stagePadding: 0,
			loop: true,
			autoplay: true,
			autoplayTimeout: 2000,
			margin: 10,
			nav: false,
			dots: false,
			smartSpeed: 1000,
			responsive: {
				0: {
					items: 1
				},
				600: {
					items: 1
				},
				1000: {
					items: 1
				}
			}
		});
	}
	
	if( $("#sidebar-expander").length){
		$('#sidebar-expander').on('click', function(e) {
			e.preventDefault();
			$(this).toggleClass('active');
			$(this).find('i').toggleClass('fa-close').toggleClass('fa-bars');
			$('body').toggleClass('nav-expanded');
		});
	}
	
	/* -- image-popup */
	if( $('.image-popup').length ){
		 $('.image-popup').magnificPopup({
			closeBtnInside : true,
			type           : 'image',
			mainClass      : 'mfp-with-zoom'
		});
	}
	
	
});
})(jQuery);