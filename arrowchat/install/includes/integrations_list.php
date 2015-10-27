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

	// The list of integrations to be displayed for installation
	// Keys:
	// 		0 - Display name for the integration
	// 		1 - Identifier for the integration used in the back-end
	// 		2 - The default database server host
	// 		3 - The default database port
	// 		4 - The location of a configuration file to check the ArrowChat folder is located within the integration

	$installs = array(
				"standalone" => array(0 => "Standalone", 1 => "standalone", 2 => "localhost", 3 => "3306", 4 => "/"),
				"buddypress" => array(0 => "BuddyPress", 1 => "buddypress", 2 => "localhost", 3 => "3306", 4 => "/wp-load.php"),
				"cbuilder" => array(0 => "Community Builder", 1 => "cbuilder", 2 => "localhost", 3 => "3306", 4 => "/configuration.php"),
				"dolphin" => array(0 => "Boonex Dolphin", 1 => "dolphin", 2 => "localhost", 3 => "3306", 4 => "/inc/header.inc.php"),
				"drupal" => array(0 => "Drupal", 1 => "drupal", 2 => "localhost", 3 => "3306", 4 => "/includes/bootstrap.inc"),
				"dzoic" => array(0 => "DZOIC", 1 => "dzoic", 2 => "localhost", 3 => "3306", 4 => "/includes/config/config.inc.php"),
				"elgg" => array(0 => "Elgg", 1 => "elgg", 2 => "localhost", 3 => "3306", 4 => "/engine/settings.php"),
				"ipboard" => array(0 => "IP.Board", 1 => "ipboard", 2 => "localhost", 3 => "3306", 4 => "/conf_global.php"),
				"jamroom" => array(0 => "Jamroom", 1 => "jamroom", 2 => "localhost", 3 => "3306", 4 => "/config/settings.cfg.php"),
				"jcow" => array(0 => "JCow", 1 => "jcow", 2 => "localhost", 3 => "3306", 4 => "/my/config.php"),
				"jomsocial" => array(0 => "JomSocial", 1 => "jomsocial", 2 => "localhost", 3 => "3306", 4 => "/configuration.php"),
				"joomla" => array(0 => "Joomla", 1 => "joomla", 2 => "localhost", 3 => "3306", 4 => "/configuration.php"),
				"mybb" => array(0 => "MyBB", 1 => "mybb", 2 => "localhost", 3 => "3306", 4 => "/inc/config.php"),
				"osdate" => array(0 => "osDate", 1 => "osdate", 2 => "localhost", 3 => "3306", 4 => "/temp/myconfigs/config.php"),
				"oxwall" => array(0 => "Oxwall", 1 => "oxwall", 2 => "localhost", 3 => "3306", 4 => "/ow_includes/config.php"),
				"phpbb" => array(0 => "phpBB", 1 => "phpbb", 2 => "localhost", 3 => "3306", 4 => "/config.php"),
				"phpfox" => array(0 => "phpFox", 1 => "phpfox", 2 => "localhost", 3 => "3306", 4 => "/include/init.inc.php"),
				"phpnuke" => array(0 => "PHP-Nuke", 1 => "phpnuke", 2 => "localhost", 3 => "3306", 4 => "/config.php"),
				"skadate" => array(0 => "SkaDate", 1 => "skadate", 2 => "localhost", 3 => "3306", 4 => "/internals/\$config.php"),
				"smf" => array(0 => "Simple Machines Forum", 1 => "smf", 2 => "localhost", 3 => "3306", 4 => "/Settings.php"),
				"smf2" => array(0 => "Simple Machines Forum 2", 1 => "smf2", 2 => "localhost", 3 => "3306", 4 => "/Settings.php"),
				"socialengine" => array(0 => "Social Engine 3", 1 => "socialengine", 2 => "localhost", 3 => "3306", 4 => "/include/database_config.php"),
				"socialengine4" => array(0 => "Social Engine 4", 1 => "socialengine4", 2 => "localhost", 3 => "3306", 4 => "/application/settings/database.php"),
				"vbulletin" => array(0 => "vBulletin", 1 => "vbulletin", 2 => "localhost", 3 => "3306", 4 => "/includes/config.php"),
				"vldpersonals" => array(0 => "vldPersonals", 1 => "vldpersonals", 2 => "localhost", 3 => "3306", 4 => "/includes/cp.php"),
				"wordpress" => array(0 => "WordPress", 1 => "wordpress", 2 => "localhost", 3 => "3306", 4 => "/wp-load.php"),
				"xenforo" => array(0 => "XenForo", 1 => "xenforo", 2 => "localhost", 3 => "3306", 4 => "/library/config.php"),
				"xoops" => array(0 => "XOOPS", 1 => "xoops", 2 => "localhost", 3 => "3306", 4 => "/mainfile.php")
			);
			
?>