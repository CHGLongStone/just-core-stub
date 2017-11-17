/**
* blackwatch service functions
*/
BW.display = {
	'lastMsg' : '',
	
	
	getFlagClass: function(flag) {
		console.log('BW.display.getFlagClass(flag='+flag+')');
		//
		var msg = '';
		$.each(BW.FLAGS, function(k,v) {
			$.each(v.states, function(kk,vv) {
				if( null !== flag.match(vv)){
					/*
					console.log('BW.FLAGS '+k+' '+kk+'=['+vv+']');
					console.log('BW.FLAGS flag.match('+vv+')['+flag.match(vv)+']');
					console.log('BW.FLAGS.['+k+']['+BW.FLAGS[k]['CSSClass']+'] ==['+BW.FLAGS[k]['CSSClass']+']');//k.CSSClass
					*/
					BW.display.lastMsg = BW.FLAGS[k]['CSSClass'];
					console.log('BW.display.lastMsg '+BW.display.lastMsg);
					return false;
				}

			});
		});
		return BW.display.lastMsg;
	},
}









/************************************************************
* FINGERPRINT
*************************************************************
*/
var AUTOCOMPLETE_DELAY = 75;
var POLLING_DELAY = 50;
var MIN_SEARCH_CHARS = 2;

$('#Search_Fingerprint').submit(function(e) {
	console.log('Search_Fingerprint');
	e.preventDefault();
	var form = $(this);

	console.log('Start Search_Fingerprint request');
	var request = {
		method: '\\SERVICE\\BLACKWATCH\\FINGERPRINT.getFingerPrintBySearch',
		params: {
			canvas_fingerprint: $('#canvas_fingerprint').val(), 
			digital_fingerprint: $('#digital_fingerprint').val(), 
		},
		id: SESSIONID,
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
		url: BW.API_PATH,
		data: request,
		cache: false
	})
	.done(function( data ) {
		
		console.log('data.result:::'+JSON.stringify(data.result, null, 2));
		var html = $('[template="fingerprint"]').clone(true);
		html.removeAttr('template');
		newhtml = BW.templater.renderHTML('fingerprint', data.result, html);
		parent_container = $('#Search_Fingerprint').closest('.row');
		//parent_container.append('---------------------------------');
		resultRow = parent_container.next();
		/*
		resultRow.append('---------------------------------');
		$('#Search_Fingerprint').closest('.row').next().append('##############################-');;
			website_container = parent_container.find('#advertiser-website_container');
			website_container.append(finishedHtml);
		*/
		template_container = $('#Search_Fingerprint').closest('.row').next().find('#template-container');
		template_container.html('');
		console.log('newhtml:::'+newhtml);
		resultRow.find('#results_container').css('display', 'block');
		//template_container.css('display', 'block');
		template_container.html(newhtml);
		
		
		console.log('data.result.blackwatch_fingerprint_pk:::'+data.result.blackwatch_fingerprint_pk);
		$('#fingerprint_ID').val(data.result.blackwatch_fingerprint_pk);
		/**
		$('#template-container').html('');
		$('#results_container').css('display', 'block');
		$('#template-container').html(newhtml);
		*/
	});
});

