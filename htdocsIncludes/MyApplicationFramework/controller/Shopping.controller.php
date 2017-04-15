<?php

class Shopping
{
	private $uriGetParam;
	
	function __construct($uriGetParam = null)
	{
		$this->uriGetParam = $uriGetParam;
		
		if ( $this->uriGetParam == '/shopping') {
			
			
			
			
			
		} else {
			echo 'Shopping Controller: Default...';
		}
	}
}