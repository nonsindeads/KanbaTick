<?php
require_once('./model/Medoo.php');

use Medoo\Medoo;
 
$GLOBALS['db'] = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'demo',
	'server' => 'mysql',
	'username' => 'demo',
	'password' => 'demo',
 
	// [optional]
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
    'port' => 3306
]);