function getFingerprintAdvertiser(elem){
	var pk_id = $('#fingerprint_ID').val();
	console.log('getFingerprintAdvertiser pk_id:'+pk_id);

	
	var request = {
		method: '\\SERVICE\\ADVERTISER\\ADVERTISER.GET_FINGERPRINT_ADVERTISER_DETAILS',
		params: {
			fingerprint_ID: pk_id, 
		},
		id: SESSIONID,
	};
	request = JSON.stringify(request);
	console.log(request);
	console.log('getFingerprintAdvertiser fingerprint_ID:'+pk_id);
	$.ajax({
		type: 'post',
		headers: {
			'SESSIONID':SESSIONID,
			'user_id':user_id,
			'user_email':user_email
		},
		dataType: "json",
		url: BW.API_PATH,
		data: request,
		cache: false
	})
	.done(function( data ) {
		console.log('getAdvertiser data.result::'+JSON.stringify(data.result));
		console.log('getAdvertiser data.result.blackwatch_advertiser_pk::'+JSON.stringify(data.result[0].blackwatch_advertiser_pk));
		
		//////////////////////
		var htmlTemplate = '';
		var finishedHtml = '';
		//template_container = $(elem).parent().find('.template-container');
		template_container = $('#fingerprint-advertiser_container');
		/*
		$(elem).append('2@@@@@@@@@@@444442');
		.append('2@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@2');
		.next().find('#template-container');
		
		$('#template-container').html(finishedHtml);
		$('#template-container').css('display', 'block');
		*/
		
		$(template_container).html('');
		$(template_container).css('display', 'block');
		
		htmlTemplate = $('[template="advertiser"]').clone(true);
		htmlTemplate.removeAttr('template');
		$.each(data.result, function(k,v) {
			console.log('getAdvertiser v.blackwatch_advertiser_pk::'+JSON.stringify(v.blackwatch_advertiser_pk));
			iHtml = htmlTemplate.clone(true);
			console.log('v:::'+JSON.stringify(v, null, 2));
			finishedHtml = BW.templater.renderHTML('advertiser', v, iHtml);
			//$('#template-container').append(finishedHtml);
			$(template_container).append(finishedHtml);
			//REF_blackwatch_advertiser_pk = $('#results_container').find('.blackwatch_advertiser_pk').filter(":last");
			
			var advertiser_container = $('#results_container').find('*[advertiser]').filter(":last");
			REF_blackwatch_advertiser_pk = advertiser_container.find('.blackwatch_advertiser_pk');
			REF_blackwatch_advertiser_pk.data( "blackwatch_advertiser_pk", v.blackwatch_advertiser_pk );
			/**
			console.log('getAdvertiser v.blackwatch_advertiser_pk::'+JSON.stringify(v.blackwatch_advertiser_pk));
			results_container = $(elem).parent().find('#results_container');
			
			REF_blackwatch_advertiser_pk = results_container.find('.blackwatch_advertiser_pk').filter(":last");
			//REF_blackwatch_advertiser_pk.attr( "class");
			console.log('getAdvertiser each.data.result::class '+REF_blackwatch_advertiser_pk.attr( "class"));
			REF_blackwatch_advertiser_pk.data( "blackwatch_advertiser_pk", v.blackwatch_advertiser_pk );
			//blackwatch_advertiser_pk
			*/
			console.log('REF_blackwatch_advertiser_pk.data::blackwatch_advertiser_pk '+REF_blackwatch_advertiser_pk.data( "blackwatch_advertiser_pk"));
		});
	});
}


