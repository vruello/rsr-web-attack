<?php 

class Database {
	
	private $host, $port, $name, $user, $password;
	private $connexion; 

	public function __construct($config) {
		$this->host = $config['host'];
		$this->port = $config['port'];
		$this->name = $config['name'];
		$this->user = $config['user'];
		$this->password = $config['password'];

		$this->init();
	}

	private function init() {
		// Login to the database
		try {
			$this->connexion = new PDO('mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->name, $this->user, $this->password);
			$this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die("Connection failed: " . $e->getMessage());
		}
	}

	public function con() {
		return $this->connexion;
	}
}