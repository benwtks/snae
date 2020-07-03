<?php
/**
 * The template for displaying a custom home page
 *
 * @package snae
 */

get_header();

while ( have_posts() ) : the_post(); ?>
<div id="primary" class="content-area content-wrapper page-wrapper">
	<main id="main" class="site-main">
		<div class="home-top">
			<h1><?php echo carbon_get_post_meta(get_the_ID(), 'crb_homepage_top_title')?></h1>
			<p><?php echo carbon_get_post_meta(get_the_ID(), 'crb_homepage_top_body')?></p>
		</div>
		<?php
		$featured_pages = carbon_get_post_meta(get_the_ID(), 'crb_homepage_features');

		foreach ($featured_pages as $page) {
			$title = get_the_title($page['crb_homepage_feature']);
			$img_url = wp_get_attachment_image_url($page['crb_homepage_feature_img']);

			echo '<div class="home-feature">';
			echo '<img src="' . $img_url . '" alt="page image">';
			echo '<h2>' . $title . '</h2>';
			echo '<p>' . $page['crb_homepage_feature_body'] . '</p>';
			echo '</div>';
		}

		$workshops = carbon_get_post_meta(get_the_ID(), 'crb_homepage_workshops');

		if ($workshops) {
			echo '<div class="home-workshops">';
			echo '<h2>Workshops</h2>';
			echo '<div class="workshop-previews">';
			foreach ($workshops as $workshop) {
				$preview = snae_ecommerce_get_workshop_preview($workshop['crb_homepage_workshop']);

				if ($preview) {
					echo $preview;
				}
			}
			echo '</div>';
			echo '</div>';
		}

		$artists = carbon_get_post_meta(get_the_ID(), 'crb_homepage_artists');

		if ($artists) {
			echo '<div class="home-artistss">';
			echo '<h2>Artists</h2>';
			echo '<div class="artist-previews">';
			foreach ($artists as $artist) {
				$preview = snae_ecommerce_get_artist_preview($artist['crb_homepage_artist']);

				if ($preview) {
					echo $preview;
				}
			}
			echo '</div>';
			echo '</div>';
		}

		$action_title = carbon_get_post_meta(get_the_ID(), 'crb_call_to_action_title');
		$action_body = carbon_get_post_meta(get_the_ID(), 'crb_call_to_action_body');
		$action_links = carbon_get_post_meta(get_the_ID(), 'crb_call_to_action_links');

		if ($action_title && $action_body) {
			echo '<div class="home-call-to-action">';
			echo '<h2>' . $action_title . '</h2>';
			echo '<p>' . $action_body . '</p>';

			if ($action_links) {
				echo '<div class="action-links">';

				foreach ($action_links as $action) {
					echo '<a href="' . $action['crb_call_to_action_link'] . '">';
					echo $action['crb_call_to_action_link_name'];
					echo '</a>';
				}
				echo '</div>';
			}
			echo '</div>';
		}

		/* get_template_part( 'template-parts/content', 'page' ); */
		?>
	</main>
</div>
<?php
endwhile; // End of the loop.

get_footer();

