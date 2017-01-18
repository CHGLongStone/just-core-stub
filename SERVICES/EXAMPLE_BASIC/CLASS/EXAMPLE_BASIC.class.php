<?php
/**
* Basic example to show how Service Classes work
* 
* 
* @author		Jason Medland
* @package		JCORE\SERVICE\EXAMPLE
*/


namespace JCORE\SERVICE\EXAMPLE;
use JCORE\SERVICE\EXAMPLE\renderNestedTree;
use JCORE\SERVICE\EXAMPLE\basicAPI;

/**
*
*
* class EXAMPLE_BASIC
*
*
* @package JCORE\SERVICE\EXAMPLE
*/
class EXAMPLE_BASIC{
	/**
	* templater
	* 
	* @access protected 
	* @var string
	*/
	protected $templater;
	/**
	 * __construct
	 * 
	 * @access public 
	 * @param mixed templater
	 * @return null
	*/
	public function __construct(&$templater){
		#echo __METHOD__.'@'.__LINE__.'<br>';
		#$e = new \Exception();
		#echo '$e<pre>'.var_export($e->getMessage(),true).'</pre>';
		$this->templater = $templater;
		#echo '<pre>'.var_export($this->templater,true).'</pre>';
	}
	/** 
	 * function1 ut a value in the template
	 * 
	 * @access public 
	 * @param mixed ps_template_body
	 * @return null
	*/
	public function function1($ps_template_body){
		#echo __METHOD__.'@'.__LINE__.'<br>';
		//  
		#$stringval = '<pre>'.var_export($this->templater,true).'</pre>';
		$stringval = 'Returned from function1<br>';
		#echo $stringval;
		/*
		$TEMPLATER->assign_vars(array(	
			'BODY' 	=> $subTemplater->sparse($ps_template_body, true, $retvar = 'returnString')
		));	
		*/
		$this->templater->assign_vars(array(	
			'BODY' 	=> '<hr>'.__METHOD__.'::'.$stringval.'<hr>'
		));	
		#echo __METHOD__.$this->templater->sparse($ps_template_body, true, $retvar = 'returnString');
		#return $stringval;
		#echo '<pre>'.var_export($this->templater,true).'</pre>';
		return;
	}
	/**
	 * function2 a different name
	 * 
	 * @access public 
	 * @param null
	 * @return null
	*/
	public function function2($setTime=null){
		//
		return 'Returned from function2<br>';
	}
	
}

#echo __FILE__.'@'.__LINE__.'<br>';
?>