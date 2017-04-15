<?php

class Route
{
	private $uri = array();
	private $controller = array();
	
	public function addRoute($new_uri, $new_controller)
	{
		$this->uri[] = '/'.trim($new_uri,'/');
		$this->controller[] = $new_controller;
	}
	public function processUri()
	{
		$uriGetParam = isset($_GET['uri']) ? '/'.$_GET['uri'] : '/';
		$foundUriMatch = false;		// Track if there is a matching uri in the array
		foreach($this->uri as $key => $value)
		{
			if (preg_match("#^$value$#", $uriGetParam))
			{
				$useMethod = $this->controller[$key];
				$foundUriMatch = true;
			}
		}
		if(!$foundUriMatch)
		{
			$useMethod = 'Home';
		}
		
		new $useMethod($uriGetParam);	// Instantiate the controller that matches the command
	}
}