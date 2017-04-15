<?php
	/* **************************************************************************************************	*/
	/*	Description:																						*/
	/*	This is a header for the page that only contains basic HTML information along with using a defined	*/
	/* 	value for the web links.																			*/
	/*																										*/
	/*																										*/
	/*																										*/
	/*																										*/
	/*																										*/
	/* **************************************************************************************************	*/
	
	if( isset($_SESSION['userRoles']) ) {
		$userRoles = $_SESSION['userRoles'];
	} else {		
		$userRoles = array("guest");
	}
	
	
?>
<html>
	<head>
		<title>My First Web Application Framework</title>
		<link rel="shortcut icon" href="<?php echo WEB_ROOT ?>images/favicon.png" />
		
		<!-- *****************************************************************	-->
		<!-- Styles																-->
		<link href="<?php echo WEB_ROOT ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo WEB_ROOT ?>css/bootstrapmodifications.css" rel="stylesheet" type="text/css">
		<link href="<?php echo WEB_ROOT ?>css/site.css" rel="stylesheet" type="text/css">
		
		<!-- *****************************************************************	-->
		<!-- Scripts															-->
		<script src="<?php echo WEB_ROOT ?>javascript/jquery-3.1.1.min.js" type="text/javascript"></script>
		<script src="<?php echo WEB_ROOT ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		
		
	</head>
	<body>
		<nav class="navbar navbar-default">
		   <div class="container-fluid">
			 <div class="navbar-header">
			   <a class="navbar-brand" href="#">WebSiteName</a>
			 </div>
			 <ul class="nav navbar-nav">
			   <li class="active"><a href="#">Home</a></li>
			   
				<li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle">Users <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="/MyApplicationFramework/userList">List</a></li>
						<li><a href="/MyApplicationFramework/userAddUpdate">Add</a></li>
					</ul>
				</li>
				
				
				<li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle">Example <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Something</a></li>
						<li><a href="#">Something Else</a></li>
						<li><a href="#">Whatever</a></li>
						<li class="divider"></li>
						<li><a href="#">Trash</a></li>
					</ul>
				</li>

				<li><a href="#">Page 1</a></li>
				<li><a href="#">Page 2</a></li>
				<li><a href="#">Page 3</a></li>
			 </ul>
			 <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<?php
						if (in_array("user", $userRoles)) {
							$currentUser = unserialize($_SESSION['currentUser']);
					?>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >
							<span class="glyphicon glyphicon-log-in"></span>
							Hello <?php echo $currentUser->getDisplayName() ?>!
						</a>
						<ul class="dropdown-menu">
							<a href="/MyApplicationFramework/logout">LogOut</a>
						</ul>
					<?php
						} else {
					?>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" >
							<span class="glyphicon glyphicon-log-in"></span>
							Login
						</a>
						<ul class="dropdown-menu">
							<form action="/MyApplicationFramework/login" method="post" >
								<input type="text" name="loginName" placeholder="Your name goes here" /><br />
								<input type="password" name="loginPassword" /><br />
								<button type="submit">Login</button>
							</form>
						</ul>
					<?php
						}
					?>
				</li>
			 </ul>
		   </div>
		</nav>
		<div id='pageWrapper'>
		
		
		
		