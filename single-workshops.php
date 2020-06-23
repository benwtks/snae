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
						<span><?php echo snae_get_workshop_artist($post_id) ?></span>
					</div>
					<div class="photos">
						<div class="thumbnails">
							<?php snae_print_workshop_thumbnails(get_the_ID(), 100, "workshop thumbnail"); ?>
						</div>
						<img id="featured" class="workshop-photo" src="<?php echo snae_get_first_workshop_photo_url(get_the_ID()) ?>" >
					</div>
				</div>
				<div class="ecommerce-details">
				</div>
			</div>
		</main>
	</div>
