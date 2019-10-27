// JavaScript Document

(function($) {
	
	$(window).load(function(e) {
		
		if( $('.redux-notice').length > 0 ){
			
			$('.redux-notice').css({
				'display' : 'none',
				'visibility' : 'hidden'	
			});
				
		}
		
		
	});
	
	$(document).ready(function(e) {
		
		//Time selector
		if( $('input[name="pm_event_start_time_meta"]').length > 0 ){
			$('input[name="pm_event_start_time_meta"]').ptTimeSelect();
			$('input[name="pm_event_end_time_meta"]').ptTimeSelect();
		}
		
		if( $('input[name="pm_schedule_start_time_meta"]').length > 0 ){
			$('input[name="pm_schedule_start_time_meta"]').ptTimeSelect();
			$('input[name="pm_schedule_end_time_meta"]').ptTimeSelect();
		}
		
				        
		//Header image preview
		if( $('.pm-admin-upload-field').length > 0 ){
	
			var value = $('.pm-admin-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-upload-field-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Featured Post image preview
		if( $('.pm-featured-image-upload-field').length > 0 ){
	
			var value = $('.pm-featured-image-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-featured-image-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Staff image preview
		if( $('#img-staff-uploader-field').length > 0 ){
	
			var value = $('#img-staff-uploader-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-upload-staff-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Gallery image preview
		if( $('#featured-img-uploader-field').length > 0 ){
	
			var value = $('#featured-img-uploader-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-gallery-image-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Event image preview
		if( $('.pm-event-admin-upload-field').length > 0 ){
	
			var value = $('.pm-event-admin-upload-field').val();
			
			if (value !== '') {
				
				$('.pm-admin-upload-event-preview').html('<img src="'+ value +'" />');
				
			}
	
		}
		
		//Remove page header button
		if( $('#remove_page_header_button').length > 0 ){
	
			$('#remove_page_header_button').click(function(e) {
				
				$('#img-uploader-field').val('');
				$('.pm-admin-upload-field-preview').empty();
				
			});
	
		}
		
		//Remove woocomm header image
		if( $('#remove_woocom_header_image_button').length > 0 ){
	
			$('#remove_woocom_header_image_button').click(function(e) {
				
				$('#img-uploader-field').val('');
				$('.pm-admin-upload-field-preview').empty();
				
			});
	
		}
		
		
		
		
		//Remove gallery image button
		if( $('#remove_gallery_image_button').length > 0 ){
	
			$('#remove_gallery_image_button').click(function(e) {
				
				$('#featured-img-uploader-field').val('');
				$('.pm-admin-gallery-image-preview').empty();
				
			});
	
		}
		
		//Remove featured event image button
		if( $('#remove_featured_event_image_button').length > 0 ){
	
			$('#remove_featured_event_image_button').click(function(e) {
				
				$('#featured-img-uploader-field').val('');
				$('.pm-admin-upload-event-preview').empty();
				
			});
	
		}
		
		//Remove staff image button
		if( $('#remove_staff_image_button').length > 0 ){
	
			$('#remove_staff_image_button').click(function(e) {
				
				$('#img-staff-uploader-field').val('');
				$('.pm-admin-upload-staff-preview').empty();
				
			});
	
		}
				
		//Datepicker
		if( $('#datepicker').length > 0 ){
			$( "#datepicker" ).datepicker({
				  dateFormat: "yy-mm-dd"
			});
		}
		
		//Theme verification - marketplace selection
		if( $('#pm_ln_verify_marketplace_selection').length > 0 ){
	
			$('#pm_ln_verify_marketplace_selection').on('change', function(e) {		
			
				
				var val = $(this).val();
				
				if(val === 'themeforest'){
					
					$('#pm_ln_micro_themes_purchase_code_themeforest').addClass('active');
					$('#pm_ln_micro_themes_purchase_code_mojo').removeClass('active');		
									
					
				} else if(val === 'mojo') {
					
					$('#pm_ln_micro_themes_purchase_code_mojo').addClass('active');	
					$('#pm_ln_micro_themes_purchase_code_themeforest').removeClass('active');			
							
				} else {
					
					$('#pm_ln_micro_themes_purchase_code_themeforest').removeClass('active');
					$('#pm_ln_micro_themes_purchase_code_mojo').removeClass('active');	
						
				}
				
			});
	
		}
		
    });
	
})(jQuery);