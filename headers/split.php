<?php $bar = carbon_get_theme_option('crb_show_top_bar'); ?>

<?php if ($bar) : ?>

<header id="masthead" class="site-header split bar-shown">
	<?php
	include get_theme_file_path('headers/notification.php');
	include get_theme_file_path('headers/search_bar.php');
	if ($bar) { include get_theme_file_path('headers/bar.php'); }
	?>

<?php else : ?>

<header id="masthead" class="site-header split">
<?php
	include get_theme_file_path('headers/notification.php');
	include get_theme_file_path('headers/search_bar.php');

endif; ?>

	<div class="site-branding section">
		<div class="content-wrapper">

			<?php if (!$bar) : ?>
			<div class="social-links nav-icons">
				<?php $fb = carbon_get_theme_option('crb_facebook');
					  $ig = carbon_get_theme_option('crb_instagram'); ?>

				<a class="nav-icon" href="<?php echo $fb; ?>"><i class="fab fa-facebook"></i></a>
				<a class="nav-icon" href="<?php echo $ig; ?>"><i class="fab fa-instagram"></i></a>
			</div>
			<?php endif; ?>

			<div class="logo">
				<?php if (has_custom_logo()): ?>
					<?php the_custom_logo() ?>
				<?php else: ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php endif; ?>
			</div>

			<div class="user-links nav-icons">
			<?php if (!$bar) : ?>
				<a class="nav-icon" id="cart-icon" href="<?php echo snae_ecommerce_get_cart_url() ?>"><i class="dripicons-cart"></i></a>
				<a class="nav-icon" id="search-icon" ><i class="dripicons-search"></i></a>
			<?php endif; ?>

				<button class="nav-icon dripicons-menu hamburger-menu-button" id="menu-toggle" aria-controls="primary-menu" aria-expanded="false"></button>
			</div>

		</div>
	</div>
	<nav class="main-navigation section">
		<div class="content-wrapper">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</div>
	</nav>
</header>
