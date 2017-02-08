/**/
/**
* some basic helper functions
*/
function prettyPrint()
{
	objData = $('#jsonString').val();
	objData = jQuery.parseJSON(objData);
	objJSON = JSON.stringify(objData, null, 2);
	$('#jsonString').val(objJSON);  //text(),html(),val()
}

function pageSingle(id){
	if (document.getElementById(id)){
		(document.getElementById(id).style.display == 'none')? display = 'block': display = 'none' ;
		document.getElementById(id).style.display = display;
	}
}


/**
* the core javascript service object
*/
var JCORE = JCORE || {};

/**
* default DB
*/
var DSN = 'JCORE';


JCORE = {
	API_PATH: '/api/',
	request: function(callback) {
		console.log('Do Request');
	},

};
/*
* Here's the call you'd need to get data for this page
* for a regular user
		var request = {
			method: '\\SERVICE\\CRUD\\CRUD.retrieve',
			params: {
				DSN: 'JCORE',
				table: 'client',
				pk_field: 'client_pk',
				pk: 5
			},
			id: SESSIONID,
		};
		
*/
/**
* Mikes templater modified
*/
JCORE.templater = {

	renderHTML: function(prefix, obj, html) {
		//console.log('Do JCORE.templater.renderHTML');
		if (typeof obj !== typeof undefined && typeof prefix !== typeof undefined && typeof html !== typeof undefined){
			var keys = Object.keys(obj);
			var elmType = {
				"text" : [
					"DIV", 
					"SPAN", 
					"A", 
					"TD", 
					"I", 
					"LI", 
					"UL" 
				],
				"form" : [
					"INPUT"
				],
				"media" : [
					"IMG", 
					"CANVAS", 
					"CSS", 
					"SCRIPT" 
				]
			}
			/**
			elmType = $.parseJSON(elmType);
			//#
			console.log(elmType);
			console.log('html. toString:'+html.toString());
			console.log('html.outerHTML'+html.outerHTML());
			console.log('html:'+html);
			console.log('html.keys'+JSON.stringify(Object.keys(html), null, 2));
			console.log('html[0]'+html[0]);
			console.log('html[0].attributes'+html[0].attributes);
			console.log('html[0].innerHTML'+html[0].innerHTML);
			//console.log('html[0]'+JSON.stringify(html[0], null, 2));
			*/
			
			
			$.each(keys, function(k,v) {

				/**
				console.log('EACH-------'+v);
				var el = html.find('['+prefix+'-'+v+']');
				<div advertiser-name></div>
				console.log('['+prefix+'-'+v+']'+k);
				*/
				if (v == 'id'){
					html.attr(prefix, obj[v]);
					var el = '';
					//console.log('id-------'+v);
				}else{
					var el = html.find('['+prefix+'-'+v+']');
					//console.log('attribute:'+'['+prefix+'-'+v+']');
				}
				
				/**
				if(undefined != el[0]){
					console.log('el.[0].outerHTML'+el[0].outerHTML);
				}
				if(undefined != el[1]){
					console.log('el.[1].outerHTML'+el[1].outerHTML);
				}
				
				console.log('el.html()'+el.html());
				*/
					

				if (el.length > 0){
					
					/**
					console.log('el.prev().prop("nodeName"):'+el.prev().prop('nodeName'));
					console.log('el.index():'+el.index());
					//console.log('el.is():'+el.is());
					//$(this).prev().prop('nodeName');
					//console.log('$.inArray('+el.prev().prop("nodeName")+', '+elmType.text+'):'+$.inArray(el.prev().prop('nodeName'), elmType.text));
					*/

					switch(true){
						case -1 < $.inArray(el.prev().prop('nodeName'), elmType.text)://inArray( value, array)
							/*
							console.log('--------text');
							console.log('$.inArray************************'+el.index());
							getAllProps(el);
							*/
							el.html(obj[v]);
							break;
						case -1 < $.inArray(el.prev().prop('nodeName'), elmType.form):
							//console.log('---------form');
							if (
								el.attr('type') !== 'checkbox'
								|| 
								el.is('select')
							){
								el.val(obj[v]);
							}else if (el.attr('type') == 'checkbox'){
								if (obj[v] == 1 || obj[v] == true){
									el.prop('checked', true);
								}else{
									el.prop('checked', false);
								}
							}		
							break;
						case -1 < $.inArray(el.prev().prop('nodeName'), elmType.media):
							//console.log('---------media');
							if ((obj[v] !== '' || obj[v] !== null)){
								el.attr('src', obj[v]);
							}		
							break;
						default:
							//console.log('DEFAULT:');
							el.html(obj[v]);
							
							/**
							console.log('el.append():'+el.append('********'));
							console.log('el.html():'+el.html());
							console.log('el.html():'+el.html());
							var sub = prefix+'-'+v;
							console.log('el.contains('+sub+'):'+$( html ).is( ":contains('"+sub+"')" ));
							var TEMPLATE = $( html ).is( ":contains('"+sub+"')" );
							if(false !== TEMPLATE){
								console.log('TEMPLATE:'+TEMPLATE);
							}
							///////////////////////////////////////////
								JSON.stringify(result, null, 2)

							
							var contents = el.[TEMPLATE].contents();
							console.log('contents:'+contents);
							//$( "li" ).index( listItems )
							
							$( "div.demo-container" ).html();
							
							
							console.log('contents'+JSON.stringify(contents, toJsonReplacer, pretty));
							$( "div:contains('John')" ).css( "text-decoration", "underline" );
							contents = contents.replace(sub, obj[v]);
							var re = new RegExp("regex","g");
							rExp = //gi;
							el.replace(rExp, obj[v]);
							console.log('default:'+' sub['+sub+'] '+el.typeOf());
							*/
							break;
					}
					/**
					if(undefined != el[0]){
						console.log('el.[0].outerHTML'+el[0].outerHTML);
					}
					//console.log('el.1'+el[1]);
					if(undefined != el[1]){
						console.log('el.[1].outerHTML'+el[1].outerHTML);
					}
					///////////////////////////////////////////
					if (el.is('div') || el.is('span'))
					{
						//  console.log(obj[v]);
						el.html(obj[v]);
					}else if (el.is('img') && (obj[v] !== '' || obj[v] !== null)){
						el.attr('src', obj[v]);
					}else if ((el.is('input') && el.attr('type') !== 'checkbox') || el.is('select')){
						el.val(obj[v]);
					}else if (el.is('input') && el.attr('type') == 'checkbox'){
						if (obj[v] == 1 || obj[v] == true){
							el.prop('checked', true);
						}else{
							el.prop('checked', false);
						}
					}
					*/
				}else{
					// console.log(v+' no element el.length'+el.length); 
					
				}
			});
			return html;
		}else{
			console.log('All parameters required. Prefix, Object and HTML object');
		}
	},
	
	
};

