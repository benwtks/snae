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