if( undefined != $('#FingerprintSearch').val()){
	console.log('RENDER  FingerprintSearch AUTOCOMPLETE');
	var xhr;
	new autoComplete({
		selector: 'input[name="FingerprintSearch"]',
		minChars: MIN_SEARCH_CHARS,
		delay: AUTOCOMPLETE_DELAY,
		cache: true,
		source: function(term, response){
			console.log('autoComplete.source term '+term);
			if(BW.service.lastResult){
				BW.service.lastResult = '';
			}
			try { xhr.abort(); } catch(e){}
			xhr = BW.service.Fingerprint_getFilteredList(term);
			//console.log('autoComplete. response '+JSON.stringify(BW.service));
			var choices = [{"ID":"Searching","fingerprint":"Searching"}];
			var suggestions = [];
			/*
			XXXsearchingIndex = 	setInterval(function() {
				//console.log('searchingIndex checkResult'+JSON.stringify(BW.service.lastResult.info));
				if( typeof BW.service.lastResult.info == 'object' ){
					//console.log('searchingIndex CHECKRESULT'+JSON.stringify(BW.service.lastResult.info));
					choices = BW.service.lastResult.info;
					for (i=0;i<choices.length;i++){
						if (~(choices[i]["ID"]+' '+choices[i]["fingerprint"]).toLowerCase().indexOf(term)){
							suggestions.push(choices[i]);
						}
					}
					clearInterval(XXXsearchingIndex);
					response(suggestions);
					console.log('DONE  ');
				}

			}, POLLING_DELAY);
			*/
			XXXsearchingIndex = setInterval(function() {
				//console.log('searchingIndex checkResult'+JSON.stringify(BW.service.lastResult.info.length));
				if( BW.service.lastResult.info && typeof BW.service.lastResult.info == 'object' ){
					choices = BW.service.lastResult.info;
					check = false;
					for (i=0;i<choices.length;i++){
						//console.log('i------ '+i+'--choices.length--'+choices.length);
						if (~(choices[i]["ID"]+' '+choices[i]["website"]).toLowerCase().indexOf(term)){
							check = suggestions.push(choices[i]);
						}
						if(false === check || suggestions.length == choices.length){
							//console.log('-----------------BREAK------------');
							break;
						}
					}
					//console.log('-----------------END FOR------------');
					if(suggestions.length == choices.length){
						//console.log('-----------------LOADED AND GO...------------');
						response(suggestions);
						clearInterval(XXXsearchingIndex);						
					}
				}
				console.log('-----------------OUTER ------------');
				if(0 < suggestions.length && i >= suggestions.length){
					console.log('DONE 2 i'+i+' suggestions.length'+suggestions.length);
					clearInterval(XXXsearchingIndex);
				}
				//clearInterval(XXXsearchingIndex);					
			}, POLLING_DELAY);
			//console.log('autoComplete. response '+JSON.stringify(BW.service));
			//console.log('autoComplete. response.info '+JSON.stringify(BW.service.lastResult.info));

		},
		renderItem: function (item, search){
			console.log('renderItem. search '+search);//FingerprintSearch
			search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
			var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
			return '<div class="autocomplete-suggestion" data-fingerprint="'+item["fingerprint"]+'" data-fingerprint-id="'+item["ID"]+'" data-val="'+search+'">'+item["fingerprint"].replace(re, "<b>$1</b>")+'</div>';
		},
		onSelect: function(e, term, item){
			
			$('#fingerprint_ID').val(item.getAttribute('data-fingerprint-id'));
			$('#FingerprintSearch').val(item.getAttribute('data-fingerprint'));
			//alert('Item "'+item.getAttribute('data-fingerprint')+' ('+item.getAttribute('data-fingerprint-id')+')" selected by '+(e.type == 'keydown' ? 'pressing enter' : 'mouse click')+'.');
		}
		
	});

}

/************************************************************
* WEBSITE
*************************************************************
*/

$('#Search_Website').submit(function(e) {
	console.log('Search_Website');
	e.preventDefault();
	var form = $(this);

	console.log('Start Search_Website request');
	var request = {
		method: '\\SERVICE\\ADVERTISER\\WEBSITE.GET_DETAILS',
		params: {
			website_ID: $('#website_ID').val(), 
		},
		id: SESSIONID,
	};
	request = JSON.stringify(request);
	console.log(request);
		$('#template-container').html('');
	
	$.ajax({
		type: 'post',
		headers: {
			'SESSIONID':SESSIONID,
			'user_id':user_id,
			'user_email':user_email
		},
		dataType: "json",
		url: BW.API_PATH,
		data: request,
		cache: false
	})
	.done(function( data ) {
		console.log(JSON.stringify(data.result, null, 2));
		var htmlTemplate = $('[template="website"]').clone(true);
		htmlTemplate.removeAttr('template');
		newhtml = BW.templater.renderHTML('website', data.result, htmlTemplate);
		//console.log('newhtml:::'+newhtml);
		$('#results_container').css('display', 'block');
		$('#template-container').html(newhtml);
		var el = $('#template-container').find('*[website-flag_description]');

		//console.log('---------------$(el).html()'+$(el).html());
		var flag_name = BW.display.getFlagClass(data.result.flag_name);
		//console.log('---------------flag_name:::'+flag_name);
		$(el).addClass(flag_name);
		if(data.result.score){
			renderScore(data.result.score);
			/*
			console.log('data.result.score'+JSON.stringify(data.result.score, null, 2));
			console.log('data.result.score.score'+JSON.stringify(data.result.score.score, null, 2));
			console.log('data.result.score.score.AV1'+JSON.stringify(data.result.score.score.AV1, null, 2));
			*/
			/**
			score = {
				'scan_source' :  'AV1', //data.result.score.scan_date,
				'scan_date' :  data.result.score.scan_date,
				'av1_weighted' :  data.result.score.score.AV1.WEIGHTED,
				'av1_filtered' :  data.result.score.score.AV1.FILTERED,
			}
			console.log('score'+JSON.stringify(score, null, 2));
			var htmlTemplate = $('[template="scan_result"]').clone(true);
			//htmlTemplate = htmlTemplate.html();
			//htmlTemplate.removeAttr('template');
			newhtml = BW.templater.renderHTML('score', score, htmlTemplate);
			score_container = $('#template-container').find('#score-container').filter(":last");
			newhtml = newhtml.html();
			score_container.html(newhtml);
			*
			*/
		}
		
		
		
	});
});

