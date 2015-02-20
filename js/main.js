'use strict';

require('bootstrap-sass');

jQuery(document).ready(function ($) {
	// nav menu toggle
	$('.menu-toggle').on('click', function () {
		$('#page').toggleClass('menu-active');
	});

	$('.top-level .category-name').on('click', function (e) {
		e.preventDefault();
		e.stopPropagation();
		var $parentLi = $(this).closest('li');

		$parentLi.toggleClass('active').removeClass('inactive');
		$(this).toggleClass('active');
		if ($parentLi.hasClass('active')) {
			$('.main-navigation').addClass('item-active');
			$('.top-level > li').not($parentLi).addClass('inactive').removeClass('active')
			.find('.category-name').removeClass('active');
		} else {
			$('.main-navigation').removeClass('item-active');
			$('.top-level > li').not($parentLi).removeClass('active inactive')
			.find('.category-name').removeClass('active');
		}
	});
	// close submenu on click outisde
	$('.submenu-wrapper').on('click', function (e) {
		e.stopPropagation();
	});
	$('body').on('click', function (e) {
		$('.top-level >li, .category-name').removeClass('active inactive');
	});

	$('.back').on('click', function () {
		$('.main-navigation').removeClass('item-active');
		$('.top-level > li').removeClass('active inactive');
		$('.category-name').removeClass('active');
	});

	// Change hash for page-reload
	$('.release-tabs .tab').on('show.bs.tab', function (e) {
		if (history.pushState) {
			history.pushState(null, null, this.href);
		} else {
			window.location.hash = this.hash;
		}
	});
	// enable link on tab
	if (location.hash !== '') {
		$('.release-tabs .tab[href=' + location.hash + ']').tab('show') ;
	}
});
