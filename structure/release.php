<?php

function create_release() {
	register_post_type( 'release',
		array(
			'labels' => array(
				'name' => __( 'New Releases' ),
				'singular_name' => __( 'New Release' )
			),
			'public' => true,
			'has_archive' => true,
			'taxonomies' => array('category')
		)
	);
}

add_action( 'init', 'create_release' );