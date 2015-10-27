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
	
	/**
	 * Check if a file has write permissions
	 *
	 * @param	string	$file	The path to the file to be checked
	 * @return	bool	True if it can be written; false if it cannot
	*/
	function is_file_writable($file)
	{
		if (strtolower(substr(PHP_OS, 0, 3)) === 'win' OR !function_exists('is_writable'))
		{
			if (file_exists($file))
			{
				// Canonicalise path to absolute path
				if (is_dir($file))
				{
					// Test directory by creating a file inside the directory
					$result = @tempnam($file, 'i_w');

					if (is_string($result) AND file_exists($result))
					{
						unlink($result);

						// Ensure the file is actually in the directory (returned realpathed)
						return (strpos($result, $file) === 0) ? true : false;
					}
				}
				else
				{
					$handle = @fopen($file, 'r+');

					if (is_resource($handle))
					{
						fclose($handle);
						return true;
					}
				}
			}
			else
			{
				// file does not exist test if we can write to the directory
				$dir = dirname($file);

				if (file_exists($dir) AND is_dir($dir) AND is_file_writable($dir))
				{
					return true;
				}
			}

			return false;
		}
		else
		{
			return is_writable($file);
		}
	}

	/**
	 * Checks whether the folder is writable
	 *
	 * @param	string	$path	The path to the folder to check
	 * @return	bool	Return true if folder is writable; false if not
	*/
	function is__writable($path) 
	{
		if ($path{strlen($path) - 1} == '/')
		{
			return is__writable($path . uniqid(mt_rand()) . '.tmp');
		}
		else if (is_dir($path))
		{
			return is__writable($path . '/' . uniqid(mt_rand()) . '.tmp');
		}
		
		$rm = file_exists($path);
		$f = @fopen($path, 'a');
		
		if ($f === false)
		{
			return false;
		}
		
		fclose($f);
		
		if (!$rm)
		{
			unlink($path);
		}
		
		return true;
	}
	
	/**
	 * Checks whether the server can run the DLL for the database
	 *
	 * @param	string	$dll	The DLL name to check
	 * @return	bool	Return true if it can; false if not
	*/
	function can_load_dll($dll)
	{
		if ($dll == 'sqlite' AND version_compare(PHP_VERSION, '5.0.0', '>=') AND !extension_loaded('pdo'))
		{
			return false;
		}
		
		return ((@ini_get('enable_dl') OR strtolower(@ini_get('enable_dl')) == 'on') AND (!@ini_get('safe_mode') OR strtolower(@ini_get('safe_mode')) == 'off') AND function_exists('dl') AND @dl($dll . '.' . PHP_SHLIB_SUFFIX)) ? true : false;
	}
	
	/**
	 * Checks which databases the server can run
	 *
	 * @return	bool	Return true if it can run MySQL; false if not
	*/
	function checkDB() 
	{
		$available_dbms = array(
			'mysql'		=> array(
				'LABEL'			=> 'MySQL',
				'SCHEMA'		=> 'mysql',
				'MODULE'		=> 'mysql',
				'DELIM'			=> ';',
				'COMMENTS'		=> 'remove_remarks',
				'DRIVER'		=> 'mysql',
				'AVAILABLE'		=> true,
				'2.0.x'			=> true,
			)
		);
		
		foreach ($available_dbms as $db_name => $db_ary)
		{
			if ($only_20x_options AND !$db_ary['2.0.x'])
			{
				if ($return_unavailable)
				{
					$available_dbms[$db_name]['AVAILABLE'] = false;
				}
				else
				{
					unset($available_dbms[$db_name]);
				}
				continue;
			}

			$dll = $db_ary['MODULE'];

			if (!@extension_loaded($dll))
			{
				if (!can_load_dll($dll))
				{
					if ($return_unavailable)
					{
						$available_dbms[$db_name]['AVAILABLE'] = false;
					}
					else
					{
						unset($available_dbms[$db_name]);
					}
					continue;
				}
			}
			$any_db_support = true;
		}
		
		if ($any_db_support)
		{
			$check = true;
		}
		else
		{
			$check = false;
		}
			
		return $check;
	}
	
	/**
	 * Splits the SQL file into queries
	 *
	 * @param	string	$sql	The full SQL to split
	 * @param	string	$sql	The delimiter to split at
	 * @return	array	An array of the split SQL
	*/
	function split_sql_file($sql, $delimiter)
	{
		$sql = str_replace("\r" , '', $sql);
		$data = preg_split('/' . preg_quote($delimiter, '/') . '$/m', $sql);
		$data = array_map('trim', $data);
		$end_data = end($data);

		if (empty($end_data))
		{
			unset($data[key($data)]);
		}

		return $data;
	}
	
	/**
	 * Removes comments/remakes from an SQL file
	 *
	 * @param	string	$sql	The SQL string to remove remarks from
	*/	
	function remove_remarks(&$sql)
	{
		$sql = preg_replace('/\n{2,}/', "\n", preg_replace('/^#.*$/m', "\n", $sql));
	}
	
	/**
	 * Updates the settings for ArrowChat by writing a new cache file
	 *
	*/
	function write_config_file()
	{
		global $no_friend_system;
		
		$include_data = "";
			
		if ($_SESSION['version'] == "vbulletin")
			$include_data = "
	require_once dirname(dirname(dirname(__FILE__))).\"/includes/config.php\";";

		if ($_SESSION['version'] == "xoops")
			$include_data = "
	require_once dirname(dirname(dirname(__FILE__))).\"/mainfile.php\";";
			
		if ($_SESSION['version'] == "smf")
			$include_data = "
	require_once dirname(dirname(dirname(__FILE__))).\"/Settings.php\";";
	
		if ($_SESSION['version'] == "smf2")
			$include_data = "
	require_once dirname(dirname(dirname(__FILE__))).\"/Settings.php\";";
			
		if ($_SESSION['version'] == "socialengine")
			$include_data = "
	require_once dirname(dirname(dirname(__FILE__))).\"/include/database_config.php\";";
			
		if ($_SESSION['version'] == "dzoic")
			$include_data = "
	require_once dirname(dirname(dirname(__FILE__))).\"/includes/config/config.inc.php\";";
			
		if ($_SESSION['version'] == "ipboard")
			$include_data = "
	require_once dirname(dirname(dirname(__FILE__))).\"/conf_global.php\";";
			
		if ($_SESSION['version'] == "jcow")
			$include_data = "
	\$_REQUEST['p'] = \"feed\";
	chdir(dirname(dirname(dirname(__FILE__))));
	require_once dirname(dirname(dirname(__FILE__))).\"/includes/boot.inc.php\";
	chdir(dirname(__FILE__));";

		if ($_SESSION['version'] == "osdate")
			$include_data = "
	session_start();";
			
		if ($_SESSION['version'] == "jomsocial")
			$include_data = "
	define('_JEXEC',1);
	define('DS',DIRECTORY_SEPARATOR);
	define('JPATH_BASE',dirname(dirname(dirname(__FILE__))));
	require_once dirname(dirname(dirname(__FILE__))).'/includes/defines.php';
	require_once dirname(dirname(dirname(__FILE__))).'/includes/framework.php';
	\$mainframe =& JFactory::getApplication('site');
	\$mainframe->initialise();";

		if ($_SESSION['version'] == "joomla")
			$include_data = "
	define('_JEXEC',1);
	define('DS',DIRECTORY_SEPARATOR);
	define('JPATH_BASE',dirname(dirname(dirname(__FILE__))));
	require_once dirname(dirname(dirname(__FILE__))).'/includes/defines.php';
	require_once dirname(dirname(dirname(__FILE__))).'/includes/framework.php';
	\$mainframe =& JFactory::getApplication('site');
	\$mainframe->initialise();";

		if ($_SESSION['version'] == "oxwall")
			$include_data = "
	define('_OW_', true);
	define('DS', DIRECTORY_SEPARATOR);
	define('OW_DIR_ROOT', dirname(dirname(dirname(__FILE__))) . DS);
	require_once(OW_DIR_ROOT . 'ow_includes' . DS . 'init.php');
	OW::getSession()->start();";

		if ($_SESSION['version'] == "cbuilder")
			$include_data = "
	define('_JEXEC',1);
	define('DS',DIRECTORY_SEPARATOR);
	define('JPATH_BASE',dirname(dirname(dirname(__FILE__))));
	require_once dirname(dirname(dirname(__FILE__))).'/includes/defines.php';
	require_once dirname(dirname(dirname(__FILE__))).'/includes/framework.php';
	\$mainframe =& JFactory::getApplication('site');
	\$mainframe->initialise();";

		if ($_SESSION['version'] == "standalone")
			$include_data = "";
			
		$stringData = "<?php 

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

	// Require any necessary external files for retrieving the user's session
";
		
		$stringData .= $include_data;
		
		$stringData .= "
		
	/**
	 * The database information
	 *
	 * Your existing users and information should already be in this database.  Do NOT create
	 * a new database for ArrowChat.
	*/";
		$stringData .= "
	define('DB_SERVER','" . $_SESSION['db_host'] . "'); 
	define('DB_USERNAME','" . $_SESSION['db_username'] . "'); 
	define('DB_PASSWORD','" . $_SESSION['db_password'] . "'); 
	define('DB_NAME','" . $_SESSION['db_name'] . "');";
	
		$stringData .= "	
		
	/**
	 * The table prefix can be left blank. A quick example of what you should input here:
	 *
	 * Example - Pretend the following list are tables:
	 * phpbb_friends
	 * phpbb_threads
	 * phpbb_users
	 *
	 * In the example above, the prefix would be phpbb_ because everything starts with it.
	 *
	 * Example - Pretend the following list are tables:
	 * friends
	 * threads
	 * users
	 *
	 * In the example above, the prefix would be blank.
	*/";
	
		$stringData .= "
	define('TABLE_PREFIX','" . $_SESSION['db_prefix'] . "');";
	
		$stringData .= "
	
	/**
	 * These variables will help automatically connect your existing website with ArrowChat.  Please
	 * review the descriptions below to better understand them. DO NOT INCLUDE THE PREFIX WITH THESE
	 * VALUES!
	 *
	 * DB_USERTABLE		   		= The name of the user's table
	 * DB_USERTABLE_USERID 		= The field for the user ID in the user's table
	 * DB_USERTABLE_NAME   		= The field for the username in the user's table
	 * DB_USERTABLE_AVATAR 		= The field for the avatar (input the user ID field if none exists)
	 *
	 * DB_FRIENDSTABLE	   		= (Optional) The name of the friend's table
	 * DB_FRIENDSTABLE_USERID	= (Optional) The field for the user ID in the friend's table
	 * DB_FRIENDSTABLE_FRIENDID	= (Optional) The field for the relationship/friend ID in the firned's table
	 * DB_FRIENDSTABLE_FRIENDS	= (Optional) The field to check if the users are friends
	 *
	 * All the friends stuff is optional.  If your site does not have a friend's system, leave the
	 * values blank and change the no friend system value.
	 */";
	 
		$stringData .= "
	define('DB_USERTABLE','" . $_SESSION['config_table_user'] . "'); 
	define('DB_USERTABLE_NAME','" . $_SESSION['config_field_username'] . "'); 
	define('DB_USERTABLE_USERID','" . $_SESSION['config_field_userid'] . "'); 
	define('DB_USERTABLE_AVATAR','" . $_SESSION['config_field_avatar'] . "'); 
	
	define('DB_FRIENDSTABLE','" . $_SESSION['config_table_friends'] . "'); 
	define('DB_FRIENDSTABLE_USERID', '" . $_SESSION['config_field_friend_userid'] . "'); 
	define('DB_FRIENDSTABLE_FRIENDID', '" . $_SESSION['config_field_friendid'] . "'); 
	define('DB_FRIENDSTABLE_FRIENDS', '" . $_SESSION['config_field_friend_check'] . "');";
	
		$stringData .= "
	
	/**
	 * Friend System
	 *
	 * If your website does not have a friend system (ex: you want to display all online users) then
	 * change the value below from 0 to 1.
	*/";
	
		$stringData .= "
	define('NO_FREIND_SYSTEM', '" . $no_friend_system . "');";
	
		$stringData .= "
	
	/**
	 * MSSQL Database
	 *
	 * If your database is MSSQL then change the value below from 0 to 1.
	*/";
	
		$stringData .= "
	define('MSSQL_DATABASE', '" . $_SESSION['db_type'] . "');";
	
		$stringData .= "
		
	// DO NOT EDIT BELOW THIS POINT
	// Initiate a connection to the database
	if (MSSQL_DATABASE == 1)
		\$db = new QuickMSDB(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, false, false);
	else
		\$db = new QuickDB(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME, false, false);

?>";
		// Rename old Config File
		if (file_exists(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "config.php"))
		{
			rename(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "config.php", dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "config.old." . time() . ".php");
		}
		
		// Write new Config File
		$myFile = dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "config.new.php";
		$fh = fopen($myFile, 'w') or die("Can't open includes/config.new.php file.  Please make this file writable.");
		fwrite($fh, $stringData);
		fclose($fh);
		
		// Rename new Config File to config.php
		rename(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "config.new.php", dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "config.php");
	}

	/**
	 * Renames the integration file to be used
	 *
	 * @return	bool	Return true if the file was renamed; false if not
	*/
	function write_functions_file()
	{
		$rename = false;

		if (file_exists(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "includes/functions/integrations/functions_".$_SESSION['version'].".php"))
		{
			$rename = rename(dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "includes/functions/integrations/functions_".$_SESSION['version'].".php", dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . "includes/integration.php");
		}
		else
		{
			$rename = true;
		}
		
		return $rename;
	}
	
	/**
	 * Returns the instructions on how to add the header/footer code for each integration
	 *
	 * @param	string	$version	The version to get instructions for
	 * @return	string	The instructions in text form
	*/
	function getFinalInstructions($version) 
	{
		switch($version)
		{
			case "phpbb":
				return "In phpBB, you can edit the header and footer files by going to the phpBB Admin Panel > Styles > Templates > Click Edit Next to your Active Style > Choose overall_footer.html and overall_header.html from the dropdown menu.";
				break;
				
			case "vbulletin":
				return "In vBulletin, you can edit the header and footer files by going to the vBulletin Admin Panel > Styles & Templates > Style Manager.  Now select the style you want ArrowChat to appear on and hit Go.  In the headinclue box, paste the ArrowChat header code at the top.  In the footer box, place the ArrowChat footer code at the bottom.  Hit Save at the bottom.";
				break;
			
			case "jomsocial":
				return "In JomSocial, you can edit the header and footer files by going to the Joomla Admin Panel > Extensions > Template Manager.  Next, select the active template (usually indicated by a star).  Click on the Edit HTML button (top-right corner).";
				break;
				
			case "joomla":
				return "In Joomla, you can edit the header and footer files by going to the Joomla Admin Panel > Extensions > Template Manager.  Next, select the active template (usually indicated by a star).  Click on the Edit HTML button (top-right corner).";
				break;
				
			case "cbuilder":
				return "In Community Builder, you can edit the header and footer files by going to the Joomla Admin Panel > Extensions > Template Manager.  Next, select the active template (usually indicated by a star).  Click on the Edit HTML button (top-right corner).";
				break;
				
			case "wordpress":
				return "In WordPress, you can edit the header and footer files by going to the WordPress Admin Panel > Appearance > Editor > Edit the Header and Footer files (usually header.php and footer.php) of your active theme.";
				break;
				
			case "buddypress":
				return "In BuddyPress, you can edit the header and footer files by going to the WordPress Admin Panel > Appearance > Editor > Edit the Header and Footer files (usually header.php and footer.php) of your active theme.";
				break;
				
			case "dzoic":
				return "In DZOIC, you can change the header and footer by editing the /themes/handshakes_plain/templates/source/header.tpl and footer.tpl files (where handshakes_plain is the theme name).";
				break;
				
			case "smf":
				return "In Simple Machines Forum, you can change the header and footer by editing the index.php file in your SMF root folder.";
				break;
				
			case "smf2":
				return "In Simple Machines Forum, you can change the header and footer by editing the following file: /themes/default/index.template.php (where default is the name of your current theme).";
				break;
				
			case "elgg":
				return "In Elgg, you can edit the header and footer files by going to the following folder: /views/default/page_elements/.  Then, edit the header.php and footer.php files.  You may also need to clear the Elgg cache by clicking 'Flush the caches' in the dashboard of the Elgg administrator panel.";
				break;
				
			case "jcow":
				return "In JCow, you can edit the header and footer files by going to the following folder: /themes/{Your Active Theme}/.  Then, edit the page.tpl.php file.";
				break;
				
			case "socialengine":
				return "In Social Engine 3, you can edit the header and footer files by going to the SocialEngine Admin Panel.  Under the layout settings tab, select the HTML Templates option.  Next, select the header_global.tpl and footer.tpl files.";
				break;
				
			case "socialengine4":
				return "In Social Engine 4, you can edit the header and footer files by going to the SocialEngine Admin Panel > Layout > Layout Editor > Click \"Editing: Home Page\" and select Site Header > Drag and Drop an HTML Block above everything and paste in the header code.  Then click Editing: Site Header and select Site Footer.  Do the same for the footer code and drag a new HTML Block below everything.  <b>Do not give the HTML blocks a title.</b>";
				break;
				
			case "dolphin":
				return "In Dolphin, you can edit the header and footer files by browsing to your /templates/base/ folder via FTP and editing the _header.html and _footer.html files.  You'll also need to clear the template cache by going to your Dolphin admin panel's home page and clicking \"Templates\" under \"Clear Cache\".  In addition, you'll also need to remove the \"member menu\" if you haven't already.  This can be done by going to your Dolphin admin panel > Settings > Variables > Uncheck \"Enable member menu\".";
				break;
				
			case "drupal":
				return "In Drupal, you can edit the header and footer by editing the page.tpl.php file located in the Drupal directory at /themes/garland/page.tpl.php (where garland is your theme name).";
				break;
				
			case "ipboard":
				return "In IP.Board, you can edit the header and footer files by going to the IP.Board Admin Panel, clicking Look & Feel and then clicking the down arrow next to your active skin(s) and select Manage Templates.  Under Global Templates, select globalTemplate.";
				break;
				
			case "jamroom":
				return "In Jamroom, you can edit the header and footer files by logging in as an admin to Jamroom > Admin Options > System Tools > Template Editor > Search for skins/<Your Theme>/jr_header.tpl and jr_footer.tpl > Click Edit Template.";
				break;
				
			case "phpnuke":
				return "In PHP-Nuke, you can edit the header and footer files by going to the following folder: /php-nuke root/.  Then, edit the header.php and footer.php files.  Be sure that you put the code after the &lt;head&gt; tag and before the &lt;/body&gt; tag.  You can do ctrl+F to find these in the file.";
				break;
				
			case "phpfox":
				return "In PhpFox, you can change the header and footer by logging in as an admin to phpFox > Extensions > Manage Themes > Click the down arrow on your theme > Edit Templates > template.html.php.";
				break;
			
			case "skadate":
				return "In SkaDate, you can edit the header and footer files by going to the following folder: /layout/.  Then, edit the Layout.tpl file.  It is IMPORTANT that you place the header code directly after the <head> tag in SkaDate.  Additionally, you may need to refresh the layout cache by browsing to /\$internal_c/components/{your theme's name}/ and deleting the layout folder.";
				break;
	
			case "xenforo":
				return "In XenForo, you can edit the header and footer files by going to the XenForo Admin Panel > Appearance > Templates > Select the PAGE_CONTAINER template.";
				break;
				
			case "osdate":
				return "In osDate, you can edit the header and footer files by going to the following folder: /templates/{your theme}/.  Then, edit the index_header.tpl and footer.tpl files.  Be sure that you put the header code after the &lt;head&gt; tag and the footer code at the bottom of the footer.tpl file.";
				break;
				
			case "oxwall":
				return "In Oxwall, you can edit the header and footer files by going to the following folder: /Oxwall root/ow_themes/{your theme}/master_pages/html_document.html.  Be sure that you put the code after the &lt;head&gt; tag and before the &lt;/body&gt; tag.  You can do ctrl+F to find these in the file.  You may also need to clear the cache by going to ow_smarty/templace_c/ and deleting the file with html_document.html.php on the end.";
				break;
				
			case "vldpersonals":
				return "In vldPersonals, you can edit the header and footer files by going to the following folder: /templates/webby2/ (where webby2 is the name of your theme).  Then, edit the header.tpl and footer.tpl files.";
				break;
				
			case "mybb":
				return "In MyBB, you can edit the header and footer templates by going to the MyBB Admin Panel > Templates & Style > Templates > Expand Templates.  The header can be chaned in the Ungrouped Templates called headerinclude.  The footer can be changed in the Footer Templates under footer.";
				break;
				
			case "xoops":
				return "In XOOPS, you can edit the header and footer files by going to the XOOPS Admin Panel > Templates > Select your active theme > theme.html.";
				break;
				
			case "standalone":
				return "If you have a header and footer file you can simply add this code to them, otherwise, you will need to add this code to each page you wish ArrowChat to be on.";
				break;
		}
	}
	
	/**
	 * Returns the current relative folder path without the filename
	 *
	 * @param	string	$php_self	The folder path
	 * @return	string	The folder path without filename
	*/
	function GetFileDir($php_self) 
	{ 
		$filename = explode("/", $php_self);
		$filename2 = "";
		
		for( $i = 0; $i < (count($filename) - 1); ++$i ) 
		{ 
			$filename2 .= $filename[$i] . '/'; 
		} 
		
		return $filename2; 
	} 
	
?>