/*
 * Copyright 2012 soundarapandian
 * Licensed under the Apache License, Version 2.0
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 */

 jQuery("document").ready(function() {
	jQuery(".dropdown-menu li a").mousedown(function() {
		var dropdown = $(this).parents('.dropdown');
		var link = dropdown.children(':first-child');
		link.css('background-color', "#DB2723");
		link.css('color', 'white');
	});
	jQuery('.carousel').carousel({
      interval: 4000
   });

});
