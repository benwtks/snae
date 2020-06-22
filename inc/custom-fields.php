<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

function hide_editor() {
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;

    $title = get_the_title($post_id);

    if($title == 'Contact'){
        remove_post_type_support('page', 'editor');
        remove_post_type_support('page', 'revisions');
        remove_post_type_support('page', 'custom-fields');
        remove_post_type_support('page', 'comments');
        remove_post_type_support('page', 'author');
        remove_post_type_support('page', 'page-attributes');
        remove_post_type_support('page', 'thumbnail');
    }
}

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
	Container::make( 'theme_options', __( 'Theme Options', 'crb' ) )
        ->add_fields( array(
            Field::make( 'textarea', 'crb_theme_address', 'Address' ),
            Field::make( 'text', 'crb_theme_telephone', 'Phone number' ),
            Field::make( 'text', 'crb_theme_email', 'Email' ),
		) );
}

add_action( 'carbon_fields_register_fields', 'crb_attach_artist_options' );
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

function get_artist_name_array() {
	$artist_query = new WP_Query( array (
		'post_type' => 'artists',
		'posts_per_page' => -1
	));

	$artists_array = $artist_query->posts;
	return wp_list_pluck( $artists_array, 'post_title', 'ID' );
}

add_action( 'carbon_fields_register_fields', 'crb_attach_workshop_options' );
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
			Field::make( 'text', 'crb_workshop_places', 'Places available (Stock)' ),
			Field::make( 'complex', 'crb_workshop_guarantees', 'Customer guarantees' )
				->add_fields( array(
					Field::make( 'text', 'crb_workshop_gaurantee', 'Gaurantee'),
				)),
		));

}
