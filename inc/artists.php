<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;
require_once( __DIR__ . '/photo-resizer.php');

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
			'supports' => array('title', 'editor')
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

function snae_save_artist($post_id) {
	if (get_post_type($post_id) !== "artists") {
		return false;
	}

	$photo_ID = carbon_get_post_meta($post_id, 'crb_artist_photo');
	snae_resize_if_needed($photo_ID, 400, 400, "artist-photo");
}
// hook not firing?
add_action('carbon_fields_post_meta_container_saved', 'snae_save_artist', 10, 1);

function snae_get_artist_image($post_id, $size, $alt) {
	snae_save_artist($post_id);
	$photo_ID = carbon_get_post_meta($post_id, 'crb_artist_photo');
	$cropped_url = snae_get_cropped_url($photo_ID, "artist-photo");

	return ("<img width='". $size . "' height='" . $size . "' class='artist-photo' src='" . $cropped_url . "' alt='" . $alt . "'/>");
}

?>
