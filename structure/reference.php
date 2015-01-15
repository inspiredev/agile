<?php

function create_reference() {
	register_post_type( 'reference',
		array(
			'labels' => array(
				'name' => __( 'References' ),
				'singular_name' => __( 'Reference' )
			),
			'menu_icon' => 'dashicons-book-alt',
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

add_action( 'init', 'create_reference' );