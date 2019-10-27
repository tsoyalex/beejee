<?php
namespace controller;

class basecontroller {
	public $app = null;
	public function __construct()
	{
		$this->app = \application::getInstance();
	}
}