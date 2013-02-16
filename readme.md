#WP Multi File Uploader

**Description:** Wordpress plugin that allows a user to submit multiple files from a form on your Wordpress site.  

**Plugin Home Page:** [http://danholloran.com/wp-multi-file-uploader/](http://danholloran.com/wp-multi-file-uploader/)

**What this plugin does:** This plugin will allow multiple files to be uploaded via AJAX to Wordpress's default uploads fold and adds an attachment to the Wordpress media gallery.  

**What this plugin does not do:** This plugin does not make sure that the user is allowed to add a file but it does restrict the [file types](http://codex.wordpress.org/Uploading_Files#About_Uploading_Files_on_Dashboard) to be the same as Wordpress and file size(2mb).  It also does not play nice at the moment with Wordpress form building plugins, if you integrate it with one please let me know and submit a pull request this is a feature I would like to eventually get integrated.

**Thanks to:** This project incorporates the excellent file uploader at [https://github.com/valums/file-uploader](https://github.com/valums/file-uploader), if your project is included and I do not have you added please let me know, thank you.

If you have any issues please submit an [issue](https://github.com/DHolloran/WPMultiFileUploader/issues/new) or fix it/submit a pull request I will try to handle it ASAP. You an also contact me at [Dan@danholloran.com](mailto:dan@danholloran.com).

###Manual Installation Instructions From GitHub
1. Click the download ZIP button
2. Unzip Place in wp-content/plugins/
3. Activate the plugin in the Wordpress Admin area
4. Place the shortcode [wp-multi-file-uploader] in your form somewhere in <form></form> either in the post editor or `do_shortcode('[wp-multi-file-uploader]');` in your template file.
5. For each file uploaded the plugin will add a hidden input field wp_multi_file_uploader_[NUMBER] with [NUMBER] representing the amount of files starting at 1


###Install From Worpress Plugin Repository
Will be added once approved