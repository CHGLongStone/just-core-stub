<?php
function loadcreds($local=false){
	if(true === $local){
		#echo __FUNCTION__ .'$local['.$local.']'.PHP_EOL;
		return include 'CONFIG/AUTOLOAD/data.local.php';
	}
	return include 'CONFIG/AUTOLOAD/data.global.php';
		
	
}

function getCred($name=null,$local=false){
	
	if(false !== $local){
		#echo __FUNCTION__ .'$local['.$local.']'.PHP_EOL;
	}
	$creds = loadcreds($local);
	if(isset($name) && null != $name){
		echo $creds['DSN']['JCORE'][$name];
	
	}else{
		return false;
	}
}


?>