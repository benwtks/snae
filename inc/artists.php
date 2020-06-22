<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

function snae_create_artist_post_type() {
	register_post_type('artists',
        array(
            'labels' => array(
                'name' => __( 'Artists' ),
				'singular_name' => __( 'Artist' ),
				'name_admin_bar'     => _x( 'Artist', 'add new on admin bar'),
				'add_new'            => _x( 'Add New', 'artist'),
				'add_new_item'       => __( 'Add New Artist'),
				'new_item'           => __( 'New Artist'),
				'edit_item'          => __( 'Edit Artist'),
				'view_item'          => __( 'View Artist'),
				'all_items'          => __( 'All Artists'),
				'search_items'       => __( 'Search Artists'),
				'parent_item_colon'  => __( 'Parent Artists:'),
				'not_found'          => __( 'No artists found.'),
				'not_found_in_trash' => __( 'No artists found in Trash.')
            ),
            'public' => true,
            'has_archive' => false,
            'rewrite' => array('slug' => 'artists'),
            'show_in_rest' => true,
            'menu_icon' => 'dashicons-admin-customizer',
            'supports' => array('title')
        )
	);
}

add_action('init', 'snae_create_artist_post_type' );

function crb_attach_artist_options() {
    Container::make( 'post_meta', 'Artist Details' )
        ->where( 'post_type', '=', 'artists' )
		->add_fields( array(
			Field::make( 'image', 'crb_artist_photo', 'Profile photo' ),
            Field::make( 'text', 'crb_job', 'Job title' ),
            Field::make( 'textarea', 'crb_short_bio', 'Short Bio (80 character limit)' )
                ->set_attribute( 'maxLength', 80 ),
            Field::make( 'textarea', 'crb_bio', 'Bio' )
		));

    Container::make( 'post_meta', 'Links' )
        ->where( 'post_type', '=', 'artists' )
        ->add_fields( array(
			Field::make( 'text', 'crb_artist_website', 'Website/Portfolio'),
			Field::make( 'text', 'crb_artist_facebook', 'Facebook'),
			Field::make( 'text', 'crb_artist_twitter', 'Twitter'),
			Field::make( 'text', 'crb_artist_instagram', 'Instagram'),
			Field::make( 'text', 'crb_artist_etsy', 'Etsy')
	    ));

    Container::make( 'post_meta', 'Gallery' )
        ->where( 'post_type', '=', 'artists' )
        ->add_fields( array(
			Field::make( 'text', 'crb_artist_gallery_shortcode', 'Gallery code (e.g. Envira Gallery)')
		));

}

add_action( 'carbon_fields_register_fields', 'crb_attach_artist_options' );

?>
