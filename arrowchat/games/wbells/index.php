<?php
	// Gets the folder path without filename
	function GetFileDir($php_self) { 
		$filename = explode("/", $php_self);
		for( $i = 0; $i < (count($filename) - 1); ++$i ) { 
			$filename2 .= $filename[$i].'/'; 
		} 
		return $filename2; 
	} 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-gb" xml:lang="en-gb"> 
<head>

<style type="text/css"> 
	body, html {
		margin: 0px;
		padding: 0px;
	}
</style>

</head>
<body>

 <OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" WIDTH="665" HEIGHT="500" id="arrowchat_wbells">
	<PARAM NAME="movie" VALUE="<?php echo GetFileDir($_SERVER['PHP_SELF']); ?>includes/wbells.swf">
	<PARAM NAME="quality" VALUE="high">
	<PARAM NAME="bgcolor" VALUE="#000000">
	<EMBED src="<?php echo GetFileDir($_SERVER['PHP_SELF']); ?>includes/wbells.swf" quality="high" bgcolor="#000000" WIDTH="665" HEIGHT="500" NAME="arrowchat_wbells" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash"></EMBED>
</OBJECT>

</body>
</html>