function renderScore(score){
	console.log('renderScore score:::'+JSON.stringify(score, null, 2));
	if(score.score){
		scores = {
			'scan_source' :  'AV1', //data.result.score.scan_date,
			'scan_date' :  score.scan_date,
			'av1_weighted' :  score.score.AV1.WEIGHTED,
			'av1_filtered' :  score.score.AV1.FILTERED,
		}
		console.log('score'+JSON.stringify(score, null, 2));
		var htmlTemplate = $('[template="scan_result"]').clone(true);
		//htmlTemplate = htmlTemplate.html();
		//htmlTemplate.removeAttr('template');
		newhtml = BW.templater.renderHTML('score', scores, htmlTemplate);
		score_container = $('#template-container').find('#score-container').filter(":last");
		newhtml = newhtml.html();
		score_container.html(newhtml);
	}
}

function getWebsiteAdvertiser(elem){

	
	var pk_id = $('#website_ID').val();
	console.log('getWebsiteAdvertiser pk_id:'+pk_id);


	
	var request = {
		method: '\\SERVICE\\ADVERTISER\\ADVERTISER.GET_WEBSITE_ADVERTISER_DETAILS',
		params: {
			website_ID: pk_id, 
		},
		id: SESSIONID,
	};
	request = JSON.stringify(request);
	console.log(request);
	console.log('getWebsiteAdvertiser website_ID:'+pk_id);
	$.ajax({
		type: 'post',
		headers: {
			'SESSIONID':SESSIONID,
			'user_id':user_id,
			'user_email':user_email
		},
		dataType: "json",
		url: BW.API_PATH,
		data: request,
		cache: false
	})
	.done(function( data ) {
		console.log('getAdvertiser data.result::'+JSON.stringify(data.result));
		
		//////////////////////
		var htmlTemplate = '';
		var finishedHtml = '';
		$('#website-advertiser_container').html(finishedHtml);
		$('#website-advertiser_container').css('display', 'block');
		htmlTemplate = $('[template="website-advertiser"]').clone(true);
		htmlTemplate.removeAttr('template');
		$.each(data.result, function(k,v) {
			//console.log('k['+k+'] v['+v+'] v.website_tld['+v.website_tld+']');
			iHtml = htmlTemplate.clone(true);
			console.log('v:::'+JSON.stringify(v, null, 2));
			finishedHtml = BW.templater.renderHTML('advertiser', v, iHtml);
			$('#website-advertiser_container').append(finishedHtml);
		var advertiser_container = $('#website-advertiser_container').find('*[advertiser]').filter(":last");
		REF_blackwatch_advertiser_pk = advertiser_container.find('.blackwatch_advertiser_pk');
		REF_blackwatch_advertiser_pk.data( "blackwatch_advertiser_pk", v.blackwatch_advertiser_pk );
			
			/*
			
			
		console.log('getAdvertiser each.data.result::class '+REF_blackwatch_advertiser_pk.attr( "class"));

			
			REF_blackwatch_advertiser_pk = $('#results_container').find('.advertiser_pk').filter(":last");
			REF_blackwatch_advertiser_pk.append('******************');
			REF_blackwatch_advertiser_pk.data( "blackwatch_advertiser_pk", v.blackwatch_advertiser_pk );
			*/
		});
	});
}


