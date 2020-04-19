<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package snae
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'snae' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding section">
			<div class="content-wrapper">
				<div class="social-links nav-icons">
					<a class="nav-icon" href="#"><i class="fab fa-facebook"></i></a>
					<a class="nav-icon" href="#"><i class="fab fa-instagram"></i></a>
				</div>
				<div class="logo">
					<?php the_custom_logo(); ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				</div>
				<div class="user-links nav-icons">
					<a class="nav-icon" id="cart-icon" href="#"><i class="dripicons-cart"></i></a>
					<a class="nav-icon" id="search-icon" href="#"><i class="dripicons-search"></i></a>
					<button class="nav-icon dripicons-menu" id="menu-toggle" aria-controls="primary-menu" aria-expanded="false"></button>
				</div>
			</div>
		</div>

		<nav class="main-navigation section">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'content-wrapper'
				)
			);
			?>
		</nav>
	</header>

	<div id="content" class="site-content">
