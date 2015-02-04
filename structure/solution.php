<?php

function create_solution_detail() {
	register_post_type( 'solution_detail',
		array(
			'labels' => array(
				'name' => __( 'Solution Detail' ),
				'singular_name' => __( 'Solution Detail' )
			),
			'menu_icon' => 'dashicons-chart-line',
			'menu_position' => 6,
			'public' => true,
			'supports' => array(
				'title',
				'editor',
			)
		)
	);
}

add_action( 'init', 'create_solution_detail' );