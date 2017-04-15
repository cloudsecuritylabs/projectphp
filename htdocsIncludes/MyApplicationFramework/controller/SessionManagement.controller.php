<?php

class SessionManagement
{
	private $uriGetParam;
	
	function __construct($uriGetParam = null)
	{
		$this->uriGetParam = $uriGetParam;
		
		if ( $this->uriGetParam == '/login') {
			if ( isset($_POST['loginName'])
				 && isset($_POST['loginPassword'])
				) {
					$myUserDB = new UserDB();
					
					$userRoles = array("guest");
					
					if ( $myUserDB->validateCredentials($_POST['loginName'], $_POST['loginPassword']))
					{
						array_push($userRoles, 'user');
						$_SESSION['userRoles'] = $userRoles;
						
						// Get user and save it as a SESSION variable
						$currentUser = $myUserDB->getCurrentUser();
						$_SESSION['currentUser'] = serialize($currentUser);
					}						
			}

			// Perform redirect
			$location = WEB_ROOT;
			header("Location: {$location}");
			exit;		
		} else if ( $this->uriGetParam == '/logout') {
			session_destroy();

			// Perform redirect
			$location = WEB_ROOT;
			header("Location: {$location}");
			exit;
		} else {
			echo 'SessionManagement Controller: Default...';
		}
	}
}