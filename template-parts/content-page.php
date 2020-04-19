<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package snae
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header>

	<?php snae_post_thumbnail(); ?>

	<div class="page-content">
		<?php the_content(); ?>
	</div>
</div>
