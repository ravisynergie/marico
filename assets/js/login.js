$(document).ready(function() {

	jQuery('#loginForm').submit(function() {
		
		//jQuery('.black_overlay').show();
		var formData = $("#loginForm").serializeArray();
		var URL = jQuery("#loginForm").attr("action")+"?id="+Math.random();	
		jQuery.ajax({
	    	url : URL,
	    	type: "POST",
	    	data : formData,
		    success: function(data)
		    {
		       if(data=='Invalid')
			   {
				   jQuery('.login-box-msg').html('Invalid username or password.');
				   jQuery('.login-box-msg').css('color','red');
				   jQuery('.login-box-msg').css('font-weight','bold');
			   }
			   else if(data=='InvalidAuth')
			   {
					jQuery('.login-box-msg').html('Invalid auth code.');
					jQuery('.login-box-msg').css('color','red');
					jQuery('.login-box-msg').css('font-weight','bold');
			   }
			   else if(data=='Auth')
			   {
				   jQuery('.login-box-msg').html('Login Verification');
				   jQuery('.login-box-msg').css('color','green');
				   jQuery('.login-box-msg').css('font-weight','bold');
				   window.location.href='login/auth';  
			   }
			   else if(data=='Success')
			   {
				   jQuery('.login-box-msg').html('Login Success');
				   jQuery('.login-box-msg').css('color','green');
				   jQuery('.login-box-msg').css('font-weight','bold');
				   window.location.href='/marico/dashboard/index';  
			   }
			   else
			   {
				   jQuery('.login-box-msg').html('Login Success');
				   jQuery('.login-box-msg').css('color','green');
				   jQuery('.login-box-msg').css('font-weight','bold');
				   window.location.href=window.location.href;  
			   }
		    }
		});	
		return false;
	});
});
