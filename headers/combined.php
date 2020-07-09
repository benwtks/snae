<?php $bar = carbon_get_theme_option('crb_show_top_bar');

if ($bar) { ?>

<header id="masthead" class="site-header combined bar-shown">
	<?php
	include get_theme_file_path('headers/notification.php');
	include get_theme_file_path('headers/search_bar.php');
	if ($bar) {
		include get_theme_file_path('headers/bar.php');
	}

} else { ?>

<header id="masthead" class="site-header combined">
	<?php
	include get_theme_file_path('headers/notification.php');
	include get_theme_file_path('headers/search_bar.php');

} ?>
	<div class="site-branding section">
		<div class="content-wrapper">
			<div class="logo">
				<?php if (has_custom_logo()): ?>
					<?php the_custom_logo() ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else: ?>
					<h1 class="site-title no-img"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php endif; ?>
			</div>
			<div class="links">
				<nav class="main-navigation main-desktop-nav">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav>
				<div class="user-links nav-icons">
					<?php if (!$bar) : ?>
					<a class="nav-icon" id="cart-icon" href="<?php echo snae_ecommerce_get_cart_url() ?>"><i class="dripicons-cart"></i></a>
					<a class="nav-icon" id="search-icon" ><i class="dripicons-search"></i></a>
					<?php endif; ?>

					<button class="nav-icon dripicons-menu hamburger-menu-button" id="menu-toggle" aria-controls="primary-menu" aria-expanded="false"></button>
				</div>
			</div>
		</div>
	</div>
	<nav class="main-navigation section combined">
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
