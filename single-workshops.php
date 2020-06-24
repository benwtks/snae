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
			<div class="workshop-meta">
				<h1 class="title"><?php echo(get_the_title()) ?></h1>
				<?php echo snae_get_workshop_artist($post_id) ?>
			</div>
			<div class="workshop-top">
				<div class="workshop-photos">
					<div class="thumbnails">
						<?php snae_print_workshop_thumbnails(get_the_ID(), 100, "workshop thumbnail"); ?>
					</div>
					<?php
					$first_url = snae_get_first_workshop_photo_url(get_the_ID());

					echo "<img id='featured' class='workshop-photo' src='" . $first_url . "' >"
					?>
				</div>
				<div class="ecommerce-details">
						<div class="intro">
							<h2 class="title"><?php echo(get_the_title()) ?></h2>
							<p class="description" ><?php echo carbon_get_post_meta(get_the_ID(), 'crb_workshop_longer_desc') ?></p>
						</div>
						<div class="buy">
							<span class="price"><span class="currency">£</span>
									<?php echo carbon_get_post_meta(get_the_ID(), 'crb_workshop_price') ?>
							</span>
							<button class="buy-now">Buy now</a>
						</div>
						<ul class="workshop-guarantees">
							<?php
							$guarantees = carbon_get_post_meta(get_the_ID(), 'crb_workshop_guarantees');
							
							foreach ($guarantees as $g) {
								echo '<li class="guarantee">';
								echo $g['crb_workshop_guarantee'];
								echo '</li>';
							}

							?>
						</ul>
				</div>
			</div>
		</main>
	</div>

<?php get_footer(); ?>
