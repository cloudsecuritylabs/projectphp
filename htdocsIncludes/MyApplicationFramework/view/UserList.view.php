<?php


class UserList
{
	private $model;
	
	function __construct($new_model)
	{
		$this->model = $new_model;		
	}
	
	public function render()
	{
		include(DOC_ROOT.'view/pageHeader.php');


			
		include(DOC_ROOT.'view'.DS.'UserListRowHeader.view.php');
		foreach($this->model as $row)
		{
			include(DOC_ROOT.'view'.DS.'UserListRow.view.php');
		}
		include(DOC_ROOT.'view'.DS.'UserListRowFooter.view.php');
		
		
		
		include(DOC_ROOT.'view/pageFooter.php');
	}
}