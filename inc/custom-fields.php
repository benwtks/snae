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
			Field::make( 'text', 'crb_website', 'Website/Portfolio'),
			Field::make( 'text', 'crb_facebook', 'Facebook'),
			Field::make( 'text', 'crb_twitter', 'Twitter'),
			Field::make( 'text', 'crb_instagram', 'Instagram'),
			Field::make( 'text', 'crb_etsy', 'Etsy')
	    ));

    Container::make( 'post_meta', 'Gallery' )
        ->where( 'post_type', '=', 'artists' )
        ->add_fields( array(
			Field::make( 'media_gallery', 'crb_artist_gallery', 'Gallery' )
			    ->set_type( array( 'image' ) )
		));

}
