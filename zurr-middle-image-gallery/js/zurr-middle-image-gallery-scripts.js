jQuery(document).ready(function($){
	var zurr_return_url = '';
	jQuery('#btn-middle-upload').live('click',function(){
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
				action: 'zurr_middle_add_changes_action',
				imageUrl: image_url,
				category:jQuery('#zurr-slider-url').val(),
				id:jQuery('#hdn-id').val(),
    			};	
			jQuery.post(ajaxurl, data, function(response) {	
			   var res = jQuery.parseJSON(response);
					if(res.result == 'true'){
						//location.href = zurr_return_url+"/wp-admin/admin.php?page=zurr-middle-slider-admin";
					}
		   });
		}
	});
	jQuery('.delete-mid-img').live('click',function(){
		var data = {
               	type:'json',
				action: 'zurr_middle_delete_changes_action',
				id:jQuery(this).attr('id'),
    			};	
			jQuery.post(ajaxurl, data, function(response) {	
			   var res = jQuery.parseJSON(response);
					if(res.result == 'true'){
						location.reload();
					}
		   });
	});
	
	
    var custom_uploader;
    
    $('#zurr-middle-image').click(function(e) {
 
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