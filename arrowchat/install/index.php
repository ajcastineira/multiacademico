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

	session_start();
	ob_start();

	// Report all errors, except notices
	error_reporting(0);
	@ini_set(‘display_errors’, 0);
	
	define('AC_FOLDER_CACHE', 'cache');

	// Get the install step
	if (!empty($_GET['mode'])) 
		$page = $_GET['mode']; 
	else 
		$page = "requirements"; 
		
	// Check which page we are on
	if($page == "requirements")
		$checktest = 1;
	else if ($page == "database")
		$checktest = 2;
	else if ($page == "admin")
		$checktest = 3;
	else if ($page == "config")
		$checktest = 4;
	else if ($page == "final")
		$checktest = 5;
		
	// Set variables
	if (!isset($_POST['version']))
		$_POST['version'] = "";
	if (!isset($_SESSION['db_type']))
		$_SESSION['db_type'] = "";
	if (!isset($_SESSION['db_password']))
		$_SESSION['db_password'] = "";
	if (!isset($_SESSION['db_username']))
		$_SESSION['db_username'] = "";
	if (!isset($_SESSION['db_name']))
		$_SESSION['db_name'] = "";
	if (!isset($_SESSION['admin_username']))
		$_SESSION['admin_username'] = "";
	if (!isset($_SESSION['admin_password']))
		$_SESSION['admin_password'] = "";
	if (!isset($_SESSION['admin_password_confirm']))
		$_SESSION['admin_password_confirm'] = "";
	if (!isset($_SESSION['admin_email']))
		$_SESSION['admin_email'] = "";
	if (!isset($_SESSION['admin_email_confirm']))
		$_SESSION['admin_email_confirm'] = "";
	if (!isset($_POST['publish_key']))
		$_POST['publish_key'] = "";
	if (!isset($_POST['subscribe_key']))
		$_POST['subscribe_key'] = "";
	if (!isset($_POST['secret_key']))
		$_POST['secret_key'] = "";
	if (!isset($_SESSION['publish_key']))
		$_SESSION['publish_key'] = "";
	if (!isset($_SESSION['subscribe_key']))
		$_SESSION['subscribe_key'] = "";
	$existing_tables = false;

	// Require the page header
	require_once (dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "edition.php");
	require_once (dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "classes/class_database.php");
	require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "layout" . DIRECTORY_SEPARATOR . "pages_header.php");
	require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "functions_install.php");

	// Check PHP Version
	if (version_compare(PHP_VERSION, '4.3.3') < 0)
	{
		echo '<b>You are running an unsupported PHP version. Please upgrade to PHP 4.3.3 or higher before trying to install arrowchat.</b>';
		
		require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "layout" . DIRECTORY_SEPARATOR . "pages_footer.php");
		die();
	}

	// ######################### START REQUIREMENTS ##########################
	if ($page == "requirements") 
	{
		$pass_img = '<img src="./images/reserve_tab_checked.png" alt="" />';
		$fail_img = '<img src="./images/reserve_tab_unchecked.png" alt="" />';
		
		$configwrite = false;
		$cachewrite = false;
		$includewrite = false;
		$functionswrite = false;
		$dbcheck = false;
		
		if (is_file_writable(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "config.new.php")) 
		{
			$configwrite = true;
		} 
		
		if (is_file_writable(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "cache" . DIRECTORY_SEPARATOR)) 
		{
			$cachewrite = true;
		} 
		
		if (is_file_writable(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR)) 
		{
			$includewrite = true;
		}
		
		if (is_file_writable(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "functions" . DIRECTORY_SEPARATOR . "integrations" . DIRECTORY_SEPARATOR))
		{
			$functionswrite = true;
		}
		
		// Disabling the mySQL database check for now
		//if (checkDB()) 
		//{
			$dbcheck = true;
		//}	
		
		require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "layout" . DIRECTORY_SEPARATOR . "pages_requirements.php");
		
		if ($configwrite AND $cachewrite AND $includewrite AND $dbcheck AND $functionswrite)
		{
			$next = array('0' => 'Next', '1' => 'onClick="window.location.href=\'?mode=database\';"');
		}
		else
		{
			$next = array('0' => 'Test Again', '1' => 'onClick="window.location.reload();this.className=\'buttondown\'"');
		}
	}

	// ######################### START DATABASE SETUP ##########################
	if ($page == "database") 
	{
		require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "integrations_list.php");
		
		$success = false;
		
		if (!empty($_POST['form_submitted'])) 
		{
			$_SESSION['version']			= $_POST['version'];
			$_SESSION['db_host'] 			= $_POST['server'];
			$_SESSION['db_name']	 		= $_POST['dbname'];
			$_SESSION['db_username'] 		= $_POST['dbusername'];
			$_SESSION['db_password'] 		= $_POST['dbpassword'];
			if (empty($_POST['dbtype']))
				$_SESSION['db_type']		= "0";
			else
				$_SESSION['db_type']	 	= "1";
			
			if (empty($_POST['version']))
				$error = "Please select an installation type first.";
				
			foreach ($installs as $key)
			{
				if ($_POST['version'] == $key[1])
				{
					if (!file_exists(dirname(dirname(dirname(__FILE__))) . $key[4]))
					{
						$error = "ArrowChat could not find your {$key[0]} configuration file.  Check to make sure that the ArrowChat folder is located within your {$key[0]} folder.";
					}
				}
			}
			
			if (empty($error)) 
			{
				if ($_SESSION['db_type'] == 1)
				{
					if (function_exists('mssql_connect'))
					{
						$db = new QuickMSDB($_SESSION['db_host'], $_SESSION['db_username'], $_SESSION['db_password'], $_SESSION['db_name'], false, false);
					}
					else
					{
						$error = "You do not have the mssql PHP extension.  Please have your host install it.";
					}
				}
				else
				{
					$db = new QuickDB($_SESSION['db_host'], $_SESSION['db_username'], $_SESSION['db_password'], $_SESSION['db_name'], false, false);
				}
	
				if (empty($error))
				{
					if ($db->con) 
					{
						if ($db->dbselect)
						{
							if ($_SESSION['db_type'] == 1)
							{
								$result = $db->execute("
									SELECT * 
									FROM INFORMATION_SCHEMA.TABLES 
									WHERE TABLE_NAME LIKE 'arrowchat%'
								");
							}
							else
							{
								$result = $db->execute("
									SHOW TABLES 
									FROM " . $_SESSION['db_name'] . "
									LIKE 'arrowchat%'
								");
							}
							
							if ($result AND $db->count_select() > 0)
							{
								$existing_tables = true;
							}
							
							$success = true;
							
							echo '<div class="success"><div style="font-weight: bold;">Connection successful</div>Arrowchat connected to your database successfully.  Please continue to the next step.</div><br /><br />';
							
							if ($existing_tables) 
							{
								echo '<div class="warning"><div style="font-weight: bold;">Read before continuing</div>The following ArrowChat tables already exist on your server and will be dropped and replaced with fresh tables when you re-install ArrowChat. The "arrowchat" table will be automatically backed-up, but please back-up any additional information you may need.</div><div style="padding-left: 65px; line-height:1.8em;">';
								
								while($row = $db->fetch_array($result)) 
								{
									echo $row[0] . "<br />";
								}
								
								echo '</div><br />';
							}
							
							$next = array('0' => 'Next', '1' => 'onClick="window.location.href=\'?mode=admin\';"');
						}
						else
						{
							$error = "Arrowchat was unable to connect to the database with the provided information.  The database name was incorrect.";
						}
					}
					else 
					{
						$error = "Arrowchat was unable to connect to the database with the provided information.  Check your details and try again.";
					}
				}
			}
		}

		if (!empty($error))
		{
			echo '<div class="error"><div style="font-weight: bold;">Oops! There is an error:</div>'.$error.'</div><br />';
		}
		
		if (!$success) 
		{		
			$next = array('0' => 'Next', '1' => 'onClick="document.forms[\'database\'].submit();"');
			
			require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "layout" . DIRECTORY_SEPARATOR . "pages_database.php");
		}
	}

	// ######################### START ADMIN SETUP ##########################
	if ($page == "admin") 
	{	
		$success = false;
		
		if (!isset($_SESSION['db_name']))
			header("Location: ./");

		if (isset($_POST['admin_username'])) 
		{
			$_SESSION['admin_username']			= $_POST['admin_username'];
			$_SESSION['admin_password']			= $_POST['admin_password'];
			$_SESSION['admin_password_confirm'] = $_POST['admin_password_confirm'];
			$_SESSION['admin_email']			= $_POST['admin_email'];
			$_SESSION['admin_email_confirm']	= $_POST['admin_email_confirm'];
		
			if (empty($_POST['admin_username']))
				$error = "You must enter an admin username.";
			
			if (empty($_POST['admin_password']))
				$error = "You must enter an admin password.";
			
			if (empty($_POST['admin_password_confirm']))
				$error = "You must enter a confirmation password.";
			
			if (empty($_POST['admin_email']))
				$error = "You must enter an admin email.";
			
			if (empty($_POST['admin_email_confirm']))
				$error = "You must enter a confirmation email.";
			
			if (empty($_POST['admin_username']))
				$error = "You must enter an admin username.";
			
			if (strtolower($_POST['admin_email']) != strtolower($_POST['admin_email_confirm']))
				$error = "Your email and confirmation email do not match.";
			
			if ($_POST['admin_password'] != $_POST['admin_password_confirm'])
				$error = "Your password and confirmation password do not match.";
		
			if (empty($error)) 
			{
				$success = true;
				
				echo '<div class="success"><div style="font-weight: bold;">Admin details successful</div>Your administrator details were set.  Please click next.</div><br /><br />';
				
				$next = array('0' => 'Next', '1' => 'onClick="window.location.href=\'?mode=config\';"');
			}
			
			if (!empty($error))
				echo '<div class="error"><div style="font-weight: bold;">Oops! There is an error:</div>'.$error.'</div><br />';
		}
			
		if (!$success) 
		{
			$next = array('0' => 'Next', '1' => 'onClick="document.forms[\'admin_form\'].submit();"');
			
			require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "layout" . DIRECTORY_SEPARATOR . "pages_admin.php");
		}

	}

	// ######################### START CONFIG SETUP ##########################
	if ($page == "config") 
	{	
		$success = false;
		
		if (!isset($_SESSION['admin_username']))
			header("Location: ./");
			
		if ($_SESSION['db_type'] == 1)
			$db = new QuickMSDB($_SESSION['db_host'], $_SESSION['db_username'], $_SESSION['db_password'], $_SESSION['db_name'], false, false);
		else
			$db = new QuickDB($_SESSION['db_host'], $_SESSION['db_username'], $_SESSION['db_password'], $_SESSION['db_name'], false, false);
		
		if (isset($_POST['config_path'])) 
		{
			$new_base_url = $_POST['config_path'];
			
			// Add a slash to the end of the base URL is one doesn't exist
			if (substr($new_base_url, -1) != "/")
			{
				$new_base_url = $new_base_url . "/";
			}
		
			$_SESSION['config_path']				= $new_base_url;
			$_SESSION['db_prefix'] 					= $_POST['prefix'];
			$_SESSION['config_table_user']			= $_POST['config_table_user'];
			$_SESSION['config_field_username']		= $_POST['config_field_username'];
			$_SESSION['config_field_userid']		= $_POST['config_field_userid'];
			$_SESSION['config_field_avatar']		= $_POST['config_field_avatar'];
			$_SESSION['config_table_friends']		= $_POST['config_table_friends'];
			$_SESSION['config_field_friend_userid']	= $_POST['config_field_friend_userid'];
			$_SESSION['config_field_friendid']		= $_POST['config_field_friendid'];
			$_SESSION['config_field_friend_check']	= $_POST['config_field_friend_check'];
			$_SESSION['buddylist']					= $_POST['buddylist'];
			$_SESSION['who_chat']					= $_POST['who_chat'];
			$_SESSION['server_type']				= $_POST['server_type'];
			$_SESSION['publish_key']				= $_POST['publish_key'];
			$_SESSION['subscribe_key']				= $_POST['subscribe_key'];
			$_SESSION['secret_key']					= $_POST['secret_key'];
		
			if (empty($_POST['config_path']))
				$error = "You must enter the ArrowChat path.";
				
			if ($_POST['server_type'] == "push_server" AND (empty($_POST['publish_key']) OR empty($_POST['subscribe_key'])))
				$error = "You choose a push server but did not enter the push API keys.  Please fill in the fields.";
				
			if ($db->con) 
			{
				if ($_SESSION['db_type'] == 1)
				{
					$result = $db->execute("
						SELECT * 
						FROM [" . $_SESSION['db_prefix'] . $_SESSION['config_table_user'] . "]
					");
				}
				else
				{
					$result = $db->execute("
						SELECT * 
						FROM " . $_SESSION['db_prefix'] . $_SESSION['config_table_user'] . "
					");
				}
				
				if (!$result)
					$error = "Your table prefix is incorrect.  We tried to retrieve information from the table \"" . $_SESSION['db_prefix'] . $_SESSION['config_table_user'] . "\" and could not do so.  You might also receive this error if you're not using the same database that your exisiting integration is on.  Please check the prefix and consult the ArrowChat documentation if you continue to have problems.";
			} 
			else 
			{
				$error = "We were unable to connect to your database.  Please go back to the database settings page.  This might also be an indication that your session timed out or PHP sessions are not working entirely.";
			}
		
			if (empty($error)) 
			{
				$success = true;
				
				echo '<div class="success"><div style="font-weight: bold;">Configuration Successful:</div>Your configuration details were set.  Please click next.</div><div style="height:300px;"></div>';
				
				$next = array('0' => 'Next', '1' => 'onClick="window.location.href=\'?mode=final\';"');
			}
			
			if (!empty($error))
				echo '<div class="error"><div style="font-weight: bold;">Oops! There is an error:</div>'.$error.'</div><br />';
		}
		
		require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "integrations_db_list.php");
						
		if (isset($_SESSION['config_path'])) 
		{
			$config_path 				= $_SESSION['config_path'];
			$config_table_user 			= $_SESSION['config_table_user'];
			$config_field_username 		= $_SESSION['config_field_username'];
			$config_field_userid 		= $_SESSION['config_field_userid'];
			$config_field_avatar 		= $_SESSION['config_field_avatar'];
			$config_table_friends 		= $_SESSION['config_table_friends'];
			$config_field_friend_userid = $_SESSION['config_field_friend_userid'];
			$config_field_friendid 		= $_SESSION['config_field_friendid'];
			$config_field_friend_check  = $_SESSION['config_field_friend_check'];
		} 
		else 
		{
			$config_path 				= substr(GetFileDir($_SERVER['PHP_SELF']), 0, -8);
			$config_table_user 			= $installs[$_SESSION['version']][0];
			$config_field_username 		= $installs[$_SESSION['version']][1];
			$config_field_userid 		= $installs[$_SESSION['version']][2];
			$config_field_avatar 		= $installs[$_SESSION['version']][3];
			$config_table_friends 		= $installs[$_SESSION['version']][4];
			$config_field_friend_userid = $installs[$_SESSION['version']][5];
			$config_field_friendid 		= $installs[$_SESSION['version']][6];
			$config_field_friend_check  = $installs[$_SESSION['version']][7];
		}

		if (!$success) 
		{
			$next = array('0' => 'Next', '1' => 'onClick="document.forms[\'config_form\'].submit();"');
			
			require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "layout" . DIRECTORY_SEPARATOR . "pages_config.php");
		}
	}

	// ######################### START FINAL SETUP ##########################
	if ($page == "final") 
	{
		$success = false;
		
		if (!isset($_SESSION['who_chat']))
			header("Location: ./");

		require_once (dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "admin/includes/functions/functions_update.php");
		
		if ($_SESSION['buddylist'] == "friends_only")
		{
			$disable_buddy_list = "0";
			$no_friend_system = "0";
			$buddylist_text = "Friends Only";
		}
		else if ($_SESSION['buddylist'] == "all_online")
		{
			$disable_buddy_list = "1";
			$no_friend_system = "0";
			$buddylist_text = "All Online";
		}
		else if ($_SESSION['buddylist'] == "no_friend_system")
		{
			$disable_buddy_list = "1";
			$no_friend_system = "1";
			$buddylist_text = "No Friend System";
		}
	
		if ($_SESSION['who_chat'] == "guests_chat")
		{
			$guests_can_view = "1";
			$guests_can_chat = "1";
			$who_chat_text = "Guests and Users";
		}
		else if ($_SESSION['who_chat'] == "display_message")
		{
			$guests_can_view = "1";
			$guests_can_chat = "0";
			$who_chat_text = "Display Message to Guests";
		}
		else if ($_SESSION['who_chat'] == "logged_in")
		{
			$guests_can_view = "0";
			$guests_can_chat = "0";
			$who_chat_text = "Logged in Users Only";
		}
		
		if ($_SESSION['server_type'] == "push_server")
		{
			$push_on = "1";
			$server_type_text = "Push Server";
		}
		else if ($_SESSION['server_type'] == "smart_polling")
		{
			$push_on = "0";
			$server_type_text = "My Server";
		}

		if (!empty($_POST['write_files'])) 
		{	
			$_SESSION['in_arrowchat'] = 1;
			
			if ($_SESSION['db_type'] == 1)
			{
				$db = new QuickMSDB($_SESSION['db_host'], $_SESSION['db_username'], $_SESSION['db_password'], $_SESSION['db_name'], false, false);
				$dbms_schema = 'schemas/mssql_schema.sql';
			}
			else
			{
				$db = new QuickDB($_SESSION['db_host'], $_SESSION['db_username'], $_SESSION['db_password'], $_SESSION['db_name'], false, false);
				$dbms_schema = 'schemas/mysql_schema.sql';
			}

			$remove_remarks = "remove_remarks";
			$delimiter = ";";

			$sql_query = @file_get_contents($dbms_schema);

			$remove_remarks($sql_query);

			$sql_query = split_sql_file($sql_query, $delimiter);

			foreach ($sql_query as $sql)
			{
				$db->execute($sql);
			}
			
			if ($_SESSION['db_type'] == 1)
				require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "db_initial_values_mssql.php");
			else
				require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "db_initial_values.php");
			
			foreach ($sql_ary as $sql)
			{
				$db->execute($sql);
			}
			
			write_config_file();
			$rename = write_functions_file();
			update_config_file();
			
			$success = true;
		}

		if (!$success) 
		{
			$next = array('0' => 'Install', '1' => 'onClick="document.forms[\'final_form\'].submit();"');
			
			require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "layout" . DIRECTORY_SEPARATOR . "pages_final_confirm.php");
		}
		
		if ($success) 
		{
			require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . "includes/functions_php.php");
			
			$header = htmlspecialchars('<link type="text/css" rel="stylesheet" id="arrowchat_css" media="all" href="'.$_SESSION['config_path'].'external.php?type=css" charset="utf-8" />
<script type="text/javascript" src="'.$_SESSION['config_path'].'includes/js/jquery.js"></script>
<script type="text/javascript" src="'.$_SESSION['config_path'].'includes/js/jquery-ui.js"></script>');
	
			$footer = htmlspecialchars('<script type="text/javascript" src="'.$_SESSION['config_path'].'external.php?type=djs" charset="utf-8"></script>
<script type="text/javascript" src="'.$_SESSION['config_path'].'external.php?type=js" charset="utf-8"></script>');
			
			$next = array('0' => 'Go to Admin Panel', '1' => 'onClick="window.location.href=\'../admin/\';"');
			
			require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "layout" . DIRECTORY_SEPARATOR . "pages_final.php");
		}
	}

	require_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "layout" . DIRECTORY_SEPARATOR . "pages_footer.php");
	
	session_write_close();
	
?>