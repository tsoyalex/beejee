<?php
namespace controller;

class todo extends basecontroller {
	protected $_model = null;
	protected $_orderFields = array(
		'id' => array('field'=>'id', 'desc'=>''),
		'-id' => array('field'=>'id', 'desc'=>'desc'),
		'name' => array('field'=>'name', 'desc'=>''),
		'-name' => array('field'=>'name', 'desc'=>'desc'),
		'email' => array('field'=>'email', 'desc'=>''),
		'-email' => array('field'=>'email', 'desc'=>'desc'),
		'status' => array('field'=>'status', 'desc'=>''),
		'-status' => array('field'=>'status', 'desc'=>'desc'),
	);

	public function __construct()
	{
		parent::__construct();
		$this->app->view = new \view\view();
		$this->_model = new \model\todo();
	}

	public function listAction()
	{
		$this->app->view->setContentTemplate('todo/list');

		$todoCount = $this->_model->getTaskCount();

		$paginator = new paginator();
		$paginator->paginate($todoCount);

		if (!$_SESSION['tasks']['order'])
			$_SESSION['tasks']['order'] = '-id';
		$orderField = $this->_orderFields[$_SESSION['tasks']['order']];
		$taskList = $this->_model->getTaskList($paginator->start, $paginator->item_per_page, $orderField['field'], $orderField['desc']);

		$this->app->view->setVar('paginator', $paginator);
		$this->app->view->setVar('taskList', $taskList);
	}

	public function addAction()
	{
		$task = array(
			'name' => trim(strip_tags($_POST['name'])),
			'email' => trim(strip_tags($_POST['email'])),
			'text' => trim(strip_tags($_POST['text'])),
		);

		$errors = array();
		if (!$task['name'])
			$errors[] = 'Не указано имя пользователя';
		if (!$task['email'])
			$errors[] = 'Не указан email пользователя';
		if (filter_var($task['email'], FILTER_VALIDATE_EMAIL) === false)
			$errors[] = 'Email не валиден';
		if (!$task['text'])
			$errors[] = 'Не указан текст задачи';

		$_SESSION['alerts']['error'] = $errors;
		if (!count($errors))
		{
			$res = $this->_model->addTask($task);
			if ($res)
				$_SESSION['alerts']['info'][] = 'Задача успешно добавлена в список задач';
			else
				$_SESSION['alerts']['error'][] = 'Произошла неизвестная ошибка';
		}
		$this->app->redirect();
	}

	public function finishAction()
	{
		$res = array();
		if ($this->app->user->isUserAuth())
		{
			$this->_model->finish((int)$_POST['id']);
		} else
		{
			$res['error'] = 'Для завершения задачи необходимо пройти авторизацию';
		}
		$this->app->ajaxOK($res);
	}

	public function changeOrderAction()
	{
		$field = $_POST['field'];
		if (isset($this->_orderFields[$field]))
		{
			$_SESSION['tasks']['order'] = $field;
		}
		$this->app->ajaxOK();
	}

	public function getTextAction()
	{
		$id = (int)$_POST['id'];
		$task = array();
		if ($this->app->user->isUserAuth())
		{
			$task = $this->_model->getTask($id);
		}
		$this->app->ajaxOK($task);
	}

	public function editTextAction()
	{
		$id = (int)$_POST['id'];
		$text = strip_tags($_POST['text']);
		$res = array();
		if ($this->app->user->isUserAuth())
		{
			$this->_model->editText($id, $text);
		} else
		{
			$res['error'] = 'Для редактирования задачи необходимо пройти авторизацию';
		}
		$this->app->ajaxOK($res);
	}
}