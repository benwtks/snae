<div class="top-bar">
	<div class="social-links nav-icons">
		<?php
		$fb = carbon_get_theme_option('crb_facebook');
		$ig = carbon_get_theme_option('crb_instagram');
		$in = carbon_get_theme_option('crb_linkedin');
		$tw = carbon_get_theme_option('crb_twitter');

		if ($fb) { echo '<a class="nav-icon" href="' . $fb . '"><i class="fab fa-facebook"></i></a>'; }
		if ($ig) { echo '<a class="nav-icon" href="' . $ig . '"><i class="fab fa-instagram"></i></a>'; }
		if ($in) { echo '<a class="nav-icon" href="' . $in . '"><i class="fab fa-linkedin"></i></a>'; }
		if ($tw) { echo '<a class="nav-icon" href="' . $tw . '"><i class="fab fa-twitter"></i></a>'; }
		?>
	</div>
	<div class="user-links nav-icons">
		<a class="nav-icon" id="cart-icon" href="#"><i class="dripicons-cart"></i></a>
		<a class="nav-icon" id="event-icon" href="<?php echo carbon_get_theme_option("crb_event_url")?>"><i class="dripicons-calendar"></i></a>
	</div>
</div>
