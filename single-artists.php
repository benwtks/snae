<?php
/**
 * The template for displaying a single artist profile
 *
 * This is the template that displays an artist using
 * the custom artist page type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package snae
 */

get_header();
?>
	<div id="primary">
		<main id="main" class="site-main">
			<div class="artist-about">
				<div class="content-area content-wrapper artist-wrapper">
					<div class="artist-header">
						<div class="artist-details">
							<?php echo (snae_get_artist_image(get_the_ID(), 120, 'artist-photo')) ?>
							<div class="intro">
								<h1 class="name"><?php echo(get_the_title()) ?></h1>
								<span><?php echo(carbon_get_post_meta(get_the_ID(), 'crb_job')) ?></span>
							</div>
						</div>
						<div class="links">
							<?php
							function print_artist_icon($crb_name) {
								$site = substr(strrchr($crb_name, "_"), 1);
								$class = $site == "website" ? "dripicons-web" : "fab fa-" . $site;

								$link = carbon_get_post_meta(get_the_ID(), $crb_name);

								if ($link) {
									echo "<a class='artist-icon " . $site . "' href='" . $link . "'><i class='" . $class . "'></i></a>";
								}
							}

							print_artist_icon('crb_artist_facebook');
							print_artist_icon('crb_artist_twitter');
							print_artist_icon('crb_artist_instagram');
							print_artist_icon('crb_artist_etsy');
							?>
						</div>
					</div>
					<div class="artist-bio">
						<?php
						$bio = carbon_get_post_meta(get_the_ID(), 'crb_bio');

						foreach (explode(PHP_EOL, trim($bio, PHP_EOL)) as $paragraph) {
							echo ("<p>" . $paragraph . "</p>");
						}
						?>
					</div>
					<div class="artist-gallery">
						<?php echo do_shortcode(carbon_get_post_meta(get_the_ID(), 'crb_artist_gallery_shortcode')) ?>
					</div>
				</div>
			</div>
			<div class="workshops">
				<div class="content-area content-wrapper artist-wrapper">
					<h2>Workshops</h2>
					<div class="workshop-previews">
					<?php
						$workshops = new WP_Query( array(
								'post_type' => 'workshops',
								'posts_per_page' => -1
						));

						if ( $workshops->have_posts() ) {
							while ( $workshops->have_posts()) : $workshops->the_post();
								get_template_part('template-parts/workshop');
							endwhile;
						}
					?>
					</div>
				</div>
			</div>
		</main>
	</div>

<?php get_footer(); ?>
