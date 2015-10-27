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
</head>
<body>
<iframe allowtransparency="true" hspace="0" vspace="0" marginheight="0" marginwidth="0"
 src="http://widget.currency-converter.com/widget/ccwidget.html?from=USD&to=EUR&val=1&du=3600&ac=1" border="0" 
id="ccwidget_iframe_0" name="ccwidget_iframe_0" scrolling="no" width="200" frameborder="0" height="236"></iframe>
<br /><div style="font-size:10px;margin:0;padding:0;text-align:center;width:200px;">
<a href="http://www.currency-converter.com/" style="text-align:center;" target="_blank">Currency-Converter.com</a>
</div>
</body>
</html>