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
	<!-- closing content div -->
	</div>

	<!-- site footer -->
	<footer class="site-footer">
		<div class="content-wrapper">
			<div class="company-details">
				<div class="logo">
					<?php
					$title_enabled = carbon_get_theme_option('crb_show_footer_title');
					$logo_enabled = carbon_get_theme_option('crb_show_footer_logo');

					if ($logo_enabled && has_custom_logo()) {
						the_custom_logo();
					}

					if ($title_enabled) {
						$home_url = esc_url (home_url( '/' ));
						$name = get_bloginfo( 'name' );

						echo '<h2 class="site-title"><a href="' . $home_url . '" rel="home">' . $name . '</a></h2>';
					}
					?>
				</div>
				<?php
				if ($address = carbon_get_theme_option('crb_theme_address')) : ?>
					<div class="address">
						<span class="detail-value"><?php echo nl2br ($address) ?></span>
					</div>
				<?php
				endif;
				if ($phone = carbon_get_theme_option('crb_theme_telephone')) : ?>
					<div class="telephone-no">
						<span class="detail-title">Telephone:</span>
						<span class="detail-value"><?php echo $phone ?></span>
					</div>
				<?php
				endif;
				if ($email = carbon_get_theme_option('crb_theme_email')) : ?>
					<div class="email">
						<span class="detail-title">Email:</span>
						<span class="detail-value">
							<a href="mailto:<?php echo carbon_get_theme_option('crb_theme_email') ?>">
								<?php echo carbon_get_theme_option('crb_theme_email') ?>
							</a>
						</span>
					</div>
				<?php endif; ?>
				<div class="copyright">
					<span>© <?php echo date("Y"), " ", bloginfo('name') ?> | All rights reserved</span>
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
							echo ('<h2 class="footer-nav-title">'. $menu_name. '</h2>');
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
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
