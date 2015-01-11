<?php

function create_highlight() {
	register_post_type( 'highlight',
		array(
			'labels' => array(
				'name' => __( 'Highlights' ),
				'singular_name' => __( 'Highlight' )
			),
			'public' => true,
			'has_archive' => true,
			'taxonomies' => array('category')
		)
	);
}

add_action( 'init', 'create_highlight' );