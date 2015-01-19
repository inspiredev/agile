'use strict';

jQuery(document).ready(function ($) {
	// nav menu toggle
	$('.menu-toggle').on('click', function () {
		$('#page').toggleClass('menu-active');
	});
});
