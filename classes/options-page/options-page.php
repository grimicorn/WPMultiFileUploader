<div class="wrap">
<?php screen_icon(); ?>
<h2>WP Multi File Uploader</h2>
<form method="post" action="options.php">
	<?php
	settings_fields( 'wpmfu_plugin_options' );
	do_settings_sections( 'wpmfu-plugin' );
	submit_button(); ?>
</form>
</div><!-- /.wrap -->