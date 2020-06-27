<div class="top-bar">
	<div class="social-links nav-icons">
		<?php
		$fb = carbon_get_theme_option('crb_facebook');
		$ig = carbon_get_theme_option('crb_instagram');
		$in = carbon_get_theme_option('crb_linkedin');
		$tw = carbon_get_theme_option('crb_twitter');
		?>

		<a class="nav-icon" href="<?php echo $fb; ?>"><i class="fab fa-facebook"></i></a>
		<a class="nav-icon" href="<?php echo $ig; ?>"><i class="fab fa-instagram"></i></a>
		<a class="nav-icon" href="<?php echo $in; ?>"><i class="fab fa-linkedin"></i></a>
		<a class="nav-icon" href="<?php echo $tw; ?>"><i class="fab fa-twitter"></i></a>
	</div>
	<div class="user-links nav-icons">
		<a class="nav-icon" id="cart-icon" href="#"><i class="dripicons-cart"></i></a>
		<a class="nav-icon" id="search-icon" href="#"><i class="dripicons-search"></i></a>
	</div>
</div>
