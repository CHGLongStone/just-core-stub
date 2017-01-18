<?php 
/**
 * Basic example to show static calls work
 * 
 * 
 * @author		Jason Medland
* @package		JCORE\SERVICE\EXAMPLE
 */
namespace JCORE\SERVICE\EXAMPLE;

/**
 * Class basicAPI
 *
 * @package JCORE\SERVICE\EXAMPLE
*/
class basicAPI{
	
	/**
	* function1 
	* @access public 
	* @param mixed $subTemplater
	* @return
	*/
	public static function function1(&$subTemplater=null){
		//  		$stringval = '<pre>'.var_export($subTemplater,true).'</pre>';
		$stringval = 'Returned from function1';
		return $stringval;
	}
	/**
	* function2
	* @access public 
	* @param mixed $setTime
	* @return string
	*/
	public static function function2($setTime=null){
	
		return 'Returned from function2';
	}
	
}

?>