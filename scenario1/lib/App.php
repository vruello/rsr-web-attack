<?php 

class App {

	private $db;
	private $router;
	private $auth;
	private $config;
	private $request;

	public function __construct($config) {
		$this->config = $config;
	}

	/** 
	 * Entry point of the app
	 */
	public function bootstrap() {
	
		$this->bootstrap_dabatase();
		$this->bootstrap_router();
		$this->bootstrap_authentication_manager();

		$request = $this->router->parse();

		// Check authorization
		if (!$this->auth->authorize($request)) {
			$this->router->access_denied();
		}
		else {
			$this->execute($request);
		}
	}

	private function execute(Request $request) {
		$this->request = $request;
		$app = $this;
		$this->router->run($request->route(), $app);
	}

	private function bootstrap_dabatase() {
		$this->db = new Database($this->config['database']);
	}

	private function bootstrap_router() {
		$this->router = new Router($this->config['router']);
	}

	private function bootstrap_authentication_manager() {
		$this->auth = new AuthenticationManager($this->db);
	}

	public function db() {
		return $this->db;
	}

	public function auth() {
		return $this->auth;
	}

	public function request() {
		return $this->request;
	}

	public function router() {
		return $this->router;
	}

	
}