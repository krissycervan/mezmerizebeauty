jQuery(document).ready(function($){	
// The slider being synced must be initialized first
	// $('#carousel').flexslider({
	// 	    animation: "slide",
	// 	    controlNav: false,
	// 	    animationLoop: false,
	// 	    slideshow: false,
	// 	    itemWidth: 160,
	// 	    itemMargin: 40,
	// 	    asNavFor: '#slider'
	// 	}); 
	// $('#slider').flexslider({
	// 	    animation: "fade",
	// 	    controlNav: false,
	// 	    animationLoop: false,
	// 	    slideshow: false,
	// 	    sync: "#carousel"
	//   	});


	$('#slider .slides').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  fade: true,
	  arrows: true,
	  asNavFor: '.nav-thumb',
	  infinite: false
	});
	$('#carousel .nav-thumb').slick({
	  slidesToShow: 4,
	  slidesToScroll: 1,
	  asNavFor: '.slides',
	  dots: false,
	  arrows: false,
	  centerMode: false,
	  focusOnSelect: true,
	  infinite: false, 
	  responsive: [{

	      breakpoint: 540,
	      settings: {
	        slidesToShow: 2,
	      }
	   }]
	});


	$('header nav').meanmenu({
	    meanScreenWidth: "991",
	    meanRevealPosition: "center"
	});

	/* Equal Height */
    $('.promotional-block .col .text-holder').matchHeight({
        byRow: true,
        property: 'height',
        target: null,
        remove: false
    });

    /* Custom Scroll Bar */
    $(".promotional-block .col .text-holder").mCustomScrollbar({
     theme:"minimal"
    });

    $(".testimonial #slider .holder .text-holder .holder").mCustomScrollbar({
     theme:"minimal"
    });
});

		