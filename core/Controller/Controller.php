<?php

namespace Core\Controller;

use App;
use Core\Entity\Entity;
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
	public function sendHeaders() {

		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authorization");
		header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

		header('Content-Type: application/json');

	}
	public function sendResponse($body) {

		$resBody = (object) array();
		$resBody->status = "200";
		$resBody->message = "valid request";
		$resBody->data = $body;

		$this->sendHeaders();
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
	private function getEntity($tableName) {
		if ($this->entityFactory == null) {
			$this->entityFactory = new EntityFactory();
		}
		return $this->entityFactory->get($tableName);
	}
	public function load($table, $col, $val) {
		return $this->getEntity($table)->loadByCol($col, $val);
	}
	public function loadBy($table, $col, $val)
	{
		return $this->getEntity($table)->loadByCol($col, $val);
	}
	public function create($tableName, $row)
	{
		return $this->getEntity($tableName)->create($row);

		// Entity::create($table, $col, $value);
	}
	public function initEntity($tableName, $row) {
		return $this->getEntity($tableName)->initEntity($row);
	}
	public function fromArray($userData) {
		$this->getEntity($table)->init($userData);
	}
	public function UserId() {
		return $this->getAuth()->getUserId();
	}
	public function console_log($message) {
		App::console_log($message);
	}
	public function getBody() {
		return file_get_contents('php://input');
	}
}
