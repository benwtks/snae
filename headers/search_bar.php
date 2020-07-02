<?php $notification = carbon_get_theme_option('crb_notification'); ?>

<div class="search-bar <?php if ($notification) { echo 'notification-shown'; } ?>">
	<div class="search-wrapper">
		<form action="/" method="get" role="search">
			<span class="screen-reader-text">Search for</span>
			<input id="search-box" type="text" name="s" placeholder="Search" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
			<button type="submit" value="Search"><i class="dripicons-search"></i></button>
		</form>
		<button id="close-search"><i class="dripicons-cross"></i></button>
	</div>
</div>
