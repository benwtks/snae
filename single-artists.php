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
	<div id="primary" class="content-area content-wrapper">
		<main id="main" class="site-main">
			<div class="artist-about">
				<div class="artist-header">
					<div class="details">
						<?php
						require_once ABSPATH . '/wp-admin/includes/image.php';

						function generate_cropped_path($photo_ID, $file) {
							$photo_folder = substr($file, 0, strrpos($file, "/")) . "/";
							$photo_file_type = strrchr($file, '.');

							return "uploads/" . $photo_folder . $photo_ID . "-artist-photo" . $photo_file_type;
						}

						$photo_ID = carbon_get_post_meta(get_the_ID(), 'crb_artist_photo');
						$file = wp_get_attachment_metadata($photo_ID)['file'];

						$cropped_path = generate_cropped_path($photo_ID, $file);
						$cropped_url = content_url($cropped_path);

						if (!file_exists(WP_CONTENT_DIR . "/" . $cropped_path)) {
							$image = wp_get_image_editor(WP_CONTENT_DIR . '/uploads/' . $file);

							if (! is_WP_error($editor)) {
								$image->resize(400,400, array( 'center', 'center'));
								$image->save("wp-content/" . $cropped_path);
							}
						}

						echo ("<img width='120' height='120' class='artist-photo' src='" . $cropped_url . "' alt='artist photo'/>");
						?>
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
					<?php echo do_shortcode(carbon_get_Post_meta(get_the_ID(), 'crb_artist_gallery_shortcode')) ?>
				</div>
			</div>
		</main>
	</div>

<?php
get_footer();
