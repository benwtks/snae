<?php
/**
 * The template for displaying a single artist profile
 *
 * This is the template that displays an artist using
 * the custom artist page type
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package snae
 */

get_header();
?>
	<div id="primary" class="content-area content-wrapper">
		<main id="main" class="site-main">
			<div class="artist-header">
				<div class="about">
					<img src="https://picsum.photos/200" alt="artist photo" />
					<div class="intro">
						<h1 class="name"><?php echo(get_the_title()) ?></h1>
					</div>
				</div>
		</main>
	</div>

<?php
get_footer();
