<?php
/**
 * CRUD service example
 * 
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package	JCORE\SERVICE\EXAMPLE\CRUD
 * 
 */
 

namespace JCORE\SERVICE\EXAMPLE\CRUD;
use JCORE\TRANSPORT\SOA\SOA_BASE as SOA_BASE;
use JCORE\DAO\DAO as DAO;
/**
 * Class AJAX_STUB
 *
 * @package JCORE\SERVICE\EXAMPLE\CRUD 
*/
class CRUD extends SOA_BASE{ 
	/** 
	* 
	*/
	protected $serviceRequest = null;
	/** 
	* 
	*/
	public $serviceResponse = null;
	/** 
	* 
	*/
	public $error = null;
	
	/**
	* DESCRIPTOR: an empty constructor, the service MUST be called with 
	* the service name and the service method name specified in the 
	* in the method property of the JSONRPC request in this format
	* 		""method":"AJAX_STUB.aServiceMethod"
	* 
	* @param param 
	* @return return  
	*/
	public function __construct(){
		return;
	}
	
	public function init($args){
		/*
		echo __METHOD__.__LINE__.'$args<pre>['.var_export($args, true).']</pre>'.'<br>'; 
		$config = array(
			"DSN" => "HVSPROD",
			"table" => "client",
			"table" => "address",
			
			"pk_field" => "id",
			"pk" => 1,
			
		);
		$DAO2 = new JCORE\DAO\DAO($config);		
		*/
		$this->DAO = new DAO($args);
		#echo __METHOD__.__LINE__.'$this->DAO<pre>['.var_export($this->DAO, true).']</pre>'.'<br>'; 
		return;
	}
	
	/**
	* DESCRIPTOR: an example namespace call 
	* @param param 
	* @return return  
	*/
	public function retrieve($args){
		#echo __METHOD__.__LINE__.'$args<pre>['.var_export($args, true).']</pre>'.'<br>'; 
		#echo __METHOD__.__LINE__.'<br>';
		$this->init($args);
		/**
		if(!isset($args["action"])){
			$this->error = new \StdClass();
			$this->error->code = "FAILED_CALL";
			$this->error->message = ' NO SERVICE ACTION DEFINED';
			$this->error->data = 'no service call made';
			return false;
		}
		*/

		#echo __METHOD__.__LINE__.'$args["table"]<pre>['.var_export($args["table"], true).']</pre>'.'<br>'; 
		$this->serviceResponse[] = $this->DAO->tables[$args["table"]]["values"];
		/*
		$this->serviceResponse[] = $this->DAO->tables[$args["table"]]["values"];
		echo __METHOD__.__LINE__.'$this->serviceResponse<pre>['.var_export($this->serviceResponse, true).']</pre>'.'<br>'; 
		$this->serviceResponse = array();
		$this->serviceResponse["title"] = 'Block Eight';
		$this->serviceResponse["type"] = 'page';
		$this->serviceResponse["data"] = $args;
		*/
		return $this->serviceResponse;
	}
	/**
	* DESCRIPTOR: an example namespace call 
	* @param param 
	* @return return  
	*/
	public function create($args){
		#echo __METHOD__.__LINE__.'<br>';
		echo __METHOD__.__LINE__.'$args<pre>['.var_export($args, true).']</pre>'.'<br>'; 
		$this->init($args);
		/*
		if(!isset($args["action"])){
			$this->error = new \StdClass();
			$this->error->code = "FAILED_CALL";
			$this->error->message = ' NO SERVICE ACTION DEFINED';
			$this->error->data = 'no service call made';
			return false;
		}

		$this->serviceResponse = array();
		$this->serviceResponse["title"] = 'Block Eight';
		$this->serviceResponse["type"] = 'page';
		*/
		
		
		
		return true;
	}	
	
	/**
	* DESCRIPTOR: an example namespace call 
	* @param param 
	* @return return  
	*/
	public function update($args){
		/**
		echo __METHOD__.__LINE__.'<br>';
		echo __METHOD__.__LINE__.'$args["values"]<pre>['.var_export($args["values"], true).']</pre>'.'<br>'; 
		*/
		$this->init($args);
		
		foreach($args["values"] as $key => $value){
			$this->DAO->set($args["table"], $key, $value);
			
		}
		/*
		if(!isset($args["action"])){
			$this->error = new \StdClass();
			$this->error->code = "FAILED_CALL";
			$this->error->message = ' NO SERVICE ACTION DEFINED';
			$this->error->data = 'no service call made';
			return false;
		}

		$this->serviceResponse = array();
		$this->serviceResponse["title"] = 'Block Eight';
		$this->serviceResponse["type"] = 'page';
		echo __METHOD__.__LINE__.'$this->DAO<pre>['.var_export($this->DAO, true).']</pre>'.'<br>'; 
		*/
		$this->serviceResponse = $this->DAO->save();
		#echo __METHOD__.__LINE__.'$this->serviceResponse[]<pre>['.var_export($this->serviceResponse, true).']</pre>'.'<br>'; 
		
		
		return $this->serviceResponse;
	}
	
	/**
	* DESCRIPTOR: an example namespace call 
	* @param param 
	* @return return  
	*/
	public function aServiceMethod($args){
		#echo __METHOD__.__LINE__.'<br>';
		#echo __METHOD__.__LINE__.'$args<pre>['.var_export($args, true).']</pre>'.'<br>'; 
		if(!isset($args["action"])){
			$this->error = new StdClass();
			$this->error->code = "FAILED_CALL";
			$this->error->message = ' NO SERVICE ACTION DEFINED';
			$this->error->data = 'no service call made';
			return false;
		}

		$this->serviceResponse = array();
		$this->serviceResponse["title"] = 'Block Eight';
		$this->serviceResponse["type"] = 'page';
		return true;
	}
	
}



?>