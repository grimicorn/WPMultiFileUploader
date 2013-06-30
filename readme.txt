=== Plugin Name ===
Contributors: dholloran
Donate link: http://danholloran.com/
Tags: upload, form, ajax
Requires at least: 3.5
Tested up to: 3.5.1
Stable tag: 1.1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows a user to submit multiple files when added to a form on your Wordpress site via AJAX to the Wordpress media gallery.

== Description ==
Allows a user to submit multiple files from a form on your Wordpress site via AJAX to Wordpress default uploads folder and adds an attachment to the
Wordpress media gallery.  Includes a shortcode `[wp-multi-file-uploader]` for use in a form created in the post editor and a function for use in a form in a template file `wp_multi_file_uploader();`.

**Plugin Home Page:** [http://danholloran.com/wp-multi-file-uploader/](http://danholloran.com/wp-multi-file-uploader/)

**What this plugin does not do:** This plugin does not make sure that the user is allowed to add a file but it does restrict the file type to the WordPress supported file types by default, this has been updated to dynamically get the supported file types for your WordPress install.  The file upload size limit is now restricted to either the WordPress or PHP INI limit this can be changed.  It also does not play nice at the moment with Wordpress form building plugins, if you integrate it with one please let me know and submit a pull request this is a feature I would like to eventually get integrated.

**Both the short code and the function accept 2 parameters.**
`allowed_mime_types` accepts a comma separated white space sensitive list, ex: jpg,png,gif
`max_file_size` accepts the file size in megabytes ex: 4 = 4mb

**Thanks to:** This project incorporates the excellent file uploader at [https://github.com/valums/file-uploader](https://github.com/valums/file-uploader), if your project is included and I do not have you added please let me know, thank you.

If you have any issues please submit an [issue](https://github.com/DHolloran/WPMultiFileUploader/issues/new) or fix it/submit a pull request I will try to handle it ASAP. You an also contact me at [support@danholloran.com](mailto:support@danholloran.com).

== Installation ==
1. Upload `wp-multi-file-uploader` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
2. Place the shortcode `[wp-multi-file-uploader]` in your form somewhere in either in the post editor or you can use `wp_multi_file_uploader()` in your theme.
3. For each file uploaded the plugin will add a hidden input field `name="wp_multi_file_uploader_[NUMBER]"` with [NUMBER] representing the amount of files starting at 1 and the value will be the uploads attachment id

== Frequently Asked Questions ==
None so far... If you have any issues please submit an [issue](https://github.com/DHolloran/WPMultiFileUploader/issues/new) or fix it/submit a pull request I will try to handle it ASAP. You an also contact me at [support@danholloran.com](mailto:support@danholloran.com).

== Screenshots ==
1. /assets/screenshot1.png
2. /assets/screenshot2.png

== Changelog ==

= 1.0.0 =
Initial Release

= 1.1.0 =
* Added support for overriding default accepted file types.
* Added support for overriding default file size.
* Misc. clean up

== 1.1.1 ==
* Fixed extract error with shortcode

== 1.1.2 ==
* Fixed image uploads not creating all the attachment sizes

== Upgrade Notice ==

= 1.0.0 =
Initial Release

= 1.1.0 =
Added support for overriding default accepted file types and default file size.

== 1.1.1 ==
Fixed extract error with shortcode

== 1.1.2 ==
Fixed image uploads not creating all the attachment sizes