if( undefined != $('#WebsiteSearch').val()){
	console.log('RENDER  WebsiteSearch AUTOCOMPLETE');
	var xhr;
	new autoComplete({
		selector: 'input[name="WebsiteSearch"]',
		minChars: MIN_SEARCH_CHARS,
		delay: AUTOCOMPLETE_DELAY,
		cache: true,
		source: function(term, response){
			//console.log('autoComplete.source term '+term);
			BW.service.lastResult = '';
			try { xhr.abort(); } catch(e){}
			xhr = BW.service.Website_getFilteredList(term);
			//console.log('autoComplete. response '+JSON.stringify(BW.service));
			var choices = [{"ID":"Searching","website":"Searching"}];
			//choices = BW.service.lastResult.info;
			var suggestions = [];
			XXXsearchingIndex = setInterval(function() {
				//console.log('searchingIndex checkResult'+JSON.stringify(BW.service.lastResult.info.length));
				if( BW.service.lastResult.info && typeof BW.service.lastResult.info == 'object' ){
					choices = BW.service.lastResult.info;
					check = false;
					for (i=0;i<choices.length;i++){
						//console.log('i------ '+i+'--choices.length--'+choices.length);
						if (~(choices[i]["ID"]+' '+choices[i]["website"]).toLowerCase().indexOf(term)){
							check = suggestions.push(choices[i]);
						}
						if(false === check || suggestions.length == choices.length){
							//console.log('-----------------BREAK------------');
							break;
						}
					}
					//console.log('-----------------END FOR------------');
					if(suggestions.length == choices.length){
						//console.log('-----------------LOADED AND GO...------------');
						response(suggestions);
						clearInterval(XXXsearchingIndex);						
					}
				}
				console.log('-----------------OUTER ------------');
				if(0 < suggestions.length && i >= suggestions.length){
					console.log('DONE 2 i'+i+' suggestions.length'+suggestions.length);
					clearInterval(XXXsearchingIndex);
				}
				//clearInterval(XXXsearchingIndex);					
			}, POLLING_DELAY);
			//console.log('autoComplete. response '+JSON.stringify(BW.service));
			console.log('autoComplete. response.info '+JSON.stringify(BW.service.lastResult.info));

		},
		renderItem: function (item, search){
			/** 
			* catch this fucking race condition
			* 403 381 383 120 390 searchingIndex checkResult[]
			console.log('catch this fucking race condition item:'+JSON.stringify(item, null, 2));
			console.log('renderItem. search '+search);
			console.log('catch this fucking race condition search:'+JSON.stringify(search, null, 2));
			console.log('catch this fucking race condition EXISTS:'+JSON.stringify(arguments.callee(), null, 2));
			*/
			if(undefined == search ){
				console.log('catch this race condition EMPTY '+BW.service.lastResult.info.length);
				
				return false;
			}
			if('' == BW.service.lastResult || undefined == BW.service.lastResult.info.length){
				console.log('catch this race condition BW.service.lastResult '+BW.service.lastResult.info.length);
				/*
				console.log('BW.service.lastResult '+JSON.stringify(BW.service.lastResult, null, 2));
				*/
				return false;
			}				
				
			search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
			var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
			return '<div class="autocomplete-suggestion" data-website="'+item["website"]+'" data-website-id="'+item["ID"]+'" data-val="'+search+'">'+item["website"].replace(re, "<b>$1</b>")+'</div>';
		},
		onSelect: function(e, term, item){
			
			$('#website_ID').val(item.getAttribute('data-website-id'));
			$('#WebsiteSearch').val(item.getAttribute('data-website'));
			//alert('Item "'+item.getAttribute('data-website')+' ('+item.getAttribute('data-website-id')+')" selected by '+(e.type == 'keydown' ? 'pressing enter' : 'mouse click')+'.');
		}
		
	});

}


/************************************************************
* ADVERTISER
*************************************************************
*/

