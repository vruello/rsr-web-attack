<?php  

class Router {

	private $routes, $default, $not_found_page, $access_denied_page, $protocol;
	private $current_page, $current_route;

	function __construct($config) {
		$this->routes = $config['routes'];
		$this->default = $config['default'];
		$this->not_found_page = $config['not_found_page'];
		$this->access_denied_page = $config['access_denied_page'];
		$this->protocol = $config['protocol'];
		$this->current_page = null;
		$this->current_route = null;
	}

	public function parse() {
		$request = new Request();
		
		$page = $request->get('p');
		
		if ($page === null || $page === '') {
			$request->setRoute($this->routes[$this->default]);
		}
		else if (array_key_exists($page, $this->routes)) {
			$request->setRoute($this->routes[$page]);
		} 
		else {
			$request->setRoute([$this->not_found_page, true, true]);
		}

		$this->current_page = $page;
		$this->current_route = $request->route();

		return $request;
	}

	public function run($route, App $app) {
		require(__DIR__ . '/../' . $route[0]);
	}


	public function access_denied(App $app) {
		require(__DIR__ . '/../' . $this->access_denied_page);
	}

	public function redirect($route_name, $params = []) {
		$base = strtok($_SERVER["REQUEST_URI"],'?');
		$url = $base. '?p=' . $route_name;
		
		foreach ($params as $key => $value) {
			$url .= '&' . $key . '=' . $value;
		}

		header('Location: ' . $url);
		exit;
	}

	public function url($route_name = null, $params = []) {

		$url = null;
		
		if (!$route_name) {
			$route_name = $this->current_page;
		}

		$base = $this->protocol . '://' . $_SERVER['HTTP_HOST'] . strtok($_SERVER["REQUEST_URI"],'?');
		$url = $base. '?p=' . $route_name;

		foreach ($params as $key => $value) {
			$url .= '&' . $key . '=' . $value;
		}
		
		return $url;
	}

	public function current() {
		return $this->current_page;
	}
}