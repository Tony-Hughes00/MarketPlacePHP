<?php

namespace Core\Controller;

/**
 * @package Core\Controller
 */
class Controller {

	protected string $viewPath;
	protected string $template = 'default';
	
	/**
	 * Render the page
	 *
	 * @param string $view
	 * @param array $vars
	 * @return string
	 */
	protected function render(string $view, array $vars = []) :string {
		// var_dump($view);
		ob_start();
		// var_dump('ob_start');
		extract($vars);
		// var_dump($vars);
		// var_dump($this->viewPath . str_replace('.', '/', $view) . '.php');
		require($this->viewPath . str_replace('.', '/', $view) . '.php');
		// var_dump($this->viewPath);
		$getPage = str_replace(".php", "", basename($_SERVER['PHP_SELF']));
		// var_dump($getPage);
		$content = ob_get_clean();
		// var_dump($content);
		// var_dump($this->viewPath . 'Templates/' . $this->template . '.php');

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
	public function httpRespond($resBody) {

		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, authorization");
		header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

		header('Content-Type: application/json');

		echo json_encode($resBody);
	}

}
