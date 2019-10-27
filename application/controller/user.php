<?php
namespace controller;

class user extends basecontroller {
	protected $_user = array(), $_model = null;

	public function __construct()
	{
		parent::__construct();
		$this->_model = new \model\user();
		if ($_SESSION['user'])
		{
			$this->_user = $this->_model->getUser($_SESSION['user']['id']);
			if (!$this->_user)
				unset($_SESSION['user']);
		}
	}

	public function isUserAuth()
	{
		return $this->_user?true:false;
	}

	public function authAction()
	{
		$this->_user = $this->_model->getAuthUser($_POST['auth_login'], $_POST['auth_pwd']);
		$_SESSION['user'] = $this->_user;
		if ($this->_user)
			$_SESSION['user'] = $this->_user;
		else
			$this->app->redirect('user/authError');

		$this->app->redirect('');
	}

	public function logoutAction()
	{
		unset($_SESSION['user']);
		$this->app->redirect('');
	}

	public function authErrorAction()
	{
		$this->app->view->setContentTemplate('user/auth-error');
	}
}