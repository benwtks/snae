<header id="masthead" class="site-header combined">
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
				<nav class="main-navigation">
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
					<a class="nav-icon" id="search-icon" href="#"><i class="dripicons-search"></i></a>
					<button class="nav-icon dripicons-menu" id="menu-toggle" aria-controls="primary-menu" aria-expanded="false"></button>
				</div>
			</div>
		</div>
	</div>
</header>
