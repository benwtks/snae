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
		<?php
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<span class="posted_on"><?php snae_posted_on() ?></span>
				<span class="posted_by"><?php snae_posted_by() ?></span>
			</div>
		<?php endif; ?>
	</header>

	<div class="entry-content">
		<?php the_content() ?>
	</div>
</article>
