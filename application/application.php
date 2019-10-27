<?php
class Application {

	protected static $_instance;
	protected $_config = array();
	public $db = null, $controller = null, $view = null, $pageUri = '', $pageQuery = '', $user=null;

	public static function getInstance()
	{
		if (self::$_instance == null)
			self::$_instance = new self;

		return self::$_instance;
	}

	private function __construct()
	{
		$this->_config = require_once('config.php');
		$this->db = new \model\mysql($this->_config['db']);
	}

	public function run()
	{
		$this->controller = new \controller\todo();
		$this->user = new \controller\user();

		list($controllerClass, $controllerAction) = $this->_dispatch();
		if (class_exists($controllerClass)) {
			$this->controller = new $controllerClass;
			if (method_exists($this->controller, $controllerAction))
				$this->controller->$controllerAction();
			else
				$this->exit404();
		} else
			$this->exit404();
		if ($this->view) {
			$this->view->show();
		}
	}

	protected function _dispatch() {
		$clearPath = trim($_SERVER['REQUEST_URI'], '/');
		list($this->pageUri, $this->pageQuery) = explode('?', $clearPath);
		$path = explode('/', trim($this->pageUri, '/'));
		if (!isset($path[0]) || !$path[0])
			$path[0] = 'todo';
		if (!isset($path[1]) || !$path[1])
			$path[1] = 'list';

		$path[0] = '\\controller\\'.$path[0];
		$path[1] = $path[1].'Action';

		return array($path[0], $path[1]);
	}

	public function getSiteDomain() {
		return $this->_config['host']['url'];
	}

	public function exit404() {
		header('HTTP/1.1 404 Not Found');
		$this->view = new \view\baseview();
		$this->view->setContentTemplate('404');
		$this->view->show();
		exit;
	}

	public function redirect($uri = '')
	{
		header('Location:'.$this->_config['host']['url'].$uri);
		exit;
	}

	public function ajaxOK($data = array())
	{
		echo json_encode($data);
		exit;
	}
}