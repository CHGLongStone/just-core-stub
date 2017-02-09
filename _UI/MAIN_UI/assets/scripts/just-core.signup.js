BW.signUp = {
	/**
	* format the country list
	*/
	format: function(state){
		if (!state.id) {
			return state.text;
		} // optgroup
		//console.log('state.id:'+state.id);
		return "<img class='flag' src='./assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
		
	},	
	
	/**
	* setup the country list
	*/
	setCountryList: function() {
        if (jQuery().select2) {
	        
			/*
			$("#select2_sample4").select2({
	            placeholder: '<i class="fa fa-map-marker"></i>&nbsp;Select a Country',
	            allowClear: true,
	            formatResult: BW.signUp.format,
	            formatSelection: BW.signUp.format,
	            escapeMarkup: function(m) {
	                console.log('m:'+JSON.stringify(m));
					return m;
	            }
	        });
			*/


			$('#select2_sample4').change(function() {
				$('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
			});
		}
	},
	

	/**
	* registerUser
	
	registerUser: function(){
		console.log('registerUser: registerUser');
		$('.register-form').validate({
			//console.log('register-form: validate');
			
			errorElement: 'span', //default input error message container
			errorClass: 'help-block', // default input error message class
			focusInvalid: false, // do not focus the last invalid input
			ignore: "",
			rules: {

				company_name: {
					required: true
				},
				industry: {
					required: true
				},
				
				client_user__alias: {
					required: true
				},
				
				client_user__email: {
					required: true,
					email: true
				},
				client_user__first_name: {
					required: true
				},
				client_user__last_name: {
					required: true
				},
				
				
				client_user__address: {
					required: true
				},
				client_user__city: {
					required: true
				},
				client_user__state: {
					required: true
				},
				client_user__country: {
					required: true
				},
				
				client_user__postal_code: {
					required: true
				},
				client_user__phone: {
					required: true
				},
				client_user__fax: {
					required: true
				},
				

				
				client_user__password: {
					required: true
				},
				rpassword: {
					equalTo: "#register_password"
				},

				tnc: {
					required: true
				}
			},

			messages: { // custom messages for radio buttons and checkboxes
				tnc: {
					required: "Please accept TNC first."
				}
			},

			
		});
		console.log('registerUser: validate');
        $('.register-form input').keypress(function(e) {
			console.log('register-form: input');
            if (e.which == 13) {
                if ($('.register-form').validate().form()) {
                    $('.register-form').submit();
                }
                return false;
            }
        });
	},	
	*/			
	//console.log('registerUser: validate END');
	invalidHandler: function(event, validator) { //display error alert on form submit   
		console.log('invalidHandler: invalidHandler');
	},

	highlight: function(element) { // hightlight error inputs
		//console.log('highlight: highlight');
		$(element)
			.closest('.form-group').addClass('has-error'); // set error class to the control group
	},

	success: function(label) {
		//console.log('success: success');
		label.closest('.form-group').removeClass('has-error');
		label.remove();
	},

	errorPlacement: function(error, element) {
		//console.log('errorPlacement: errorPlacement');
		if (element.attr("name") == "tnc") { // insert checkbox errors after the container				  
			error.insertAfter($('#register_tnc_error'));
		} else if (element.closest('.input-icon').size() === 1) {
			error.insertAfter(element.closest('.input-icon'));
		} else {
			error.insertAfter(element);
		}
	},

	submitHandler: function(form) {
		//form.submit();
		//console.log('BW.signUp.submitHandler FORM submitted');
		form.preventDefault();
		//var form = $(this);
		var post_data = form.serialize(); 
		//console.log('post_data:'+post_data);
		var params = {};
		//console.log($("input[name='api_key']",form).val());
		params.api_key = $("input[name='api_key']",form).val();
		params.pass_phrase = $("input[name='pass_phrase']",form).val();
		params.canvas_fingerprint = BW.canvas_fingerprint;
		params.digital_fingerprint = digital_fingerprint;
		params.client_pk = comp_id;
		SERVICE_CALL = '\\SERVICE\\USER\\SIGNUP\\SIGNUP.SignUpUser';
		//console.log(params);
		
		BW.service.call(params);
		
	},
	
	signUpNotification: function(result) {
		//console.log('BW.signUp.signUpNotification:'+JSON.stringify(result, null, 2));
		if('OK' == result.status){
			var msg = "Status: "+result.status+"<br>";
			msg = msg+""+result.info.msg+"<br>";
			msg = msg+"Your API_KEY is: "+result.info.api_key+"<br>";
			msg = msg+'Click <a href="login.php">here</a> to login'+" <br>";
			BW.service.notification(msg);
			/**
			msg = '{"some": "shit", "goes": "here"}';
			BW.service.notification(msg);
			msg = {"some": "shit", "goes": "here"};
			BW.service.notification(msg);
			*/
			
		}
	},
	
	
	
};


$('#blackwatch_register').submit(function(e) {
	/**
	* set the service call and look for the public token
	*/
	SERVICE_CALL = '\\SERVICE\\USER\\SIGNUP.SignUpUser';
	var PUBLIC_TOKEN = decodeURIComponent(window.location.search.match(/(\?|&)PUBLIC_TOKEN\=([^&]*)/)[2]);
	console.log('PUBLIC_TOKEN:'+PUBLIC_TOKEN);
	BW_API_PATH = BW.API_PATH;
	console.log('BW.API_PATH:'+BW.API_PATH);
	if(-1 == BW.API_PATH.indexOf("PUBLIC_TOKEN")){
		console.log('BW.API_PATH:'+BW.API_PATH);
		console.log('PUBLIC_TOKEN:'+PUBLIC_TOKEN);
		BW.API_PATH = BW.API_PATH+'?PUBLIC_TOKEN='+PUBLIC_TOKEN;
		console.log('BW.API_PATH:'+BW.API_PATH);
	}else{
		console.log('BW.API_PATH.indexOf("PUBLIC_TOKEN"):'+BW.API_PATH.indexOf("PUBLIC_TOKEN"));
		console.log('window.location:'+window.location);
		console.log('window.location.search:'+window.location.search);
		
	}
	console.log('BW.API_PATH:'+BW.API_PATH);
	
	e.preventDefault();
	
	var form = $(this);
	var post_data = form.serializeArray(); 
	//console.log('post_data:'+JSON.stringify(post_data, null, 2));
	var params = {};
	/**
	* fix the name space
	*/
	$.each(post_data, function(k,v) {
		/**
		* fix the name space we had to change for jquery
		* cleaner split using . vs __ 
		*/
		v.name = v.name.replace('__', '.');
		/**
		* if we have a . present we'll strip that
		*/
		if(v.name.indexOf(".")){
			key =  v.name.substring(v.name.indexOf(".")+1);
		}else{
			key =  v.name;
		}
		params[key] = v.value;
	});
	//console.log('params:'+JSON.stringify(params, null, 2));
	/**
	* throw in some validation hooks for matching password,
	* terms and conditions, valid email address format as well as
	* any other required fields
	*/
	if('' == params.password || params.password != params.rpassword){
		BW.service.notification('Password empty or mismatch');
		return false;
	}
	if(8  > params.password.length || 72  < params.password.length ){
		BW.service.notification('Password does not meet length requirements <br> MIN: 8 Characters <br> MAX: 72 Characters <br>you used ['+params.password.length+'] characters');
		return false;
	}
	if(!params.tnc || 'on' != params.tnc){
		BW.service.notification('You Must agree to the Terms of Service and Privacy Policy');
		return false;
	}
	if(!params.industry || '' == params.industry){
		BW.service.notification('You Must Select an Industry'+params.industry);
		return false;
	}
	var isValidEmailAddress = BW.service.isValidEmailAddress(params.email);
	
	if(!isValidEmailAddress){
		BW.service.notification('Invalid Email address');
		return false;
	}
	/*
	*/
	
	params.api_key = $("input[name='api_key']",form).val();
	params.pass_phrase = $("input[name='pass_phrase']",form).val();
	params.canvas_fingerprint = BW.canvas_fingerprint;
	params.digital_fingerprint = digital_fingerprint;
	
	
	//console.log('params:'+JSON.stringify(params, null, 2));
	var result = BW.service.call(params);
	//console.log('result:'+JSON.stringify(result, null, 2));

	
	
	
	//BW.signUp.registerUser();
	//console.log('BW.signUp.registerUser DONE'+JSON.stringify(BW.service.lastResult, null, 2));
	//BW.API_PATH = BW_API_PATH;
	/**
https://www.youtube.com/watch?v=LmdFzCq8MUo&feature=youtu.be
	*/
});