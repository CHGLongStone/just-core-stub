<?php
/**
 * SIGNUP
 * 
 * 
 * @author	Jason Medland<jason.medland@gmail.com>
 * @package	JCORE\SERVICE\USER
 * 
 */
 
 

namespace JCORE\SERVICE\USER;

use JCORE\TRANSPORT\SOA\SOA_BASE as SOA_BASE;
use JCORE\DAO\DAO as DAO;

/**
 * Class SIGNUP
 *
 * @package JCORE\SERVICE\USER\SIGNUP 
*/
class SIGNUP extends SOA_BASE{ 
	/** 
	* serviceRequest
	*
	* @access protected 
	* @var array
	*/
	protected $serviceRequest = null;
	/** 
	* serviceResponse
	*
	* @access public 
	* @var array
	*/
	public $serviceResponse = null;
	/** 
	* error
	*
	* @access public 
	* @var array
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
		$this->parentTable = 'client';
		$this->childTable = 'client_user';
		#$this->childTable1 = 'email';
		return;
	}
	
	/**
	* DESCRIPTOR: 
	* 
	* @param args 
	* @return return  
	*/
	public function init($args){
		#echo __METHOD__.__LINE__.'$args<pre>['.var_export($args, true).']</pre>'.'<br>'; 
		/*
		if(!$args['asd']){
			
		}
		*/
		if(!isset($args["DSN"])){
			$this->params["DSN"] = "JCORE";
		}
		$config = array(
			"DSN" => $this->params["DSN"],
			"table" => $this->parentTable,
			"pk_field" => "client_user_pk",
		);
		/*
		$DAO2 = new JCORE\DAO\DAO($config);		
		*/
		$this->clientDAO = new DAO($config);
		$this->clientDAO->initialize($config["DSN"], $config["table"], true);
		##$this->clientDAO->initializeChildRecord($config["DSN"], $this->childTableXXX, 'principal_contact', 'client_user_pk');
		#$this->clientDAO->initializeChildRecord($config["DSN"], $this->childTableXXX, 'client_user_pk', 'principal_contact');
		return;
	}
	

	
	
	/**
	* DESCRIPTOR: an example namespace call 
	*
	* @param args 
	* @return return  
	*/
	public function SignUpUser($args){
		$this->init($args);
		/**
		echo __METHOD__.__LINE__.'$args<pre>['.var_export($args, true).']</pre>'.'<br>'; 
			->initializeChildRecord($DSN, $tableName, $pk_field, $fk_field)
			$this->clientDAO->set($this->childTable, 'first_name', $args['first_name']);
		*/
		
		$this->clientDAO->set($this->parentTable, 'company_name', $args['company_name']);
		
		$api_key = md5($args['company_name'].$args['email'].time());
		$this->clientDAO->set($this->parentTable, 'api_key', $api_key );
		/*
		* note to user that we'll use the same password as the default
		$params = array(
			'profile' => 'SIGNUP_FORM',
			'password' => $args['password'],
		); 
		*/
		$password = \password_hash($args['password'], PASSWORD_DEFAULT);
		#echo __METHOD__.__LINE__.'$password<pre>['.var_export($password, true).']</pre>'.'<br>'; 
		$this->clientDAO->set($this->parentTable, 'pass_phrase', $password);
		
		#echo __METHOD__.__LINE__.' '.'<br>'.PHP_EOL; 
		$parentResult = $this->clientDAO->save($this->parentTable);
		#echo __METHOD__.__LINE__.'$parentResult<pre>['.var_export($parentResult, true).']</pre>'.'<br>'.PHP_EOL; 
		#echo __METHOD__.__LINE__.'$this->clientDAO->tables<pre>['.var_export($this->clientDAO->tables, true).']</pre>'.'<br>'.PHP_EOL; 
		#echo __METHOD__.__LINE__.'$this->clientDAO<pre>['.var_export($this->clientDAO, true).']</pre>'.'<br>'; 
		#echo __METHOD__.__LINE__.' '.'<br>'.PHP_EOL; 
		
		
		
		
		$this->clientDAO->initializeChildRecord($this->params["DSN"], $this->childTable, 'client_user_pk', 'client_fk');
		#echo __METHOD__.__LINE__.' '.'<br>'.PHP_EOL; 
		#$this->clientDAO->set($this->childTable, 'user_name', $args['user_name']);
		/**
		* default the user role to 3 - Client
		*/
		$this->clientDAO->set($this->childTable, 'user_role_fk', 3);
		
		
		$this->clientDAO->set($this->childTable, 'alias', $args['alias']);
		$this->clientDAO->set($this->childTable, 'email', $args['email']);
		$this->clientDAO->set($this->childTable, 'first_name', $args['first_name']);
		$this->clientDAO->set($this->childTable, 'last_name', $args['last_name']);
		$this->clientDAO->set($this->childTable, 'password', $password);
		$this->clientDAO->set($this->childTable, 'address', $args['address']);
		$this->clientDAO->set($this->childTable, 'city', $args['city']);
		$this->clientDAO->set($this->childTable, 'state', $args['state']);
		$this->clientDAO->set($this->childTable, 'country', $args['country']);
		$this->clientDAO->set($this->childTable, 'postal_code', $args['postal_code']);
		if(isset($args['fax'])){
			$this->clientDAO->set($this->childTable, 'fax', $args['fax']);
		}
			
		#echo __METHOD__.__LINE__.' '.'<br>'.PHP_EOL; 
		
		
		#echo __METHOD__.__LINE__.'$this->clientDAO<pre>['.var_export($this->clientDAO, true).']</pre>'.'<br>'; 
		$result = $this->clientDAO->save($this->childTable);
		#echo __METHOD__.__LINE__.'$result<pre>['.var_export($result, true).']</pre>'.'<br>'.PHP_EOL; 
		if(
			isset($result[0]['EXCEPTION']['ID']) 
			&& 
			1062 == $result[0]['EXCEPTION']['ID']
		){
			$result['status'] = 'OK';
			$this->serviceResponse = $result;
			
			return $this->serviceResponse;
			#return $result;
		}

		#echo __METHOD__.__LINE__.' '.'<br>'.PHP_EOL; 
		$response = array(
			'status' => 'OK',
			'info' => array(
				'msg' => 'Account Created',
				'api_key' => $api_key,
				'callback' => 'justcore.signUp.signUpNotification',
			),
			
		);
		if(isset($args['callback'])){
			//angular.callbacks._0
			$response[$args['callback']] = 'we did something else with your record';
		}
		$this->serviceResponse = $response;
		#echo __METHOD__.__LINE__.'$this->serviceResponse[]<pre>['.var_export($this->serviceResponse, true).']</pre>'.'<br>'; 
		
		
		#echo __METHOD__.__LINE__.' '.'<br>'.PHP_EOL; 
		return $this->serviceResponse;
	}
	
}



?>