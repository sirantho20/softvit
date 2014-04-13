<?php

/**
 * @package Vitabu
 */
/*
Plugin Name: Vitabu
Plugin URI: http://softcube.co
Description: Vitabu ebookshop developed by Softcube LImited
Version: 1.0
Author: Softcube Team
Author URI: http://softcube.co
License: Proprietary
*/

function vitabu_book_type() {
	$labels = array(
		'name'               => _x( 'Publications', 'books, magazines, news journals etc' ),
		'singular_name'      => _x( 'Publication', 'books, magazines, news journals etc' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Publication' ),
		'edit_item'          => __( 'Edit Publication' ),
		'new_item'           => __( 'New Publication' ),
		'all_items'          => __( 'All Publications' ),
		'view_item'          => __( 'View Publications' ),
		'search_items'       => __( 'Search Publications' ),
		'not_found'          => __( 'No publications found' ),
		'not_found_in_trash' => __( 'No publications found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Publications'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our publications and publication specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
                'hierarchical'  => true,
	);
	register_post_type( 'publication', $args );	
}
add_action( 'init', 'vitabu_book_type' );