if( undefined != $('#AdvertiserSearch').val()){
	console.log('RENDER  AdvertiserSearch AUTOCOMPLETE');
	var xhr;
	new autoComplete({
		selector: 'input[name="AdvertiserSearch"]',
		minChars: MIN_SEARCH_CHARS,
		delay: AUTOCOMPLETE_DELAY,
		cache: true,
		source: function(term, response){
			console.log('autoComplete.source term '+term);
			BW.service.lastResult = '';
			try { xhr.abort(); } catch(e){}
			xhr = BW.service.Advertiser_getFilteredList(term);
			//console.log('autoComplete. response '+JSON.stringify(BW.service));
			var choices = [{"ID":"Searching","advertiser":"Searching"}];
			var suggestions = [];
			/*
			XXXsearchingIndex = 	setInterval(function() {
				//console.log('searchingIndex checkResult'+JSON.stringify(BW.service.lastResult.info));
				if( typeof BW.service.lastResult.info == 'object' ){
					//console.log('searchingIndex CHECKRESULT'+JSON.stringify(BW.service.lastResult.info));
					choices = BW.service.lastResult.info;
					for (i=0;i<choices.length;i++){
						if (~(choices[i]["ID"]+' '+choices[i]["advertiser"]).toLowerCase().indexOf(term)){
							suggestions.push(choices[i]);
						}
					}
					clearInterval(XXXsearchingIndex);
					response(suggestions);
					//console.log('DONE  ');
				}
			}, POLLING_DELAY);
			*/
			XXXsearchingIndex = setInterval(function() {
				//console.log('searchingIndex checkResult'+JSON.stringify(BW.service.lastResult.info.length));
				if( BW.service.lastResult.info && typeof BW.service.lastResult.info == 'object' ){
					choices = BW.service.lastResult.info;
					check = false;
					for (i=0;i<choices.length;i++){
						//console.log('i------ '+i+'--choices.length--'+choices.length);
						if (~(choices[i]["ID"]+' '+choices[i]["website"]).toLowerCase().indexOf(term)){
							check = suggestions.push(choices[i]);
						}
						if(false === check || suggestions.length == choices.length){
							//console.log('-----------------BREAK------------');
							break;
						}
					}
					//console.log('-----------------END FOR------------');
					if(suggestions.length == choices.length){
						//console.log('-----------------LOADED AND GO...------------');
						response(suggestions);
						clearInterval(XXXsearchingIndex);						
					}
				}
				console.log('-----------------OUTER ------------');
				if(0 < suggestions.length && i >= suggestions.length){
					console.log('DONE 2 i'+i+' suggestions.length'+suggestions.length);
					clearInterval(XXXsearchingIndex);
				}
				//clearInterval(XXXsearchingIndex);					
			}, POLLING_DELAY);
			//console.log('autoComplete. response '+JSON.stringify(BW.service));
			//console.log('autoComplete. response.info '+JSON.stringify(BW.service.lastResult.info));

		},
		renderItem: function (item, search){
			console.log('renderItem. search '+search);
			search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
			var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
			return '<div class="autocomplete-suggestion" data-advertiser="'+item["advertiser"]+'" data-advertiser-id="'+item["ID"]+'" data-val="'+search+'">'+item["advertiser"].replace(re, "<b>$1</b>")+'</div>';
		},
		onSelect: function(e, term, item){
			
			$('#advertiser_ID').val(item.getAttribute('data-advertiser-id'));
			$('#AdvertiserSearch').val(item.getAttribute('data-advertiser'));
			//alert('Item "'+item.getAttribute('data-advertiser')+' ('+item.getAttribute('data-advertiser-id')+')" selected by '+(e.type == 'keydown' ? 'pressing enter' : 'mouse click')+'.');
		}
		
	});

}


