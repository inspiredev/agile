'use strict';

jQuery(document).ready(function ($) {
	// nav menu toggle
	$('.menu-toggle').on('click', function () {
		$('#page').toggleClass('menu-active');
	});

	$('.top-level .category-name').on('click', function () {
		var $parentLi = $(this).closest('li');
		$('.main-navigation').toggleClass('item-active');
		$('.top-level > li').not($parentLi).removeClass('active').toggleClass('inactive')
			.find('.category-name').removeClass('active');
		$parentLi.toggleClass('active');
		$(this).toggleClass('active');
	});
	$('.back').on('click', function () {
		$('.main-navigation').removeClass('item-active');
		$('.top-level > li').removeClass('active').removeClass('inactive');
		$('.category-name').removeClass('active');
	})
});
