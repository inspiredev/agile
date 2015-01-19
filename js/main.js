'use strict';

jQuery(document).ready(function ($) {
	// nav menu toggle
	$('.menu-toggle').on('click', function () {
		$('#page').toggleClass('menu-active');
	});

	$('.top-level .category-name').on('click', function () {
		var $parentLi = $(this).closest('li');
		$('.top-level > li').not($parentLi).removeClass('active').toggleClass('inactive');
		$parentLi.toggleClass('active');
	});
});
