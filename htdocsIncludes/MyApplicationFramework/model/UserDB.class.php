<?php

class UserDB
{
	private $users;
	private $validatedUser;
	
	function __construct()
	{		
		/*
		$minionBob = new User();
		$minionBob->setFirstName('Bob');
		$minionBob->setLastName('Minion');
		$minionBob->setEmail('bob@minion.com');
		$minionBob->setPassword('gruIsCool!');
		$minionBob->setDisplayName('My Name...');
		
		$minionJerry = new User();
		$minionJerry->setFirstName('Jerry');
		$minionJerry->setLastName('Minion');
		$minionJerry->setEmail('jerry@minion.com');
		$minionJerry->setPassword('!Pass1234');
		$minionJerry->setDisplayName('Jerry Rule Follower');			
		
		$minionStuart = new User();
		$minionStuart->setFirstName('Stuart');
		$minionStuart->setLastName('Minion');
		$minionStuart->setEmail('stuart@minion.com');
		$minionStuart->setPassword('bobIsBoring');
		$minionStuart->setDisplayName('Not Bob');
		
		$userBram = new User();
		$userBram->setFirstName('Bram');
		$userBram->setLastName('Lewis');
		$userBram->setEmail('bram@lewis.com');
		$userBram->setPassword('password');
		$userBram->setDisplayName('Bram');
		
		$this->users = array($minionBob, $minionJerry, $minionStuart, $userBram);
		*/
		
		
	}	
	
	public function validateCredentials($loginName, $loginPassword)
	{
		/*
		foreach ($this->users as $singleUser) {
			if ($singleUser->validateCredentials($loginName, $loginPassword)) {
				$this->validatedUser = $singleUser;
				return true;
			}
		}
		*/
		
		return false;
	}
	public function getCurrentUser()
	{
		return $this->validatedUser;
	}
}
