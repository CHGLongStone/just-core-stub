/*
  new Fingerprint2().get(function(result){
  console.log('Fingerprint2:'+result);
});

var options = {excludeLanguage : true, excludeUserAgent: true};
new Fingerprint2(options).get(function(result){
  console.log('Fingerprint2:'+result);
});

console.log('fingerprint3:'+fingerprint3());

var fingerprint = new Fingerprint().get();
console.log('Fingerprint:'+fingerprint);

var fingerprint = new Fingerprint({canvas: true}).get();
console.log('Fingerprint:'+fingerprint);

https://github.com/Valve/fingerprintjs2/wiki/List-of-options
swfContainerId - specifies the dom element ID to be used for swf embedding
swfPath - specifies the path to the FontList.swf
excludeUserAgent - user agent should not take part in FP calculation
excludeLanguage - browser language ..
*/


//fingerprint3
var options = {excludeLanguage : true};
new Fingerprint2(options).get(function(result){
	$('#canvas_fingerprint').val(result);
	//$('#canvas_fingerprint').value=result;
	console.log('canvas_fingerprint*****************:'+$('#canvas_fingerprint').val());
});

digital_fingerprint = new Fingerprint({canvas: true}).get();
console.log('digital_fingerprint*****************:'+digital_fingerprint);
$('#digital_fingerprint').val(digital_fingerprint);
console.log('canvas_fingerprintTT*****************:'+$('#digital_fingerprint').val());