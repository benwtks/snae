<?php

$notification = carbon_get_theme_option('crb_notification');
$link = carbon_get_theme_option('crb_notification_link');
$colour = carbon_get_theme_option('crb_notification_style');

if ($notification) {
	echo '<div class="notification ' . $colour . '"><span>';
	echo $notification;

	if ($link) {
		echo ' <a href="' . $link . '" alt="learn-more">Learn more</a>';
	}

	echo '</span></div>';
}

?>
