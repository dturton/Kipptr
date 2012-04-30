<?php

namespace Kipptr;

if(!function_exists('curl_init')) {
	throw new Exception('Kipptr needs the cURL PHP extension.');
}

if(!function_exists('json_decode')) {
	throw new Exception('Kipptr needs the JSON PHP extension.');
}

/**
 * Base API class
 *
 * @author		BrianLabs
 * @copyright	Copyright (c) 2012 BrianLabs
 * @license		http://unlicense.org/
 * @version		1.0.0
 * @package		Kipptr
 *
 */
class Core {

	/********************* PROPERTY ********************/
	
	/**
	 * Base URL
	 *
	 * @access	private
	 * @var		string	$_baseurl
	 */
	private static $_baseurl = 'https://kippt.com/api/';
	
	/**
	 * cURL default options
	 *
	 * @access	private
	 * @var		array	$_curl_options
	 */
	private static $_curl_options = array(
		CURLOPT_CONNECTTIMEOUT	=> 10,
		CURLOPT_RETURNTRANSFER	=> true,
		CURLOPT_TIMEOUT			=> 30,
		CURLOPT_USERAGENT		=> 'Kipptr/1.0.0',
		CURLOPT_SSL_VERIFYPEER	=> false
	);
	
	/**
	 * Account credentials (username, apikey)
	 *
	 * @access	private
	 * @var		array	$_credentials
	 */
	private static $_credentials;
	
	/********************* INIT ********************/
	
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	string	$username	Username
	 * @param	string	$token		API-token (From the settings)
	 */
	public static function init($username, $token) {
		self::$_credentials = compact('username', 'token');
	}
	
	/**
	 * Lazy-loads class files when a given class is first used
	 *
	 * @access	public
	 * @param	string	$class	Class name
	 */
	public static function autoload($class) {
		$file = dirname(__FILE__) . '/classes/' . str_replace(array('\\', '_'), DIRECTORY_SEPARATOR, substr($class, 6)) . '.class.php';
		
		if(file_exists($file)) {
			require_once($file);
		}
	}
	
	/********************* PUBLIC ********************/
	
	/**
	 * Check if user is authenticating correctly
	 *
	 * @access	public
	 * @return	array|int
	 */
	public static function verify() {
		return self::exec('account');
	}
	
	/********************* PROTECTED ********************/
	
	/**
	 * Perform a cURL session
	 *
	 * @access	protected
	 * @param	string	$func	API function
	 * @param	array	$args	Data that should be sended
	 * @param	string	$method	HTTP request method (GET, POST, PUT, DELETE)
	 * @return	array|int
	 */
	protected static function exec($func, $args = null, $method = 'GET') {
		$url = self::$_baseurl . $func . '/';
		
		self::$_curl_options[CURLOPT_HTTPHEADER] = array(
			'Content-Type: application/json',
			'X-Kippt-Username: ' . self::$_credentials['username'],
			'X-Kippt-API-Token: ' . self::$_credentials['token']
		);
		
		switch($method) {
			case 'GET':
				if(!empty($args)) {
					$url .= '?' . http_build_query($args);
				}
			break;
			
			case 'POST':
				self::$_curl_options[CURLOPT_POST]			= true;
				self::$_curl_options[CURLOPT_POSTFIELDS]	= json_encode($args);
			break;
			
			case 'PUT':
				$data = stripslashes(json_encode($args));
				
				self::$_curl_options[CURLOPT_CUSTOMREQUEST]	= 'PUT';
				self::$_curl_options[CURLOPT_INFILESIZE]	= strlen($data);
				self::$_curl_options[CURLOPT_POSTFIELDS]	= $data;
			break;
			
			case 'DELETE':
				self::$_curl_options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
			break;
		}
		
		$curl = curl_init($url);
		curl_setopt_array($curl, self::$_curl_options);
		
		$resp = curl_exec($curl);
		$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		
		curl_close($curl);
		
		return ($status == 200 || $status == 201) ? json_decode($resp, true) : $status;
	}
}

spl_autoload_register(array('Kipptr\Core', 'autoload'));