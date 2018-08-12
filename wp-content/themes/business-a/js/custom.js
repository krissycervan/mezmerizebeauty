( function($){
	'use strict';
	
	$(document).ready(function(){
			$(function() {
					$('#client_Carousel .item').each(function(){	
					  var next = $(this).next();
					  if (!next.length) {
						next = $(this).siblings(':first');
					  }
					  next.children(':first-child').clone().appendTo($(this));
					  
					  for (var i=0;i<2;i++) {
						next=next.next();
						if (!next.length) {
							next = $(this).siblings(':first');
						}
						
						next.children(':first-child').clone().appendTo($(this));
					  }
					});	
			});
			
		
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$('.rdn_page_scroll').fadeIn();
				} else {
					$('.rdn_page_scroll').fadeOut();
				}
			});
		
			$('.rdn_page_scroll').click(function () {
				$("html, body").animate({
					scrollTop: 0
				}, 600);
				return false;
			});
			
			$('[data-toggle="tooltip"]').tooltip();

	});

})(jQuery);