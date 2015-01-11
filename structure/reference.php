<?php

function create_reference() {
	register_post_type( 'reference',
		array(
			'labels' => array(
				'name' => __( 'References' ),
				'singular_name' => __( 'Reference' )
			),
			'menu_position' => 5,
			'public' => true,
			'has_archive' => true,
			'taxonomies' => array('category')
		)
	);
}

add_action( 'init', 'create_reference' );