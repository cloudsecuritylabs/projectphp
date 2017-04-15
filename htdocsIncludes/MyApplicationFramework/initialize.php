<?php
	/* **************************************************************************************************	*/
	/*	Description:																						*/
	/*	This file contains a number of the globally defined variables and includes other important files.	*/
	/*																										*/
	/*																										*/
	/*																										*/
	/*																										*/
	/*																										*/
	/* **************************************************************************************************	*/
session_start();
	
/* ************************************************************************* */
/* DEFINED																	 */
/*																			 */
/* 																			 */
/*																			 */
/* 																			 */
/*																			 */
/* 																			 */
/*																			 */
/* 																			 */
/*																			 */
/* ************************************************************************* */

// Create the file system directory separator as a short variable so this 
// application can be on either Windows or Unix hosting.
defined('DS')	? null : define('DS', DIRECTORY_SEPARATOR);

// This identifies the cloation of the include files from the perspective of
// the hard drive.
defined('DOC_ROOT')	? null : define('DOC_ROOT', DS.'xampp'.DS.'htdocsIncludes'.DS.'MyApplicationFramework'.DS);

// This identifies the location of the web application root
defined('WEB_ROOT')	? null : define('WEB_ROOT', '/MyApplicationFramework/');


/* ************************************************************************* */
/* Require Once																 */
/*																			 */
/* 																			 */
/*																			 */
/* 																			 */
/*																			 */
/* 																			 */
/*																			 */
/* 																			 */
/*																			 */
/* ************************************************************************* */
require_once(DOC_ROOT.'functions.php');
require_once(DOC_ROOT.'model'.DS.'Database.class.php');
require_once(DOC_ROOT.'model'.DS.'User.class.php');
require_once(DOC_ROOT.'model'.DS.'UserDB.class.php');

require_once(DOC_ROOT.'Route.class.php');

require_once(DOC_ROOT.'controller'.DS.'Home.controller.php');
require_once(DOC_ROOT.'controller'.DS.'Shopping.controller.php');
require_once(DOC_ROOT.'controller'.DS.'SessionManagement.controller.php');






