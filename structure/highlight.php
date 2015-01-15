<?php

function create_highlight() {
	register_post_type( 'highlight',
		array(
			'labels' => array(
				'name' => __( 'Highlights' ),
				'singular_name' => __( 'Highlight' )
			),
			'menu_icon' => 'dashicons-lightbulb',
			'menu_position' => 5,
			'public' => true,
			'has_archive' => true,
			'supports' => array(
				'title',
				'editor',
				'page-attributes',
				'thumbnail'
			),
			'taxonomies' => array( 'category' )
		)
	);
}

add_action( 'init', 'create_highlight' );