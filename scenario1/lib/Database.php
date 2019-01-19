<?php 

class Database {
	
    private $databases = [];
	private $connexions = []; 

	public function __construct($databases) {
        $this->databases = [];
        foreach ($databases as $name => $config) {
            $database = [
                'host' => $config['host'],
                'port' => $config['port'],
                'name' => $config['name'],
                'user' => $config['user'],
                'password' => $config['password']
            ];
            $this->databases[$name] = $database;
        }
        
		$this->init();
	}

	private function init() {
        foreach($this->databases as $name => $database) {
            // Login to the database
            try {
                $connexion = new PDO('mysql:host=' . $database['host'] . ';port=' . $database['port'] . ';dbname=' . $database['name'], $database['user'], $database['password']);
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connexions[$name] = $connexion;
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
	}

	public function con($database) {
		return $this->connexions[$database];
	}
}