$('#Search_Advertiser').submit(function(e) {
	console.log('Search_Advertiser');
	e.preventDefault();
	var form = $(this);
	$('#template-container').empty();
	
	/*
	$.post(form.attr('action'), form.serialize, function(data) {
		// do stuff after submission SERVICE\ADVERTISER
	});
	*/
		console.log('Start Search_Advertiser request');
		var request = {
			method: '\\SERVICE\\ADVERTISER\\ADVERTISER.GET_DETAILS',
			params: {
				advertiser_ID: $('#advertiser_ID').val(), 
			},
			id: SESSIONID,
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
		url: BW.API_PATH,
		data: request,
		cache: false
	})
	.done(function( data ) {
		//data.result.websites = 'onclick="getWebsites('+data.result.blackwatch_advertiser_pk+');"';
		console.log(data.result);
		//console.log(JSON.stringify(data.result, null, 2));
		//$(".script-template-container").loadTemplate("#template", data.result);
		var htmlTemplate = $('[template="advertiser"]').clone(true);
		htmlTemplate.removeAttr('template');
		
		$('#template-container').html('');
		
			
			
		console.log('data.result.blackwatch_advertiser_pk:::'+data.result.blackwatch_advertiser_pk);
		//html = renderHTML('advertiser', data.result, html);
		newhtml = BW.templater.renderHTML('advertiser', data.result, htmlTemplate);
		console.log('newhtml:::'+newhtml);
		
		console.log('show results:::');
		$('#results_container').css('display', 'block');
		$('#template-container').html(newhtml);
		
		var advertiser_container = $('#template-container').find('*[advertiser]').filter(":last");
		REF_blackwatch_advertiser_pk = advertiser_container.find('.blackwatch_advertiser_pk');
		console.log('getAdvertiser each.data.result::class '+REF_blackwatch_advertiser_pk.attr( "class"));
		REF_blackwatch_advertiser_pk.data( "blackwatch_advertiser_pk", data.result.blackwatch_advertiser_pk );
		
		/**
		advertiser_container.append( "--------SAA--------");
			parent_container = newElem.closest('*[advertiser]');
			website_container = parent_container.find('#advertiser-website_container');
			
			REF_blackwatch_advertiser_pk = $('#template-container').find('.blackwatch_advertiser_pk').filter(":last");
			REF_blackwatch_advertiser_pk.append( "--------SA--"+data.result.blackwatch_advertiser_pk+"------");
		*/
		
		console.log('REF_blackwatch_advertiser_pk.data( "blackwatch_advertiser_pk"):::'+REF_blackwatch_advertiser_pk.data( "blackwatch_advertiser_pk"));
		
	});
});


function getGraph(anchor, graphType) {
	console.log('getGraph  graphType:::'+graphType);
	var override = false;
	var VALUE = anchor.previousSibling.innerHTML;
	$('#graph').empty();
	if('' == VALUE){
		$('#full').modal().hide();
		
		return;
	}else{
		if(true === override){
			console.log('getGraph  override:::'+override);
			if('domain' == graphType){
				VALUE = 'cnndaily.com';
			}else{
				VALUE = 'william19770319@yahoo.com';
			}
		}
		
		//console.log('getGraph  VALUE:::'+VALUE);
		var URL = 'https://www.threatcrowd.org/graphHtml.php?'+graphType+'='+VALUE;
		console.log('getGraph  URL:::'+URL);
		$('#graph').attr('src',URL);
		
		var windowHeight = $(window).height();
		//console.log('getGraph  windowHeight:::'+windowHeight);
		var frameSize = $("#graph").height(windowHeight-200);
		//console.log('getGraph  frameSize:::'+frameSize);
		
	}
	
}


function getWebsites(elem){
	//console.log('getWebsites  elem:::'+elem);
	//console.log('elem:::'+JSON.stringify(elem, null, 2));
	newElem = $(elem);
	if ( undefined != newElem.data( "blackwatch_advertiser_pk")){
		var pk_id = newElem.data( "blackwatch_advertiser_pk");
		//newElem.append( "-------GW---------");
		console.log('newElem pk_id['+pk_id+']');
	}else{
		var pk_id = $('#advertiser_ID').val();
		console.log('advertiser_ID pk_id['+pk_id+']');
	}
	//console.log('getWebsites pk_id:'+pk_id);
	var request = {
		method: '\\SERVICE\\ADVERTISER\\WEBSITE.GET_LIST_DETAILS',
		params: {
			advertiser_ID: pk_id, 
		},
		id: SESSIONID,
	};
	$.ajax({
		type: 'post',
		headers: {
			'SESSIONID':SESSIONID,
			'user_id':user_id,
			'user_email':user_email
		},
		dataType: "json",
		url: BW.API_PATH,
		data: request,
		cache: false
	})
	.done(function( data ) {
		console.log('getWebsites data.result::'+data.result);
		var htmlTemplate = '';
		var finishedHtml = '';
		$('#advertiser-website_container').html(finishedHtml);
		$('#website_container').css('display', 'block');
		htmlTemplate = $('[template="advertiser-website"]').clone(true);
		htmlTemplate.removeAttr('template');
		
		$.each(data.result, function(k,v) {
			iHtml = htmlTemplate.clone(true);
			finishedHtml = BW.templater.renderHTML('website', v, iHtml);
			parent_container = newElem.closest('*[advertiser]');
			website_container = parent_container.find('#advertiser-website_container');
			website_container.append(finishedHtml);
			var el = website_container.find('*[website-flag_description]').filter(":last");

			//console.log('---------------$(el).html()'+$(el).html());
			var flag_name = BW.display.getFlagClass(v.flag_name);
			console.log('---------------flag_name:::'+flag_name);
			$(el).addClass(flag_name);
			if(v.score){
				//console.log('---------------v:::'+JSON.stringify(v.score, null, 2));
				renderScore(v.score);
			}else{
				//console.log('k'+k+' v'+JSON.stringify(v, null, 2));
			}
				
		});		
	});
}

