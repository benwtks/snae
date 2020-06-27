<?php

function handle_subscribe_post_request() {
	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	wp_redirect(wp_get_referer() . '?subbed=1#subscribe');
	die();
}

add_action('admin_post_nopriv_newsletter_form', 'handle_subscribe_post_request');
add_action('admin_post_newsletter_form', 'handle_subscribe_post_request');
