<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package snae
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-preview'); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

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

	<?php if (is_singular() ):
		snae_post_thumbnail(); ?>
		<div class="entry-content">
			<?php the_content() ?>
		</div>
	<?php else: ?>
		<div class="entry-content">
			<?php the_excerpt() ?>
		</div>
	<?php endif; ?>
</article>
