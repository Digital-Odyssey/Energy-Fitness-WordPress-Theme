(function($) {

	
	$('#pm_trial_form_name').focus(function(e) {
		$(this).removeClass('invalid_field');
	});
	
	$('#pm_trial_form_email').focus(function(e) {
		$(this).removeClass('invalid_field');
	});

	
	$('#pm-trial-form-btn').on('click', function(e) {
							
		e.preventDefault();
								
		//var $this = $(this);
		
		$('#pm-trial-form-response').html(wordpressOptionsObject.fieldValidation);
		
		// Collect data from inputs
		var reg_nonce = $('#pm_ln_send_trial_nonce').val();
		
		var reg_full_name = $('#pm_trial_form_name').val();
		var reg_email_address =  $('#pm_trial_form_email').val();
		var reg_phone =  $('#pm_trial_form_phone').val();
		var reg_message =  $('#pm_trial_form_message').val();
		var reg_recipient_email =  $('#pm_trial_form_recipient_email').val();
		
		var reg_consent_box = 'null';
		
		if($('#pm_trial_consent_box').length > 0) {
			reg_consent_box = $('#pm_trial_consent_box').attr('checked') ? 'checked' : 'unchecked';
		}
		
		/**
		 * AJAX URL where to send data 
		 * (from localize_script)
		 */
		var ajax_url = pm_ln_register_vars.pm_ln_ajax_url;
	
		// Data to send
		var data = {
		  action: 'send_trial_form',
		  nonce: reg_nonce,
		  full_name: reg_full_name,
		  email_address: reg_email_address,
		  phone: reg_phone,
		  message: reg_message,
		  recipient: reg_recipient_email,
		  consent: reg_consent_box
		};
		
		// Do AJAX request
		$.post( ajax_url, data, function(response) {
	
		  // If we have response
		  if(response) {
			  			  				
			if(response === 'full_name_error') {
			  
				$('#pm-trial-form-response').html(wordpressOptionsObject.trial1);
				$('#pm_trial_form_name').addClass('invalid_field');
			  
			} else if( response === 'email_error' ){
				
			    $('#pm-trial-form-response').html(wordpressOptionsObject.trial2);
				$('#pm_trial_form_email').addClass('invalid_field');
				
			} else if(response === "consent_error") {
												
				$('#pm-trial-form-response').html(wordpressOptionsObject.consentError);

			}  else if( response === 'success' ){
				
				$('#pm-trial-form-response').html(wordpressOptionsObject.successMessage).css({ 'marginTop' : -60 });
				$('#pm-trial-form-btn').css({
					'opacity' : 0,
					'visibility' : 'hidden'
				});

			  
			} else if( response === 'failed' ){
				
				$('#pm-trial-form-response').html(wordpressOptionsObject.failedMessage).css({ 'marginTop' : -60 });
				$('#pm-trial-form-btn').css({
					'opacity' : 0,
					'visibility' : 'hidden'
				});
				
			} else {
				
			  $('.result-message').html( response );
			  $('.result-message').show();
			  
			}
		  }
		});
		
		
	});
	
})(jQuery);