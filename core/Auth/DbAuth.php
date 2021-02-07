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
		$user = $this->db->prepare("SELECT user.*
            FROM user 
            WHERE user.email = :email",
		['email' => $email],
		null,
		true);
		// var_dump($user);
		// var_dump($password);
		if ($user) {
			// var_dump($user);
			if (password_verify($password, $user->mdp)) {
				if (isset($_POST['remember'])) {
					// TODO consentement cookies
					if (isset($_COOKIE['cookieconsent_status'] ) && $_COOKIE['cookieconsent_status'] === 'allow') {
						setcookie('rememberMe', $user->email, time() + 60 * 60 * 24 * 7);
					}
				}
				foreach ($user as $key => $value) {
					if ($key != 'mdp') {
						$_SESSION['marketplace'][$key] = $value;
					}
				}
				
				return $user;
			}
			return false;
		} 

		return false;
	}

	/**
	 * Login to the back office
	 *
	 * @param string $username
	 * @param string $password
	 * @return boolean
	 */
	public function loginPNM(string $email, string $password) :bool {
		$user = $this->db->prepare("SELECT techniciens.*, users.*
            FROM (techniciens
            INNER JOIN users ON techniciens.users_id = users.id)
            WHERE users.email = :email",
		['email' => $email],
		null,
		true);

		if ($user) {
			if (password_verify($password, $user->mdp)) {
				if (isset($_POST['remember'])) {
					// TODO consentement cookies
					if (isset($_COOKIE['cookieconsent_status'] ) && $_COOKIE['cookieconsent_status'] === 'allow') {
						setcookie('rememberMe', $user->email, time() + 60 * 60 * 24 * 7);
					}
				}

				foreach ($user as $key => $value) {
					if ($key != 'mdp') {
						$_SESSION['marketplace'][$key] = $value;
					}
				}
				
				return true;
			}
		} else {
			header('location: ' . ROUTE . 'connexion', true, 303);
		}

		return false;
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
