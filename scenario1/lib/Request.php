<?php 

class Request {
	
	private $route;
	private $_get = array();
	private $_post = array();

	function __construct() {
		foreach ($_GET as $key => $value) {
			$this->_get[$key] = $value;
		}

		foreach ($_POST as $key => $value) {
			$this->_post[$key] = $value;
		}

		$_GET = null;
		$_POST = null;
	}

	private function load_parameter($key, $table) {
		if (array_key_exists($key, $table)) {
			return $table[$key];
		}
		
		return null;
	}

	public function get($key) {
		return $this->load_parameter($key, $this->_get);
	}
	
	public function post($key) {
		return $this->load_parameter($key, $this->_post);
	}

	public function setRoute($route) {
		$this->route = $route;
	}

	public function route() {
		return $this->route;
	}
}