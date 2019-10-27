<?php
error_reporting(E_ERROR);
ini_set("error_reporting", E_ERROR);
session_start();

include('autoload.php');
$application = Application::getInstance();
$application->run();