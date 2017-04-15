<?php
require_once('\xampp\htdocsIncludes\MyApplicationFramework\initialize.php');



$route = new Route();
$route->addRoute('/amazon',					'Home');
$route->addRoute('/userList',			'Home');
$route->addRoute('/userAddUpdate',		'Home');
$route->addRoute('/processUserData', 	'Home');
$route->addRoute('/testUserAdd', 		'Home');
$route->addRoute('/shopping',			'Shopping');
$route->addRoute('/login',				'SessionManagement');
$route->addRoute('/logout',				'SessionManagement');

$route->processUri();
