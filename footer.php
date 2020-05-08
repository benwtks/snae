<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package snae
 */

?>

	</div>

	<footer class="site-footer">
		<div class="company-details">
			<div class="logo">
					<?php if (has_custom_logo()): ?>
						<?php the_custom_logo() ?>
					<?php else: ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php endif; ?>
			</div>
			<div class="address">
				<span><?php echo nl2br (carbon_get_theme_option('crb_theme_address')) ?></span>
			</div>
			<div class="telephone-no">
				<span class="detail-title">Telephone:</span>
				<span class="detail-value"><?php echo carbon_get_theme_option('crb_theme_telephone')?></span>
			</div>
			<div class="email">
				<span class="detail-title">Email:</span>
				<span class="detail-value">
					<a href="mailto:<?php echo carbon_get_theme_option('crb_theme_email') ?>">
						<?php echo carbon_get_theme_option('crb_theme_email') ?>
					</a>
				</span>
			</div>
			<div class="copyright">
				<span>©<?php echo date("Y"), " ", bloginfo('name') ?> | All rights reserved</span>
			</div>
		</div>
		<div class="explore">
			<div class="newsletter">
			</div>
			<div class="links">
				<?php
				function snae_footer_nav($menu_location) {
					$menu_name = wp_get_nav_menu_name($menu_location);

					if (!empty($menu_name)) {
						echo ('<div class="footer-nav">');
						echo ("<h1>". $menu_name. "</h1>");
						wp_nav_menu( array(
							'theme_location' => $menu_location,
							'container-class' => 'footer_nav'
						));
						echo ("</div>");
					}
				}

				snae_footer_nav('footer_1');
				snae_footer_nav('footer_2');
				snae_footer_nav('footer_3');
				snae_footer_nav('footer_4');
				?>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
