#WP Multi File Uploader

**Description:** Wordpress plugin that allows a user to submit multiple files from a form on your Wordpress site via AJAX to Wordpress default uploads folder and adds an attachment to the
Wordpress media gallery.  Includes a shortcode `[wp-multi-file-uploader]` for use in a form created in the post editor and a function for use in a form in a template file `wp_multi_file_uploader();`.

**Plugin Home Page:** [http://wordpress.org/extend/plugins/wp-multi-file-uploader/](http://wordpress.org/extend/plugins/wp-multi-file-uploader/)

**What this plugin does not do:** This plugin does not make sure that the user is allowed to add a file but it does restrict the [file types](http://codex.wordpress.org/Uploading_Files#About_Uploading_Files_on_Dashboard) to be the same as Wordpress and file size(2mb).  It also does not play nice at the moment with Wordpress form building plugins, if you integrate it with one please let me know and submit a pull request this is a feature I would like to eventually get integrated.

**Thanks to:** This project incorporates the excellent file uploader at [https://github.com/valums/file-uploader](https://github.com/valums/file-uploader), if your project is included and I do not have you added please let me know, thank you.

If you have any issues please submit an [issue](https://github.com/DHolloran/WPMultiFileUploader/issues/new) or fix it/submit a pull request I will try to handle it ASAP. You an also contact me at [Dan@danholloran.com](mailto:dan@danholloran.com).

##Getting Started
To get started with WP Multi File Uploader you can download it directly from [GitHub here](https://github.com/DHolloran/WPMultiFileUploader/archive/master.zip), search for WP Multi File Uploader in your administrator section's Plugins > Add New, or you can download it from the [Wordpress plugins here](http://wordpress.org/extend/plugins/wp-multi-file-uploader/).

###Wordpress Plugin Directory Instructions
1. search for WP Multi File Uploader in your administrator section's Plugins > Add New
2. install &amp; Activate WP Multi File Uploader
3. Place the shortcode `[wp-multi-file-uploader]` in your form somewhere in either in the post editor or you can use `wp_multi_file_uploader();` in your theme.
4. For each file uploaded the plugin will add a hidden input field `name="wp_multi_file_uploader_[NUMBER]"` with [NUMBER] representing the amount of files starting at 1 and the value will be the uploads attachment id


###Manual Install Instructions</h3>
1. Unzip your download and place in wp-content/plugins/
2. Activate WP Multi File Uploader in the Wordpress Admin area
3. Place the shortcode `[wp-multi-file-uploader]` in your form somewhere in either in the post editor or `wp_multi_file_uploader();` in your template file.
4. For each file uploaded the plugin will add a hidden input field `name="wp_multi_file_uploader_[NUMBER]"` with [NUMBER] representing the amount of files starting at 1 and the value will be the uploads attachment id

##Examples
###Example Using The Shortcode
	<!-- In The Post Editor -->
	<form action="?" method="post" accept-charset="utf-8">
		<label for="unique_name">Your Name:</label>
		<input type="text" name="unique_name" id="unique_name" value="" placeholder="Your Name">
		[wp-multi-file-uploader]
		<input type="submit" name="submit" value="Submit">
	</form>
	<!-- END In The Post Editor -->

<h3>Example Using The Template Function</h3>
	<!-- In a Template File -->
	<form action="?" method="post" accept-charset="utf-8">
		<label for="unique_name">Your Name:</label>
		<input type="text" name="unique_name" id="unique_name" value="" placeholder="Your Name">
		<?php wp_multi_file_uploader(); ?>
		<input type="submit" name="submit" value="Submit">
	</form>
	<!-- END In a Template File -->