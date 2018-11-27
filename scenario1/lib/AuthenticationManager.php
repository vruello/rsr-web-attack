<?php 

class AuthenticationManager {
	
	private $db;
	private $user;

	function __construct(Database $db) {
		$this->db = $db;	
		$this->user = null;
	}

	public function login($username, $password) {
		$req = $this->db->con()->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
		$req->execute(array(
			':username' => $username,
			':password' => hash('sha256', $password)
		));

		$data = $req->fetchAll();

		if (count($data) === 1) {
			$this->user = $data[0];

			$_SESSION['logged'] = true;
			$_SESSION['user_id'] = $this->user['id_users'];

			return true;
		} 

		return false;
	}

	public function logout() {
		if ($this->user === null) {
			return false;
		}

		$_SESSION['logged'] = false;
		$_SESSION['user_id'] = null;

		return true;
	}

	private function load_user($force = false) {		
		if ($this->user && !$force) 
			return true;

		if (isset($_SESSION['logged']) && $_SESSION['logged'] === true && isset($_SESSION['user_id'])) {

			$req = $this->db->con()->prepare('SELECT * FROM users WHERE id_users = :id');
			$req->execute(array(':id' => (int) $_SESSION['user_id']));

			$data = $req->fetchAll();
			
			if (count($data) === 1) {
				$this->user = $data[0];

				return true;
			}
			
		}

		return false;
	}
	
	public function authorize(Request $request) {
		$route = $request->route();

		$allow_guest = $route[1];
		$allow_authenticated = $route[2];

		$authenticated = $this->load_user();

		if ($authenticated && $allow_authenticated || !$authenticated && $allow_guest) {
			return true;
		}
		
		return false;
	}

	public function user() {
		return $this->user;
	}

}