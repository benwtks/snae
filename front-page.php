<?php
/**
 * The template for displaying a custom home page
 *
 * @package snae
 */

get_header();

while ( have_posts() ) : the_post();


?>

<div id="primary" class="content-area front-page">
	<main id="main" class="site-main">
		<?php
		$home_title = carbon_get_post_meta(get_the_ID(), 'crb_homepage_top_title');
		$top_body = carbon_get_post_meta(get_the_ID(), 'crb_homepage_top_body');
		$background = wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'crb_homepage_top_image'));

		if ($home_title): ?>
		<div class="home-top" style="background-image: url(<?php echo $background ?>)">
		<div class="top-wrapper content-wrapper page-wrapper">
				<h1><?php echo carbon_get_post_meta(get_the_ID(), 'crb_homepage_top_title')?></h1>
				<?php
				if ($top_body) {
					echo '<p>' . $top_body . '</p>';
				}
				?>
			</div>
		</div>
		<?php
		endif;

		if (!empty(get_the_content())) {
			echo '<div class="home-content">';
			echo '<div class="content-wrapper page-wrapper">';
			the_content();
			echo '</div>';
			echo '</div>';
		}

		$featured_pages = carbon_get_post_meta(get_the_ID(), 'crb_homepage_features');

		if ($featured_pages) {
			echo '<div class="featured-pages">';

			foreach ($featured_pages as $page) {
				$title = get_the_title($page['crb_homepage_feature']);
				$img_url = wp_get_attachment_image_url($page['crb_homepage_feature_img'], 'home');
				$page_url = get_page_link($page['crb_homepage_feature']);

				echo '<div class="home-feature">';
				echo '<div class="home-feature-wrapper content-wrapper page-wrapper">';
				echo '<img src="' . $img_url . '" alt="page image">';
				echo '<div class="feature-details">';
				echo '<h2>' . $title . '</h2>';
				echo '<p>' . $page['crb_homepage_feature_body'] . '</p>';
				echo '<a href="' . $page_url . '" alt="full page">Learn more<i class="dripicons-chevron-right"></i></a>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			}

			echo '</div>';
			echo '</div>';
		}

		$workshops = carbon_get_post_meta(get_the_ID(), 'crb_homepage_workshops');

		if ($workshops) {
			echo '<div class="home-workshops">';
			echo '<div class="home-workshops-wrapper page-wrapper content-wrapper">';
			echo '<div class="feature-header-wrapper">';
			echo '<div class="info">';
			echo '<h2>Workshops</h2>';
			echo '<a href="' . get_post_type_archive_link('workshop') . '" alt="full page">Learn more<i class="dripicons-chevron-right"></i></a>';
			echo '</div>';
			echo '<p>' . carbon_get_post_meta(get_the_ID(), 'crb_homepage_workshops_intro') . '</p>';
			echo '</div>';
			echo '<div class="workshop-previews">';
			foreach ($workshops as $workshop) {
				$preview = snae_ecommerce_get_workshop_preview($workshop['crb_homepage_workshop']);

				if ($preview) {
					echo $preview;
				}
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}

		$artists = carbon_get_post_meta(get_the_ID(), 'crb_homepage_artists');

		if ($artists) {
			echo '<div class="home-artists">';
			echo '<div class="home-artists-wrapper page-wrapper content-wrapper">';
			echo '<div class="feature-header-wrapper">';
			echo '<div class="info">';
			echo '<h2>Artists</h2>';
			echo '<a href="' . get_post_type_archive_link('artist') . '" alt="full page">Learn more<i class="dripicons-chevron-right"></i></a>';
			echo '</div>';
			echo '<p>' . carbon_get_post_meta(get_the_ID(), 'crb_homepage_workshops_intro') . '</p>';
			echo '</div>';
			echo '<div class="artist-previews">';
			foreach ($artists as $artist) {
				$preview = snae_ecommerce_get_artist_preview($artist['crb_homepage_artist']);

				if ($preview) {
					echo $preview;
				}
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}

		$action_title = carbon_get_post_meta(get_the_ID(), 'crb_call_to_action_title');
		$action_body = carbon_get_post_meta(get_the_ID(), 'crb_call_to_action_body');
		$action_links = carbon_get_post_meta(get_the_ID(), 'crb_call_to_action_links');

		if ($action_title && $action_body) {
			echo '<div class="home-call-to-action">';
			echo '<div class="home-call-to-action-wrapper page-wrapper content-wrapper">';
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
			echo '</div>';
		}

		?>
	</main>
</div>
<?php
endwhile; // End of the loop.

get_footer();

