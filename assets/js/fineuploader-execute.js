jQuery(function($) {
	$(window).load(function(){
		if ( $('#wp_multi_file_uploader').length > 0 ) {
			var uploaderElem = $('#wp_multi_file_uploader'),
				ajaxUrl = uploaderElem.data('ajaxurl'),
				uploader = new qq.FineUploader({
					element: $('#wp_multi_file_uploader')[0],
					debug: false,
					request: {
						endpoint: ajaxUrl,
						// Admin AJAX Param
						params: {
							action: 'wp_multi_file_uploader',
							postId: uploaderElem.data('postid')
						},
						paramsInBody: true
					},
					validation: {
						allowedExtensions: uploaderElem.data('mimetypes').split(','),
						sizeLimit: parseInt( uploaderElem.data('maxsize'), 10 )	 * 1024 * 1024 // Turn Megabytes into Bytes
					},
					callbacks: {
						onComplete: function(id, fileName, response) {
							if(response.success) {
								var parentForm = $('#wp_multi_file_uploader').parent('form'),
									uploader = $('#wp_multi_file_uploader'),
									fileCount = uploader.data('filecount'),
									attachId = response.attachmentId
								;
								parentForm.append('<input type="hidden" name="wp_multi_file_uploader_'+fileCount+'" value="'+attachId+'">');
								uploader.data('filecount', fileCount + 1);
							} // if()
						} // onComplete
					},
					text: {
						uploadButton: 'Upload File(s)'
					}
				}) ;
		} // if()
	}); // $(window).load()
}(jQuery));
