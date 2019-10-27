<?php
namespace view;

class baseview
{
	protected $_layout = '', $_vars = array(), $_contentTemplate;
	public $app = null;
	public function __construct($layout = 'main')
	{
		$this->_layout = $layout;
		$this->app = \application::getInstance();
	}

	public function show()
	{
		if (file_exists('templates/layouts/'.$this->_layout.'.tpl'))
			require('templates/layouts/'.$this->_layout.'.tpl');
		else
			throw new Exception('Template "' . $this->_layout . '" not found');

		unset($_SESSION['alerts']);
	}

	public function setContentTemplate($template)
	{
		if (file_exists('templates/pages/'.$template.'.tpl')) {
			$this->_contentTemplate = 'templates/pages/'.$template.'.tpl';
		}
	}

	public function setVar($var, $value)
	{
		$this->_vars[$var] = $value;
	}

}