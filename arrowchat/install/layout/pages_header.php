<?php

	/*
	|| #################################################################### ||
	|| #                             ArrowChat                            # ||
	|| # ---------------------------------------------------------------- # ||
	|| #    Copyright ©2010-2012 ArrowSuites LLC. All Rights Reserved.    # ||
	|| # This file may not be redistributed in whole or significant part. # ||
	|| # ---------------- ARROWCHAT IS NOT FREE SOFTWARE ---------------- # ||
	|| #   http://www.arrowchat.com | http://www.arrowchat.com/license/   # ||
	|| #################################################################### ||
	*/

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb"> 
<head> 
 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<meta http-equiv="Content-Style-Type" content="text/css" /> 
<meta http-equiv="Content-Language" content="en-gb" /> 
<meta http-equiv="imagetoolbar" content="no" /> 
 
<title>Arrowchat - Installation and Setup</title> 

<link rel="stylesheet" type="text/css" href="includes/css/style.css"> 
<link rel="shortcut icon" href="images/favicon.ico" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script> 
<script type="text/javascript" src="includes/js/vtip-min.js"></script> 

</head>
<body>
<div style="min-height:100%;">
	<div id="header">
		<div class="frame">
			<div class="holder">
				<div class="left">
					<h1 class="logo">ArrowChat</h1>
				</div>
				<ul id="nav">
					<li><a href="#">ArrowChat Chat Software</a></li>
				</ul>
			</div>
		</div>
	</div><!-- header end -->
	<div id="content">	
		<div id="install-setup">
			<img src="./images/install-and-setup.png" alt="" />
		</div>
		<div class="tabs">
			<ul>
				<li>
					<a class="first checked<?php if($page == "requirements") echo ' active'; ?>" href="./">
						<span <?php if($checktest > 1) echo 'class="no-border"'; ?>><?php if($checktest > 1) echo '<img src="./images/reserve_tab_checked.png" alt="" />&nbsp;&nbsp;'; ?>Requirements</span>
					</a>
				</li>
				<li>
					<a class="<?php if($page == "database") echo 'active no-border checked'; if($checktest > 2) echo 'checked'; ?>" href="<?php if($checktest > 2) echo './?mode=database'; ?>">
						<span <?php if($checktest > 1) echo 'class="no-border"'; ?>><?php if($checktest > 2) echo '<img src="./images/reserve_tab_checked.png" alt="" />&nbsp;&nbsp;'; ?>Database</span>
					</a>
				</li>
				<li>
					<a class="<?php if($page == "admin") echo 'active no-border checked'; if($checktest > 3) echo 'checked'; ?>" href="<?php if($checktest > 3) echo './?mode=admin'; ?>">
						<span <?php if($checktest > 2) echo 'class="no-border"'; ?>><?php if($checktest > 3) echo '<img src="./images/reserve_tab_checked.png" alt="" />&nbsp;&nbsp;'; ?>Administrator</span>
					</a>
				</li>
				<li>
					<a class="<?php if($page == "config") echo 'active no-border checked'; if($checktest > 4) echo 'checked'; ?>" href="<?php if($checktest > 4) echo './?mode=config'; ?>">
						<span <?php if($checktest > 3) echo 'class="no-border"'; ?>><?php if($checktest > 4) echo '<img src="./images/reserve_tab_checked.png" alt="" />&nbsp;&nbsp;'; ?>Configuration</span>
					</a>
				</li>
				<li>
					<a <?php if($page == "final") echo 'class="active last checked"'; ?> href="#">
						<span class="no-border"><?php if($checktest > 5) echo '<img src="./images/reserve_tab_checked.png" alt="" />&nbsp;&nbsp;'; ?>Confirm</span>
					</a>
				</li>
			</ul>
		</div>
		<div id="subcontent">
			<h2>
			<?php 
				if($page == "requirements") echo 'Check that you meet the requirements.'; 
				else if ($page == "database") echo 'Fill out your database information.';
				else if ($page == "admin") echo 'Setup your administration details.';
				else if ($page == "config") echo 'Choose your configuration details.';
				else if ($page == "final" && empty($_POST['write_files'])) echo 'Confirm your information is correct.';
				else if ($page == "final" && !empty($_POST['write_files'])) echo 'Complete these final steps.';
			?>
			</h2>
			<div id="grid-wrapper">
				<div id="<?php if ($page == "database" || $page == "config" || $page == "final") echo 'one'; else echo 'first'; ?>-column">