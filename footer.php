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
				<span></span>
			</div>
			<span class="telephone-no"></span>
			<span class="email"></span>
			<span class="copyright"></span>
		</div>
		<div class="explore">
			<div class="newsletter">
			</div>
			<div class="links">
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