JCORE.initialize = {
	apiSettings: function() {
		//console.log('Start API Settings');
		var request = {
			method: SERVICE_CALL,
			params: {
				DSN: 'JCORE',
				table: 'client_log',
				pk_field: 'client_log_pk',
				pk: 5
			},
			id: SESSIONID+'::'+SERVICE_CALL+'::'+Date.now(),
		};
		request = JSON.stringify(request);
		console.log(request);
		$.ajax({
		  type: 'post',
			headers: {
				'SESSIONID':SESSIONID,
				'user_id':user_id,
				'user_email':user_email
			},
		  dataType: "json",
		  url: JCORE.API_PATH,
		  data: request,
		  cache: false
			})
		.done(function( data ) {
			console.log(data);
		});
	},
};

/**
* a service call wrapper 
*/
JCORE.service = {
	lastResult: '',
	/**
	* a method to do the call and provide default parameters 
	*/
	call: function(requestParams) {
		console.log('Start JCORE.service.call');
		var request = {
			method: SERVICE_CALL,
			params: requestParams,
			id: SESSIONID+'::'+SERVICE_CALL+'::'+Date.now(),
		};
		request = JSON.stringify(request);
		console.log(request);
		$.ajax({
			type: 'post',
			headers: {
				'SESSIONID':SESSIONID,
				'user_id' : user_id,
				'user_email' : user_email,
				'canvas_fingerprint' : canvas_fingerprint,
				'digital_fingerprint' : digital_fingerprint,
			},
			dataType: "json",
			url: JCORE.API_PATH,
			data: request,
			cache: false
		})
		.done(function( data ) {
			console.log('JCORE.service.call: result'+JSON.stringify(data));
			if('OK' == data.result.status){
				/*
				console.log('status:OK ');
				console.log( 'data.result.info: ' + JSON.stringify(data.result.info) );
				console.log('callback:OK '+data.result.info);
				console.log('callback:OK '+data.result.info.callback);
				*/
				if(data.result.info.callback){
					responseProcessor = data.result.info.callback+'(data.result);';
					console.log('responseProcessor=='+responseProcessor);
					eval(responseProcessor);
				}
				
				JCORE.service.lastResult = data.result;
				console.log('JCORE.service.lastResult:'+data.result);
				/*
				JCORE.service.notification(data.result);
				*/
			}
			return data.result;
		});
	},
	/**
	* #####################################################################
	* some service calls
	* #####################################################################
	*/
	
	/**
	* output the results of the ajax request to the browser
	*/
	notification: function(result) {
		console.log('notification');
		JCORE.service.lastResult = result;
		/**
		* look for the DOM element to write the notification 
		*/
		if($('#notification')){
			/**
			console.log('notification DOM exists');
			console.log('typeof: '+typeof result);
			console.log('result: '+ result);
			*/
			if('object' == typeof result){
				$('#notification').html(JSON.stringify(result, null, 2));
			}else{
				$('#notification').html(result);
			}
			
		}else{
			return false;
		}
	},	
	/**
	* optput the results of the ajax request to the browser
	* from a list (array) of results 
	*/
	notificationList: function(result) {
		console.log('JCORE.signUp.signUpNotification:'+JSON.stringify(result, null, 2));
		if('OK' == result.status){
			var msg = '';
			$.each(result.info.msg, function(k,v) {
				msg = msg+""+v+"<br>";
				//params[v.name] = v.value;
			});
			JCORE.service.notification(msg);
		}		
	},
	/**
	* a standard regex to validate email format
	* function pulled from here https://gist.github.com/slovisi/6387824
	*/
	isValidEmailAddress: function(emailAddress) {
		console.log('isValidEmailAddress:'+emailAddress);
		/**
		var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
		* alt pattern here http://emailregex.com/
		*/
		var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return pattern.test(emailAddress);
	},	

	/**
	* deprecated?
	* 
	*/
	Account_APISettings: function() {
		console.log('Start API Settings');
		var request = {
			//method: SERVICE_CALL,
			params: 'requestParams'
		};

	},
	/**
	* look up the account billing details 
	* 
	*/
	Account_BillingDetails: function(form) {
		console.log('Start Account_BillingDetails');
		SERVICE_CALL = '\\SERVICE\\USER\\BILLING_CONTACT_PROFILE.UPDATE';
		//SERVICE\USER\BILLING_CONTACT_PROFILE.UPDATE
		var post_data = form.serializeArray(); 
		var params = {};
		/**
		* fix the name space
		*/
		$.each(post_data, function(k,v) {
			params[v.name] = v.value;
		});
		var isValidEmailAddress = JCORE.service.isValidEmailAddress(params.billing_email);
		
		if(!isValidEmailAddress){
			JCORE.service.notification('Invalid Email address');
			return false;
		}
		params.pk_field = 'billing_contact_pk';
		params.callback = 'JCORE.service.notificationList';		
		console.log('params.website_url encodeURIComponent:'+params.website_url);
		
		console.log('Account_BillingDetails post_data:'+JSON.stringify(params, null, 2));
		//JCORE.service.call(params);
		result = JCORE.service.call(params);
		
		result = JSON.stringify(result, null, 2)
		JCORE.service.notification(result);
	},

	/**
	* a default service call bound to a view by the method name
	* the service call needs to provide the requestParams
	* to the JCORE.service.call object
	*/
	Account_UserDetails: function(form) {
		console.log('Start Account_UserDetails');
		JCORE.service.notification('');
		SERVICE_CALL = '\\SERVICE\\USER\\USER_PROFILE.UPDATE';
		//SERVICE\USER\BILLING_CONTACT_PROFILE.UPDATE
		var post_data = form.serializeArray(); 
		var params = {};
		/**
		* fix the name space
		*/
		$.each(post_data, function(k,v) {
			params[v.name] = v.value;
		});
		if('' != params.password && params.password != params.rpassword){
			JCORE.service.notification('Password empty or mismatch');
			return false;
		}
		if(
			'' != params.password
			&&
			(8  > params.password.length || 72  < params.password.length )
		){
			JCORE.service.notification('Password does not meet length requirements <br> MIN: 8 Characters <br> MAX: 72 Characters <br>you used ['+params.password.length+'] characters');
			return false;
		}
		
		params.pk_field = 'client_user_pk';
		params.callback = 'JCORE.service.notificationList';		
		
		
		console.log('Account_UserDetails post_data:'+JSON.stringify(params, null, 2));
		result = JCORE.service.call(params);
		
		result = JSON.stringify(result, null, 2)
		JCORE.service.notification(result);

	},

	/**
	* get a list of FINGERPRINT entries to build autocomplete from 
	* to the JCORE.service.call object
	*/
	Fingerprint_getFilteredList: function(searchString) {
		console.log('Start Fingerprint_getFilteredList');
		/**
		* call these from top to bottom (page element sequence)
		*/
		SERVICE_CALL = '\\SERVICE\\JCORE\\FINGERPRINT.getFilteredList';
		var params = {"searchString":searchString};
		//params.callback = 'substringMatcher2';
		console.log('Fingerprint_getFilteredList post_data:'+JSON.stringify(params, null, 2));
		result = JCORE.service.call(params);
		console.log('Fingerprint_getFilteredList result:'+result);
		
		//result = JSON.stringify(result, null, 2);
		console.log('result:'+result);
		//JCORE.service.notification(result);
		//return JCORE.service.lastResult;
	},
	



	/**
	* #####################################################################
	* some util funcitons 
	* 
	* #####################################################################
	*/
	

	/**
	* util function to create new NEEDLE input element
	*/
	createNeedleElm: function() {
		console.log('Start createNeedleElm');
		var htmlTemplate = $('[template="NEEDLE"]').clone(true);
		console.log('html:::'+htmlTemplate);
		var renderedHTML = JCORE.templater.renderHTML('NEEDLE', {}, htmlTemplate);
		$('#needleContainer').append(renderedHTML);
		htmlTemplate.removeAttr('template');
	},
	/**
	* util function to create new NEEDLE input element
	*/
	setCompanySelect: function() {
		var COMPANY_LIST = $('#COMPANY_LIST').val();
		console.log('COMPANY_LIST: '+COMPANY_LIST);
		
		var client_pk = $('#client_pk').val();
		if(COMPANY_LIST != client_pk){
			var pathname = window.location.pathname;
			console.log('pathname: '+pathname);
			var pathname = $(location).attr('href');
			console.log('pathname: '+pathname);
			$('#setCompany').append('<input type=\"hidden\" id=\"client_pk\" name=\"client_pk\" value=\"' + COMPANY_LIST + '\" />');
			document.forms['setCompany'].submit();
			
		}
	},
	/**
	* util function to create new NEEDLE input element
	*/
	setUserSelect: function() {
		var USER_ID = $('#USER_LIST').val();
		console.log('USER_ID: '+USER_ID);
		
		var client_user_pk = $('#client_user_pk').val();
		if(USER_ID != client_user_pk){
			var pathname = window.location.pathname;
			console.log('pathname: '+pathname);
			var pathname = $(location).attr('href');
			console.log('pathname: '+pathname);
			$('#setUser').append('<input type=\"hidden\" id=\"client_user_pk\" name=\"client_user_pk\" value=\"' + USER_ID + '\" />');
			document.forms['setUser'].submit();
			
		}
	},
	
	APISettingsNotification: function(result) {
		console.log('JCORE.signUp.signUpNotification:'+JSON.stringify(result, null, 2));
		if('OK' == result.status){
			var msg = '';
			//msg = msg+"Status: "+result.status+"<br>";
			msg = msg+""+result.info.msg+"<br>";
			JCORE.service.notification(msg);
			/**
			msg = '{"some": "shit", "goes": "here"}';
			JCORE.service.notification(msg);
			msg = {"some": "shit", "goes": "here"};
			JCORE.service.notification(msg);
			*/
			
		}
	},
	
};

