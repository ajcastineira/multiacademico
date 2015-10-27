<?php

	// Application Settings File
	// This file will be loaded when the user clicks on settings in the admin panel
	
	// THE PHP AND HTML BELOW ARE AN EXAMPLE OF HOW THIS CAN BE USED
	/*
	*/
	
	if (isset($_POST['language']))
	{
		$stringData = "<?php

	\$translate_language[0]	=	\"".$_POST['language']."\";

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
			<div class="subtitle">Edit Language Application</div>
			<fieldset class="firstFieldset">
				<dl class="selectionBox">
					<dt>
						<label for="language">Language</label>
					</dt>
					<dd>
						<input type="text" id="language" class="selectionText" name="language" value="<?php echo $translate_language[0]; ?>" />
						<p class="explain">
							The language to display when the page is translating.
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