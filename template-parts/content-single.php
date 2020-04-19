<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package snae
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php snae_posted_on(); snae_posted_by(); ?>
		</div>
	</header>

	<?php snae_post_thumbnail(); ?>
	<div class="entry-content">
		<?php the_content() ?>
	</div>
</article>
