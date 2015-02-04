<?php
function agile_connection_types() {
    p2p_register_connection_type( array(
        'name' => 'reference_to_release',
        'from' => 'reference',
        'to' => 'release'
    ) );

    p2p_register_connection_type( array(
        'name' => 'release_to_solution_detail',
        'from' => 'release',
        'to' => 'solution_detail',
        'cardinality' => 'one-to-one'
    ) );
}

add_action( 'p2p_init', 'agile_connection_types' );