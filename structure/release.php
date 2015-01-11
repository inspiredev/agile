<?php

function create_release() {
	register_post_type( 'release',
		array(
			'labels' => array(
				'name' => __( 'New Releases' ),
				'singular_name' => __( 'New Release' )
			),
			'menu_icon' => 'dashicons-album',
			'menu_position' => 5,
			'public' => true,
			'has_archive' => true,
			'taxonomies' => array('category')
		)
	);
}

add_action( 'init', 'create_release' );