<?php
/**
 * Template part for displaying workshop previews
 *
 * @package snae
 */
?>

<div class="workshop-preview">
	<img class="preview-photo" src="<?php echo snae_get_first_workshop_photo_url(get_the_ID(), 'workshop-preview') ?>" alt="workshop photo">
	<div class="details">
		<h3 class="title"><a href="<?php echo get_the_permalink() ?>"><?php echo get_the_title() ?></a></h3>
		<p><?php echo carbon_get_post_meta(get_the_ID(), 'crb_workshop_short_desc') ?></p>
	</div>
</div>
