<?php
/**
 * The template for displaying a single workshop
 *
 * This is the template that displays a workshop using
 * the custom workshop page type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package snae
 */

get_header();
?>
	<div id="primary" class="content-area content-wrapper">
		<main id="main" class="site-main">
			<div class="workshop-top">
				<div class="workshop-details">
					<div class="meta">
						<h1 class="title"><?php echo(get_the_title()) ?></h1>
						<?php echo snae_get_workshop_artist($post_id) ?>
					</div>
					<div class="photos">
						<div class="thumbnails">
							<?php snae_print_workshop_thumbnails(get_the_ID(), 100, "workshop thumbnail"); ?>
						</div>
						<?php
						$first_url = snae_get_first_workshop_photo_url(get_the_ID());
						$srcset = snae_get_workshop_photos_srcset(get_the_ID());

						echo "<img id='featured' class='workshop-photo' src='" . $first_url . "' srcset='" . $srcset . "' >"
						?>
					</div>
				</div>
				<div class="ecommerce-details">
				</div>
			</div>
		</main>
	</div>

<?php get_footer(); ?>
