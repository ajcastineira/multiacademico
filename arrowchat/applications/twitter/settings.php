<?php

	// Application Settings File
	// This file will be loaded when the user clicks on settings in the admin panel
	
	// THE PHP AND HTML BELOW ARE AN EXAMPLE OF HOW THIS CAN BE USED
	/*
	*/
	
	if (isset($_POST['twitter_username']))
	{
		$stringData = "<?php

	// Your Twitter username
	\$nusername = ".$_POST['twitter_username'].";
	
	// How many Tweets to display
	\$tweets_number = ".$_POST['tweets_to_display'].";
	
	// How many followers to display
	\$followers_number = ".$_POST['followers_to_display'].";

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
			<div class="subtitle">Edit Twitter Application</div>
			<fieldset class="firstFieldset">
				<dl class="selectionBox">
					<dt>
						<label for="twitter_username">Twitter Username</label>
					</dt>
					<dd>
						<input type="text" id="twitter_username" class="selectionText" name="twitter_username" value="<?php echo $nusername; ?>" />
						<p class="explain">
							The ID of your Facebook page.  Leave this blank if you have a unique page name (http://www.twitter.com/arrowchat/)
						</p>
					</dd>
				</dl>
			</fieldset>
			<fieldset>
				<dl class="selectionBox">
					<dt>
						<label for="tweets_to_display">Tweets to Display</label>
					</dt>
					<dd>
						<input type="text" id="tweets_to_display" class="selectionText" name="tweets_to_display" value="<?php echo $tweets_number; ?>" />
						<p class="explain">
							The number of tweets to display.  Default: 12
						</p>
					</dd>
				</dl>
				<dl class="selectionBox">
					<dt>
						<label for="followers_to_display">Followers to Display</label>
					</dt>
					<dd>
						<input type="text" id="followers_to_display" class="selectionText" name="followers_to_display" value="<?php echo $followers_number; ?>" />
						<p class="explain">
							The number of followers to display.  Default: 48
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