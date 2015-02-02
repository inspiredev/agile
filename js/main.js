'use strict';

require('bootstrap-sass');

jQuery(document).ready(function ($) {
	// nav menu toggle
	$('.menu-toggle').on('click', function () {
		$('#page').toggleClass('menu-active');
	});

	$('.top-level .category-name').on('click', function (e) {
		e.preventDefault();
		var $parentLi = $(this).closest('li');
		$('.main-navigation').toggleClass('item-active');
		$('.top-level > li').not($parentLi).removeClass('active').addClass('inactive')
			.find('.category-name').removeClass('active');
		$parentLi.toggleClass('inactive active');
		$(this).toggleClass('active');
	});

	$('.back').on('click', function () {
		$('.main-navigation').removeClass('item-active');
		$('.top-level > li').removeClass('active').removeClass('inactive');
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
