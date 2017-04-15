<?php

class UserAddModify
{

	function __construct() {
		
	}
	
	public function render() {
		include(DOC_ROOT.'view/pageHeader.php');
		include(DOC_ROOT.'view/UserAddModifyForm.view.php');
		include(DOC_ROOT.'view/pageFooter.php');
	}
}