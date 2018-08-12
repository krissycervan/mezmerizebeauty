jQuery(document).ready(function($) {
		
		var window_width = $(window).width();

		if ( window_width >= 768 ) {
		   $('.nav li.dropdown').hover(function() {
			   $(this).addClass('open');
		   }, function() {
			   $(this).removeClass('open');
		   }); 
		}
		
		// Fix for Bootstrap Navwalker
		/*$('.navbar .dropdown > a .fa').click(function(){
			event.preventDefault();
			event.stopPropagation();
			$(this).toggleClass('fa-caret-up');
			$(this).parent().siblings().toggleClass('open');

			if ( $( '.navbar .dropdown' ).hasClass( 'open' ) ) {
				$( '.navbar .dropdown' ).removeClass( 'open' );
				$(this).toggleClass('fa-caret-up');
				$(this).parent().siblings().toggleClass('open');
			}
		});*/
});
	
	  