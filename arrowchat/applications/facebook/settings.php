<?php

	// Application Settings File
	// This file will be loaded when the user clicks on settings in the admin panel
	
	// THE PHP AND HTML BELOW ARE AN EXAMPLE OF HOW THIS CAN BE USED
	/*
	*/
	
	if (isset($_POST['facebook_page_name']))
	{
		$stringData = "<?php

// The page ID of your Facebook page.  Leave blank if you have a page like facebook.com/arrowchat
\$pageId = '".$_POST['facebook_page_id']."';

// The page name of your Facebook page.
\$pageName = '".$_POST['facebook_page_name']."';

// Which stream to display
\$displayStream = '1';

// The number of people to show that like your facebook page.
\$connections = '6';

?>";
		
		// Write new Config File
		$myFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php";
		$fh = fopen($myFile, 'w') or die("Can't open config.php file.  Please make this file writable.");
		fwrite($fh, $stringData);
		fclose($fh);
	}
	
	$writable = false;
	
	if (is_writable(dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php"))
	{
		$writable = true;
	}
	
	include_once (dirname(__FILE__) . DIRECTORY_SEPARATOR . "config.php");
?>

	<div class="title_bg"> 
		<div class="title">Manage</div> 
		<div class="module_content">
			<form method="post" action="" enctype="multipart/form-data">
			<div class="subtitle">Edit Facebook Application</div>
			<fieldset class="firstFieldset">
				<dl class="selectionBox">
					<dt>
						<label for="facebook_page_id">Facebook Page ID</label>
					</dt>
					<dd>
						<input type="text" id="facebook_page_id" class="selectionText" name="facebook_page_id" value="<?php echo $pageId; ?>" />
						<p class="explain">
							The ID of your Facebook page.  Leave this blank if you have a unique page name (http://www.facebook.com/arrowchat/)
						</p>
					</dd>
				</dl>
				<dl class="selectionBox">
					<dt>
						<label for="facebook_page_name">Facebook Page Name</label>
					</dt>
					<dd>
						<input type="text" id="facebook_page_name" class="selectionText" name="facebook_page_name" value="<?php echo $pageName; ?>" />
						<p class="explain">
							The name of your Facebook page to connect to.
						</p>
					</dd>
				</dl>
			</fieldset>
			<?php
				if ($writable)
				{
			?>
			<dl class="selectionBox submitBox">
				<dt></dt>
				<dd>
					<div class="floatr">
						<a class="fwdbutton" onclick="document.forms[0].submit(); return false">
							<span>Save Changes</span>
						</a>
						<input type="hidden" name="submit_processor" value="1" />
					</div>
				</dd>
			</dl>
			<?php
				} else {
			?>
			<dl class="selectionBox">
				<dt></dt>
				<dd>
				<b>Please make the <?php echo dirname(__FILE__) . DIRECTORY_SEPARATOR; ?>config.php writable (CHMOD 777) to save the settings.</b>
				</dd>
			</dl>
			<?php
				}
			?>
		</div>
	</div>