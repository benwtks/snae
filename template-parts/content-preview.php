<?php
/**
 * Template part for displaying post previews
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package snae
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-preview'); ?>>
	<header class="entry-header">
		<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				snae_posted_on();
				snae_posted_by();
				?>
			</div>
		<?php endif; ?>
	</header>

	<div class="entry-content">
		<?php the_excerpt() ?>
	</div>
</article>
