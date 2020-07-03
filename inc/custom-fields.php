<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

function crb_attach_theme_options() {
	Container::make( 'theme_options', __( 'Theme Options', 'crb' ) )
		->add_fields( array(
			Field::make( 'textarea', 'crb_theme_address', 'Address' ),
			Field::make( 'text', 'crb_theme_telephone', 'Phone number' ),
			Field::make( 'text', 'crb_theme_email', 'Email' ),
			Field::make( 'text', 'crb_event_url', 'Current event url' ),
			Field::make( 'text', 'crb_mc_form_url', 'Mailchimp subscribe form - Needed to redirect users resubscribing since Mailchimp requires this to be done through their form'),
			Field::make( 'text', 'crb_mc_list_id', 'Mailchimp newsletter list id' ),
			Field::make( 'text', 'crb_mc_api_key', 'Mailchimp API key' ),
			Field::make( 'text', 'crb_stripe_api_key', 'Stripe API key' ),
			Field::make( 'select', 'crb_header_style', 'Header style' )
				->set_options( array(
					'split' => 'Split navigation without title',
					'combined' => 'Combined navigation with title',
				) ),
			Field::make( 'text', 'crb_notification', 'Notification bar (empty removes bar)' ),
			Field::make( 'select', 'crb_notification_style', 'Notification bar colour' )
				->set_options( array(
					'default' => 'Default',
					'orange' => 'Orange',
					'blue' => 'Stone blue'
				) ),
			Field::make( 'text', 'crb_notification_link', 'Notification learn more link' ),
			Field::make( 'text', 'crb_facebook', 'Facebook profile' ),
			Field::make( 'text', 'crb_instagram', 'Instagram profile'),
			Field::make( 'text', 'crb_linkedin', 'Linkedin profile'),
			Field::make( 'text', 'crb_twitter', 'Twitter profile'),
			Field::make( 'checkbox', 'crb_show_footer_title', 'Show site title in footer')
				->set_option_value( 'yes' ),
			Field::make( 'checkbox', 'crb_show_footer_logo', 'Show site logo in footer')
				->set_option_value( 'yes' ),
			Field::make( 'checkbox', 'crb_show_top_bar', 'Show bar above main header for social and site functions')
				->set_option_value( 'yes' ),
		));
}

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );

function snae_get_post_type_array($type) {
	$query = new WP_Query( array(
		'post_type' => $type,
		'posts_per_page' => -1
	));

	$array = $query->posts;
	return wp_list_pluck( $array, 'post_title', 'ID' );
}

function snae_get_pages_array() {
	return snae_get_post_type_array('page');
}

function snae_get_workshops_array() {
	return snae_get_post_type_array('workshop');
}

function snae_get_artists_array() {
	return snae_get_post_type_array('artist');
}

function crb_attach_custom_home_options() {
	Container::make( 'post_meta', 'Top section' )
		->where( 'post_id', '=', get_option( 'page_on_front' ) )
		->add_fields( array(
			Field::make( 'image', 'crb_homepage_top_image', 'Top Background Image'),
			Field::make( 'text', 'crb_homepage_top_title', 'Title'),
			Field::make( 'textarea', 'crb_homepage_top_body', 'Intro')
		));

	Container::make( 'post_meta', 'Main Content' )
		->where( 'post_id', '=', get_option( 'page_on_front' ) )
		->add_fields( array(
			Field::make( 'complex', 'crb_homepage_features', 'Featured pages')
				->add_fields( array(
					Field::make( 'image', 'crb_homepage_feature_img', 'Page image'),
					Field::make( 'select', 'crb_homepage_feature', 'Featured page')
						->add_options( 'snae_get_pages_array' ),
					Field::make( 'textarea', 'crb_homepage_feature_body', 'Body text')
				)),
			Field::make( 'complex', 'crb_homepage_workshops', 'Featured workshops')
				->add_fields( array(
					Field::make( 'select', 'crb_homepage_workshop', 'Featured workshop')
						->add_options( 'snae_get_workshops_array' ),
				)),
			Field::make( 'complex', 'crb_homepage_artists', 'Featured artists')
				->add_fields( array(
					Field::make( 'select', 'crb_homepage_artist', 'Featured artist')
						->add_options( 'snae_get_artists_array' ),
				)),
		));

	Container::make( 'post_meta', 'Call to action (e.g. to register)')
		->where( 'post_id', '=', get_option( 'page_on_front' ) )
		->add_fields( array(
			Field::make( 'text', 'crb_call_to_action_title', 'Title'),
			Field::make( 'text', 'crb_call_to_action_body', 'Description'),
			Field::make( 'complex', 'crb_call_to_action_links', 'Links')
				->add_fields( array(
					Field::make( 'text', 'crb_call_to_action_link_name', 'Link name' ),
					Field::make( 'text', 'crb_call_to_action_link', 'Link URL' )
				))
		));
}

add_action( 'carbon_fields_register_fields', 'crb_attach_custom_home_options' );
