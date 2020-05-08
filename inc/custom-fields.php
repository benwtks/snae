<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

function hide_editor() {
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
    if( !isset( $post_id ) ) return;

    $title = get_the_title($post_id);
     
    if($title == 'Contact'){ // edit the template name
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
