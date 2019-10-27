<?php
namespace model;

class todo {
	public $app = null;
	public function __construct()
	{
		$this->app = \application::getInstance();
	}

	public function getTaskCount()
	{
		$data = $this->app->db->getRow('select count(id) as cnt from tasks');
		return (int)$data['cnt'];
	}

	public function getTaskList($from=0, $limit=3, $orderField='id', $orderDesc='desc') {
		return $this->app->db->getAll('select * from tasks order by ?n ?p limit ?i,?i', $orderField, $orderDesc, (int)$from, (int)$limit);
	}

	public function addTask($task) {
		if ($task['name'] && $task['email'] && $task['text'] && filter_var($task['email'], FILTER_VALIDATE_EMAIL)) {
			$this->app->db->query('insert into tasks set ?u', $task);
			return $this->app->db->insertId();
		}
		return false;
	}

	public function finish($id) {
		$this->app->db->query('update tasks set status=1 where id=?i', (int)$id);
	}

	public function getTask($id) {
		return $this->app->db->getRow('select * from tasks  where id=?i limit 1', (int)$id);
	}

	public function editText($id, $text) {
		$this->app->db->query('update tasks set text=?s, edited=1 where id=?i', $text, (int)$id);
	}
}