/************************************************************
* FINGETRPRINT
*************************************************************
*/
function getFingerPrints(elem){
	console.log('getFingerPrints  elem:::'+elem);
	newElem = $(elem);
	if ( undefined != newElem.data( "blackwatch_advertiser_pk")){
		var pk_id = newElem.data( "blackwatch_advertiser_pk");
		//newElem.append( "--------FP--------");
		console.log('newElem pk_id['+pk_id+']');
	}else{
		var pk_id = $('#advertiser_ID').val();
		console.log('advertiser_ID pk_id['+pk_id+']');
	}
	//console.log('getFingerPrints pk_id:'+pk_id);
	var request = {
		method: '\\SERVICE\\BLACKWATCH\\FINGERPRINT.GET_LIST_DETAILS',
		params: {
			advertiser_ID: pk_id, 
		},
		id: SESSIONID,
	};
	$.ajax({
		type: 'post',
		headers: {
			'SESSIONID':SESSIONID,
			'user_id':user_id,
			'user_email':user_email
		},
		dataType: "json",
		url: BW.API_PATH,
		data: request,
		cache: false
	})
	.done(function( data ) {
		console.log('getFingerPrints data.result::'+data.result);
		var htmlTemplate = '';
		var finishedHtml = '';
		var template_container = newElem.closest('.row').find('#advertiser-fingerprint_container');
		template_container.html('');
		/*
		newElem.append( "--------FP--------");
		template_container.append('getFingerPrints............');
		$('#advertiser-website_container').html(finishedHtml);
		$('#website_container').css('display', 'block');
		htmlTemplate = $('[template="advertiser-website"]').clone(true);
		htmlTemplate.removeAttr('template');
		iHtml = htmlTemplate.clone(true);
		finishedHtml +=' ';
		
		finishedHtml +='	<div class="column_4">';
		finishedHtml +='	</div>';
		finishedHtml +='	<div class="column_5">';
		finishedHtml +='	</div>';
		*/

		finishedHtml +='<div class="row">';
		finishedHtml +='		<div class="result_item_title result_item_fingerprint">digital_fingerprint</div> ';
		finishedHtml +='		<div class="result_item_title result_item_fingerprint">canvas_fingerprint</div>';
		finishedHtml +='</div>';
		$.each(data.result, function(k,v) {
			/**
			console.log('k['+k+'] v['+v+'] v.canvas_fingerprint['+v.canvas_fingerprint+']');
			console.log('v:::'+JSON.stringify(v, null, 2));
			iHtml = htmlTemplate.clone(true);
			finishedHtml +='	<div class="column_4">';
			finishedHtml +='	</div>';
			finishedHtml +='	<div class="column_5">';
			finishedHtml +='	</div>';
			
			*/
			finishedHtml +='<div class="row">';
			finishedHtml +='		<div class="result_item_fingerprint">'+v.digital_fingerprint+'</div> ';
			finishedHtml +='		<div class="result_item_fingerprint">'+v.canvas_fingerprint+'</div> ';
			finishedHtml +='</div>';
			/*
			finishedHtml = BW.templater.renderHTML('website', v, iHtml);
			parent_container = newElem.closest('*[advertiser]');
			website_container = parent_container.find('#advertiser-website_container');
			website_container.append(finishedHtml);
			*/
			
		});	
		console.log('finishedHtml:::'+finishedHtml);
		template_container.append(finishedHtml);
	});
}
/****
$("form:first").submit(function(e) {
	e.preventDefault();
	console.log("form:first.submit");
	console.log("form:first");
	

	
});
*/