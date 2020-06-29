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
			<div class="explore" id="subscribe">
			<?php
			$mc_api = carbon_get_theme_option('crb_mc_api_key');
			$list_id = carbon_get_theme_option('crb_mc_list_id');

			if ($mc_api && $list_id) :

			$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);

			if ($_GET['subbed'] == "success") {
				echo '<div class="newsletter success">';
			} else if ($_GET['subbed'] == "failed") {
				echo '<div class="newsletter failed">';
			} else if ($_GET['subbed'] == "exists") {
				echo '<div class="newsletter exists">';
			} else if ($_GET['subbed'] == "api") {
				echo '<div class="newsletter api">';
			} else if ($_GET['subbed'] == "unsubscribed") {
				$mc_form_url = carbon_get_theme_option('crb_mc_form_url');
				echo '<div class="newsletter unsubscribed">';
			} else {
				echo '<div class="newsletter">';
			}
			?>
					<p id="failed">Subscription failed, please try again or get in touch</p>
					<p id="exists">Guess we've got a fan! Subscription failed, already subscribed</p>
					<div id="unsubscribed">
						<h3>Sorry, we can't resubscribe you from here</h3>
						<p>Please use <a href="<?php $mc_form_url ?>">this form</a> to resubscribe</p>
					</div>
					<div id="api">
						<h3>Subscription failed</h3>
						<p>API Key misconfigured, please get in touch to let us know</p>
					</div>
					<div id="successfully-subscribed">
						<h3>Thanks for subscribing!</h3>
						<p>Please check your email to confirm your subscription</p>
					</div>
					<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
						<input type="email" name="email" id="email" placeholder="Email address" required>
						<input type="hidden" name="action" value="newsletter_form">
						<input type="submit" value="Subscribe" class="button">
					</form>
				</div>
				<?php endif; ?>
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
