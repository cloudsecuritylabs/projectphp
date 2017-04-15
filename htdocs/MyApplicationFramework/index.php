<?php
// get the initialize file.
require_once('\xampp\htdocsIncludes\MyApplicationFramework\initialize.php');

//create necessary routes.
$route = new Route();
$route->addRoute('/',					'Home');
$route->addRoute('/userList',			'Home');
$route->addRoute('/userAddUpdate',		'Home');
$route->addRoute('/processUserData', 	'Home');
$route->addRoute('/testUserAdd', 		'Home');
$route->addRoute('/shopping',			'Shopping');
$route->addRoute('/login',				'SessionManagement');
$route->addRoute('/logout',				'SessionManagement');

//Basu project specific Stuff
$route->addRoute('/protoAmazon',					'Home');

$route->addRoute('/productList',			'Home');
$route->addRoute('/productUpdate',		'Home');
$route->addRoute('/processProductData', 	'Home');
$route->addRoute('/productAdd', 		'Home');

$route->addRoute('/categoryList',			'Home');
$route->addRoute('/categoryUpdate',		'Home');
$route->addRoute('/processProductData', 	'Home');
$route->addRoute('/productAdd', 		'Home');


$route->addRoute('/shopping',			'Shopping');
$route->addRoute('/login',				'SessionManagement');
$route->addRoute('/logout',				'SessionManagement');

$route->processUri();
