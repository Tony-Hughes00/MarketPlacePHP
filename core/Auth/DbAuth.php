<?php

namespace Core\Auth;

/**
 * Setup DB and user interaction
 * @package Core\Auth
 */
class DbAuth {

	private object $db;

    public function __construct(object $db) {
		$this->db = $db;
	}
	
	/**
	 * Get the user id from SESSION if exist
	 *
	 * @return mixed|bool
	 */
	public function getUserId() {
		if ($this->logged()) {
			return $_SESSION['marketplace']['id_user'];
		}
		return false;
	}

	/**
	 * Login to the site
	 *
	 * @param string $username
	 * @param string $password
	 * @return boolean
	 */
	public function login(string $email, string $password)  {
		$res = (object) array();
		$res->user = $this->db->prepare("SELECT user.*
            FROM user 
            WHERE user.email = :email AND NOT (user_type = 'client')",
		['email' => $email],
		null,
		true);
		var_dump($res->user);
		// var_dump($password);
		if ($res->user) {

			if (password_verify($password, $res->user->mdp)) {
				var_dump($res->user);
				$res->status = 0;
				$res->message = "connexion valide";
				if (isset($_POST['remember'])) {
					// TODO consentement cookies
					if (isset($_COOKIE['cookieconsent_status'] ) && $_COOKIE['cookieconsent_status'] === 'allow') {
						setcookie('rememberMe', $res->user->email, time() + 60 * 60 * 24 * 7);
					}
				}
				foreach ($res->user as $key => $value) {
					if ($key != 'mdp') {
						$_SESSION['marketplace'][$key] = $value;
					}
				}
				
				return $res;
			}
			// $res->status = 2;				// mdp invalid
			// $res->message = "mdp invalid";
			// var_dump($res->user);
			$res->status = 0;
			$res->message = "connexion valide";
			return $res;
		} 
		$res->status = 1;				// mdp invalid
		$res->message = "utilisateur non trouvé";
	return $res;
	}

	/**
	 * Login to the back office
	 *
	 * @param string $username
	 * @param string $password
	 * @return boolean
	 */
	public function loginUser(string $email, string $password) {
		$res = (object) array();
		$res->user = $this->db->prepare("SELECT user.*
            FROM user 
            WHERE user.email = :email AND user_type = 'client'",
		['email' => $email],
		null,
		true);
		var_dump($res->user);
		// var_dump($password);
		if ($res->user) {

			if (password_verify($password, $res->user->mdp)) {
				var_dump($res->user);
				$res->status = 0;
				$res->message = "connexion valide";
				if (isset($_POST['remember'])) {
					// TODO consentement cookies
					if (isset($_COOKIE['cookieconsent_status'] ) && $_COOKIE['cookieconsent_status'] === 'allow') {
						setcookie('rememberMe', $res->user->email, time() + 60 * 60 * 24 * 7);
					}
				}
				foreach ($res->user as $key => $value) {
					if ($key != 'mdp') {
						$_SESSION['marketplace'][$key] = $value;
					}
				}
				
				return $res;
			}
			// $res->status = 2;				// mdp invalid
			// $res->message = "mdp invalid";
			// var_dump($res->user);
			$res->status = 0;
			$res->message = "connexion valide";
			return $res;
		} 
		$res->status = 1;				// mdp invalid
		$res->message = "utilisateur non trouvé";
	return $res;
	}

	/**
	 * Return the session if exist
	 *
	 * @return bool
	 */
	public function logged() :?bool {
		return isset($_SESSION['marketplace']);
	}

}
