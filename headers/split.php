<header id="masthead" class="site-header split">
	<div class="site-branding section">
		<div class="content-wrapper">
			<div class="social-links nav-icons">
				<a class="nav-icon" href="#"><i class="fab fa-facebook"></i></a>
				<a class="nav-icon" href="#"><i class="fab fa-instagram"></i></a>
			</div>
			<div class="logo">
				<?php if (has_custom_logo()): ?>
					<?php the_custom_logo() ?>
				<?php else: ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php endif; ?>
			</div>
			<div class="user-links nav-icons">
				<a class="nav-icon" id="cart-icon" href="#"><i class="dripicons-cart"></i></a>
				<a class="nav-icon" id="search-icon" href="#"><i class="dripicons-search"></i></a>
				<button class="nav-icon dripicons-menu" id="menu-toggle" aria-controls="primary-menu" aria-expanded="false"></button>
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
