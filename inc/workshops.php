<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

function snae_create_workshop_post_type() {
	register_post_type('workshops',
        array(
            'labels' => array(
                'name' => __( 'Workshops' ),
				'singular_name' => __( 'Workshop' ),
				'edit_item' => __('Edit Workshop'),
				'name_admin_bar'     => _x( 'Workshop', 'add new on admin bar'),
				'add_new'            => _x( 'Add New', 'workshop'),
				'add_new_item'       => __( 'Add New Workshop'),
				'new_item'           => __( 'New Workshop'),
				'edit_item'          => __( 'Edit Workshop'),
				'view_item'          => __( 'View Workshop'),
				'all_items'          => __( 'All Workshops'),
				'search_items'       => __( 'Search Workshops'),
				'parent_item_colon'  => __( 'Parent Workshops'),
				'not_found'          => __( 'No workshops found.'),
				'not_found_in_trash' => __( 'No workshops found in Trash.')
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'workshops'),
            'show_in_rest' => true,
			'menu_icon' => 'dashicons-cart',
			'taxonomies' => array( 'category' ),
            'supports' => array('title')
        )
    );
}

add_action( 'init', 'snae_create_workshop_post_type' );

function get_artist_name_array() {
	$artist_query = new WP_Query( array (
		'post_type' => 'artists',
		'posts_per_page' => -1
	));

	$artists_array = $artist_query->posts;
	return wp_list_pluck( $artists_array, 'post_title', 'ID' );
}

function crb_attach_workshop_options() {
	Container::make( 'post_meta', 'Workshop Details' )
		->where( 'post_type', '=', 'workshops' )
		->add_fields( array(
			Field::make( 'select', 'crb_workshop_artist', 'Artist' )
				->add_options( 'get_artist_name_array' ),
			Field::make( 'textarea', 'crb_workshop_short_desc', 'Short Description (80 character limit)' )
				->set_attribute( 'maxLength', 80 ),
			Field::make( 'textarea', 'crb_workshop_desc', 'Description' ),
		));

	Container::make( 'post_meta', 'Ecommerce' )
		->where( 'post_type', '=', 'workshops' )
		->add_fields( array(
			Field::make( 'text', 'crb_workshop_price', 'Price (£)' )
				->set_attribute( 'placeholder', 'e.g. 49.99' ),
			Field::make( 'checkbox', 'crb_artist_sold_by_snae', 'Sold by SNAE' )
				->set_option_value( 'yes' ),
			Field::make( 'text', 'crb_workshop_places', 'Places available (Stock)' ),
			Field::make( 'complex', 'crb_workshop_guarantees', 'Customer guarantees' )
				->add_fields( array(
					Field::make( 'text', 'crb_workshop_gaurantee', 'Gaurantee'),
				)),
		));

}

add_action( 'carbon_fields_register_fields', 'crb_attach_workshop_options' );
?>
