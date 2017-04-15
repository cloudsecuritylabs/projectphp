<?php

class Home
{
	private $uriGetParam;
	
	function __construct($uriGetParam = null)
	{
		require_once(DOC_ROOT.'view'.DS.'UserList.view.php');
		require_once(DOC_ROOT.'view'.DS.'UserAddModify.view.php');
		
		$this->uriGetParam = $uriGetParam;
		
		if ($this->uriGetParam == '/'){
			include(DOC_ROOT.'view/pageHeader.php');
			echo 'Home Controller:/';
			include(DOC_ROOT.'view/pageFooter.php');			
			
		} else if ( $this->uriGetParam == '/userList') {	
			$users_list = User::find_All();			
			$view = new UserList($users_list);			
			$view->render();
		} else if ( $this->uriGetParam == '/userAddUpdate') {
			
			$view = new UserAddModify();
			$view->render();
		} else if ( $this->uriGetParam == '/processUserData') {
			// identify and harvest the data from the form ($_POST[])
			$temp_firstName 	= isset($_POST['firstName']) 	? $_POST['firstName'] 		: User::$classDetails['firstName']['DefaultValue'];
			$temp_lastName 		= isset($_POST['lastName']) 	? $_POST['lastName'] 		: User::$classDetails['lastName']['DefaultValue'];
			$temp_email 		= isset($_POST['email']) 		? $_POST['email'] 			: User::$classDetails['email']['DefaultValue'];
			$temp_password 		= isset($_POST['password']) 	? $_POST['password'] 		: User::$classDetails['password']['DefaultValue'];
			$temp_displayName 	= isset($_POST['displayName']) 	? $_POST['displayName'] 	: User::$classDetails['displayName']['DefaultValue'];
			
			
			// put the data into a class instance
			$new_user = new User();
			
			$new_user->setFirstName($temp_firstName);
			$new_user->setLastName($temp_lastName);
			$new_user->setEmail($temp_email);
			$new_user->setPassword($temp_password);
			$new_user->setDisplayName($temp_displayName);
			
			
			// verify the data is usable and act on validity
			// decide if we are going to return to edit the data or save the data
			if ($new_user->isValidState()) {
				$new_user->save();
				
				// go to list page
				$location = '/MyApplicationFramework/userList';
			} else {
				// but we must give it some data
				$_SESSION['new_user'] 			= $new_user;
				$_SESSION['temp_firstName'] 	= $temp_firstName;
				$_SESSION['temp_lastName'] 		= $temp_lastName;
				$_SESSION['temp_email'] 		= $temp_email;
				$_SESSION['temp_displayName'] 	= $temp_displayName;
				
				// get back to the add/edit page
				$location = '/MyApplicationFramework/userAddUpdate';
				
			}
			
			// forward to the appropriate page
			header("Location: {$location}");
			exit;	
						
		} else if ( $this->uriGetParam == '/testUserAdd') {
			$new_user = new User();
			$new_user->setFirstName("Jerry");
			$new_user->setLastName("Browner");
			$new_user->setEmail("j@b.com");
			$new_user->setPassword("password");			
			$new_user->setDisplayName("Jerrz");
			
			$new_user->save();
			
			
			
		} else {
			include(DOC_ROOT.'view/pageHeader.php');
			echo 'Home Controller: Default...';
			include(DOC_ROOT.'view/pageFooter.php');
		}
	}
}