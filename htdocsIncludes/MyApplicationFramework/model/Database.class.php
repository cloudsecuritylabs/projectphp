<?php

class Database {
	/* ********************************************************************************************************	*/
	/* Class Variables																							*/
	/*																											*/
	/*																											*/
	/*																											*/
	/*																											*/
	/*																											*/
	/* ********************************************************************************************************	*/
	
	/*
	private static $dsn =
		array(	'localDev'	=> 'sqlite:c:/somedir/MyDB.db',
				'Prod'		=> array('mysql:host=localhost;dbname=my_guitar_shop1', 'root', 'somepassword'),
				'Dev2'		=> array('mysql:host=localhost;dbname=my_guitar_shop1', 'root', 'somepassword')
		);
		*/
	private static $dsn = 'mysql:host=localhost:3306;dbname=myAppFw';
	private static $username = 'root';
	private static $password = '';
	private static $db;
	
	protected static $boolean_ConversionValues = array(
														'0'		=> 0,
														'1' 	=> 1,
														'false'	=> 0,
														'true'	=> 1
														);
	
	
	
	/* ********************************************************************************************************	*/
	/* Constructors and Destructors																				*/
	/*																											*/
	/*																											*/
	/*																											*/
	/*																											*/
	/*																											*/
	/* ********************************************************************************************************	*/
	private function __construct() {}
	
	/* ********************************************************************************************************	*/
	/* Public Functions																							*/
	/*																											*/
	/*																											*/
	/*																											*/
	/*																											*/
	/*																											*/
	/* ********************************************************************************************************	*/
	public static function getDB() {
		if (!isset(self::$db)) {
			try {
				self::$db = new PDO(self::$dsn,
									self::$username,
									self::$password
									);
			} catch (PDOException $e) {
				$error_message = $e->getMessage();
				include('../errors/database_error.php');
				exit();
			}
		}
		return self::$db;
	}	
}