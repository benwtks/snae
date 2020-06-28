<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package snae
 */

get_header();

while ( have_posts() ) : ?>
<div id="primary" class="content-area news-wrapper">
		<main id="main" class="site-main">
		<?php
		the_post();
		get_template_part( 'template-parts/content', "single" );
		?>
		</main>
	</div>
<?php
// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) :
	echo '<div class="comments-wrapper">';
	echo '<div class="news-wrapper">';
	comments_template();
	echo '</div>';
	echo '</div>';
endif;

endwhile; // End of the loop.

get_footer();
