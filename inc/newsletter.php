<?php

function snae_get_mc_url_endpoint($list_id, $api_key, $api_v) {
	if ($list_id && $api_key) {
		$data_center = substr(strrchr($api_key, '-'), 1);
		$domain = 'https://' . $data_center . '.api.mailchimp.com';

		$endpoint = $domain . '/' . $api_v . '/lists/' . $list_id . '/members/';
	}

	return $endpoint;
}

function handle_subscribe_post_request() {
	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
	$email = $_POST['email'];

	$list_id = carbon_get_theme_option('crb_mc_list_id');
	$api_key = carbon_get_theme_option('crb_mc_api_key');

	$mc_url_endpoint = snae_get_mc_url_endpoint($list_id, $api_key, '3.0');

	$sent_from = strtok(wp_get_referer(), "?");

	if ($email && $mc_url_endpoint) {
		$mc_response = wp_remote_post($mc_url_endpoint, array (
			'method'      => 'POST',
			'headers'     => array (
				'Authorization' => 'auth ' . $api_key
			),
			'body'        => wp_json_encode(array (
				'email_address' => $email,
				'status'        => 'pending'
			))
		));

		$body_title = json_decode(wp_remote_retrieve_body($mc_response), true)['title'];

		if (strpos(strtolower($body_title), "api key") !== false) {
			wp_redirect($sent_from . '?subbed=api#subscribe');
			die();
		}
		
		if (strpos(strtolower($body_title), "exists") !== false
			|| strpos(strtolower($body_title), "already") !== false) {
			wp_redirect($sent_from . '?subbed=exists#subscribe');
			die();
		}
		
		if (!is_wp_error($mc_response) && $code == 200) {
			wp_redirect($sent_from . '?subbed=success#subscribe');
			die();
		}
	}

	wp_redirect($sent_from . '?subbed=failed&?body=' . $body_title . '#subscribe');
	die();
}

add_action('admin_post_nopriv_newsletter_form', 'handle_subscribe_post_request');
add_action('admin_post_newsletter_form', 'handle_subscribe_post_request');
