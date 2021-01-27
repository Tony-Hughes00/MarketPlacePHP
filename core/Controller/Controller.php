<?php

namespace Core\Controller;

use App;
use App\Core\Entity;
/**
 * @package Core\Controller
 */
class Controller {

	private $entityFactory;
	protected string $viewPath;
	protected string $template = 'default';
	

	public function __construct() {
		App::console_log( "Entity constructor" );
		// $this->entityFactory = new EntityFactory();
	}
	/**
	 * Render the page
	 *
	 * @param string $view
	 * @param array $vars
	 * @return string
	 */
	protected function render(string $view, array $vars = []) :string {
		ob_start();
		extract($vars);
		require($this->viewPath . str_replace('.', '/', $view) . '.php');
		$getPage = str_replace(".php", "", basename($_SERVER['PHP_SELF']));
		$content = ob_get_clean();
		require($this->viewPath . 'Templates/' . $this->template . '.php');
		die();
	}

	/**
	 * Generate an page (if specified) for HTTP 403 errors
	 *
	 * @return string
	 */
	public function forbidden() :string {
		header('HTTP/1.0 403 Forbidden');
		die('Api overloaded 403 forbidden');
	}

	/**
	 * Generate an page (if specified) for HTTP 404 errors
	 *
	 * @return string
	 */
	public function notFound() :string {
		header('HTTP/1.0 404 Not Found');
		die('404 not found');
	}
	/**
	 * Generate an page (if specified) for HTTP 404 errors
	 *
	 * @return string
	 */
	public function httpRespond($resBody) {

		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authorization");
		header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

		header('Content-Type: application/json');

		echo json_encode($resBody);
	}
		/**
	 * Generate an page (if specified) for HTTP 404 errors
	 *
	 * @return string
	 */
	public function Titre($titre) {
		App::getInstance()->title = $titre .  App::getInstance()->title;
	}
	private function getEntityFactory() {
		if ($this->entityFactory == null) {
			$this->entityFactory = new EntityFactory();
		}
		return $this->entityFactory;
	}
	public function load($table, $col, $val) {
		return $this->getEntityFactory()->load($table, $col, $val);
	}
	public function loadBy($user, $email, $value)
	{
		Entity::loadBy($user, $email, $value);
	}
	public function fromArray($userData) {
		Entity::fromArray($userData);
	}
	public function UserId() {
		return $this->getAuth()->getUserId();
	}
	public function console_log($message) {
		App::console_log($message);
	}
}
