<?php
define('CLASS_DIR', 'application');
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_extensions(".php");
spl_autoload_register();

function __autoload($class_name)
{
}
spl_autoload_register('__autoload');