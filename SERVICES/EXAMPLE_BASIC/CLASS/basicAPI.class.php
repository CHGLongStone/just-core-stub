<? 
/**
 * Basic example to show how plugins work
 * 
 * 
 * @author		Jason Medland
* @package		JCORE\PLUGIN\EXAMPLE
* @subpackage	BASIC
 */
namespace JCORE\PLUGIN\EXAMPLE;

/**
 * Class basicAPI
 *
 * @package JCORE\PLUGIN\EXAMPLE
*/
class basicAPI{
	
	/**
	* 
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
	* 
	* @access public 
	* @param mixed $setTime
	* @return string
	*/
	public static function function2($setTime=null){
	
		return 'Returned from function2';
	}
	
}

?>