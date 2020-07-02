<?php
/**
 * Template part for displaying single pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package snae
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-page'); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<span class="posted_on meta-icon"><i class="dripicons-calendar"></i><?php snae_posted_on($natural = FALSE) ?></span>
			<span class="posted_by meta-icon"><i class="dripicons-user"></i><?php snae_posted_by($natural = FALSE) ?></span>
			<span class="comments meta-icon"><i class="dripicons-message"></i><?php snae_comments_number() ?></span>
			<span class="categories meta-icon">
				<i class="dripicons-tags"></i>
				<?php
				$categories = get_the_category(get_the_ID());

				foreach ($categories as $cat) {
					echo '<a href="' . get_category_link($cat->cat_ID) . '">';
					echo $cat->cat_name;
					echo '</a>';
				}
				?>
			</span>
		</div>
	</header>

	<?php snae_post_thumbnail(); ?>
	<div class="entry-content">
		<?php the_content() ?>
	</div>
</article>
