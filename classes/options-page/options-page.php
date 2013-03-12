<div class="wrap">
<?php screen_icon(); ?>
<h2 style="margin: 0 0 25px 0">WP Multi File Uploader Options</h2>
<?php
$wpmfu_options = new WPMFU_Options();
$wpmfu_options->save_options();
$options = $wpmfu_options->get_options();
?>
<form method="post" action="<?php admin_url( 'options-general.php?page=wp-multi-file-uploader' ); ?>">
	<label for="wpmfu_css_stylesheet">CSS Override</label>
	<input type="text" name="wpmfu_css_stylesheet" id="wpmfu_css_stylesheet" value="" placeholder="http://site.com/path/to/override.css" size="30">
	<span class="description">This will allow you to override the default plugin styles easily.</span>
	<?php submit_button(); ?>
</form>
</div><!-- /.wrap -->