/**
* a service call wrapper 
*/
JCORE.service.metronic = {

	/**
	* a method to do the call and provide default parameters 
	*/
	expandMetronicMenu: function() {
		console.log('window.location.pathname: '+window.location.pathname);
		var appendData = '<span class="selected"></span><span class="arrow active open"></span>';
		var menuSelected = $('a[href="' + window.location.pathname + '"]');
		//menuSelected.append(appendData);
		
		var container = menuSelected.parent();//.find('li').first();
		/*
		console.log('container'+container.html());//data('data-id')
		console.log('container'+container.data("id"));//
		*/
		if(undefined == container.data("id")){
			return false;
		}
		var menuPath = container.data("id").split('/');
		var testNode = null;
		var testVal = '';
		var localLink = '';
		
		i = 0;
		$.each(menuPath, function(k,v) {
			if(i > 0){
				testVal = testVal+"/"+v;
			}else{
				testVal = v;
			}
			testNode = $('li[data-id="'+testVal+'"]');
			testNode.addClass('open');
			
			localLink = testNode.find('a').first();
			localLink.append(appendData);
			container = testNode.find('ul').first();
			$( container ).css( "display", "block" );
			i++;
		});
	},

};

console.log(JCORE);


$('#Account_APISettings').submit(function(e) {
	console.log('Account_APISettings FORM submitted');
	e.preventDefault();
	JCORE.service.notification('');
	var form = $(this);
	var post_data = form.serializeArray(); 
	var params = {};
	/**
	* fix the name space
	*/
	$.each(post_data, function(k,v) {
		params[v.name] = v.value;
	});
	console.log('post_data:'+JSON.stringify(params, null, 2));
	/**
	* throw in some validation hooks for matching password/pass_phrase,
	* terms and conditions, valid email address format as well as
	* any other required fields
	*/
	if('' == params.pass_phrase || params.pass_phrase != params.rpassword){
		JCORE.service.notification('Pass Phrase empty or mismatch');
		return false;
	}
	if(12  > params.pass_phrase.length || 72  < params.pass_phrase.length ){
		JCORE.service.notification('Pass Phrase does not meet length requirements ['+params.pass_phrase.length+'] chars');
		return false;
	}
	
	
	
	//console.log($("input[name='api_key']",form).val());
	params.api_key = $("input[name='api_key']",form).val();
	params.pass_phrase = $("input[name='pass_phrase']",form).val();
	params.canvas_fingerprint = JCORE.canvas_fingerprint;
	params.digital_fingerprint = digital_fingerprint;
	params.client_pk = comp_id;
	
	params.callback = 'JCORE.service.APISettingsNotification';
	
	SERVICE_CALL = '\\SERVICE\\COMPANY\\COMPANY_PROFILE.UPDATE_APISettings';
	console.log(params);
	
	JCORE.service.call(params);
	/*
		var request = {
			method: '\\SERVICE\\ADVERTISER\\ADVERTISER.GET_DETAILS',
			params: {
				advertiser_ID: $('#advertiser_ID').val(), 
			},
			id: SESSIONID,
		};
		request = JSON.stringify(request);
		console.log(request);
	*/
});



