<?php
namespace model;

class user {
	public $app = null;
	public function __construct()
	{
		$this->app = \application::getInstance();
	}

	public function getUser($id)
	{
		return $this->app->db->getRow('select * from admins where id=?i', $id);;
	}

	public function getAuthUser($login, $pwd)
	{
		return $this->app->db->getRow('select * from admins where login=?s and pwd=password(?s)', $login, $pwd);
	}
}