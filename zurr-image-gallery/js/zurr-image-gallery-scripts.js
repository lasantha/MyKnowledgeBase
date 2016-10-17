jQuery(document).ready(function($){
	var zurr_return_url = '/test/';
	jQuery('#btn-upload').live('click',function(){
		var arrayErrors = new Array();
		var image_url = jQuery("#selected-image").attr('src');
		if(image_url == ""){
			arrayErrors['zurr-slider-image'] = 'Please select the image.';
		}
		if(jQuery('#zurr-slider-url').val() == ""){
			arrayErrors['zurr-slider-url'] = 'Please enter category.';
		}
		if(arrayErrors.length == 0){
			var data = {
               	type:'json',
				action: 'zurr_add_changes_action',
				imageUrl: image_url,
				category:jQuery('#zurr-slider-url').val(),
				id:jQuery('#hdn-id').val(),
    			};	
			jQuery.post(ajaxurl, data, function(response) {	
			   var res = jQuery.parseJSON(response);
					if(res.result == 'true'){
						location.href = zurr_return_url+"/wp-admin/admin.php?page=zurr-slider-admin";
					}
		   });
		}
	});
	jQuery('.zurr-delete').live('click',function(){
		var data = {
               	type:'json',
				action: 'zurr_delete_changes_action',
				id:jQuery(this).attr('rel'),
    			};	
			jQuery.post(ajaxurl, data, function(response) {	
			   var res = jQuery.parseJSON(response);
					if(res.result == 'true'){
						location.href = zurr_return_url+"/wp-admin/admin.php?page=zurr-slider-admin";
					}
		   });
	});
	
	
    var custom_uploader;
    
    $('#zurr-slider-image').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $("#selected-image").attr('src',attachment.url);

        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    }); 
});