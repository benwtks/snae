<?php
require_once ABSPATH . '/wp-admin/includes/image.php';
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

function generate_cropped_path($photo_ID, $file) {
	$photo_folder = substr($file, 0, strrpos($file, "/")) . "/";
	$photo_file_type = strrchr($file, '.');

	return "uploads/" . $photo_folder . $photo_ID . "-artist-photo" . $photo_file_type;
}

function snae_save_artist($post_id) {
	if (get_post_type($post_id) !== "artists") {
		return false;
	}

	$photo_ID = carbon_get_post_meta($post_id, 'crb_artist_photo');
	$file = wp_get_attachment_metadata($photo_ID)['file'];

	$cropped_path = generate_cropped_path($photo_ID, $file);
	$cropped_url = content_url($cropped_path);

	if (!file_exists(WP_CONTENT_DIR . "/" . $cropped_path)) {
		$image = wp_get_image_editor(WP_CONTENT_DIR . '/uploads/' . $file);

		if (! is_WP_error($editor)) {
			$image->resize(400,400, array( 'center', 'center'));
			$image->save("wp-content/" . $cropped_path);
		}
	}
}
// hook not firing?
add_action('carbon_fields_post_meta_container_saved', 'snae_save_artist', 10, 1);

function snae_get_artist_image($size, $alt) {
	$photo_ID = carbon_get_post_meta(get_the_ID(), 'crb_artist_photo');
	$file = wp_get_attachment_metadata($photo_ID)['file'];
	$cropped_url = content_url(generate_cropped_path($photo_ID, $file));

	return ("<img width='". $size . "' height='" . $size . "' class='artist-photo' src='" . $cropped_url . "' alt='" . $alt . "'/>");
}

?>
