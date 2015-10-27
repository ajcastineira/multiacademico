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
<style>
.google_plus_one
{
margin-left:25px;
text-align:left;
}
img#center
{
margin-left:18px;
}
</style>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js">
  {lang: 'en-GB'}
</script>
</head>
<body>
<br><div class="google_plus_one">
<g:plusone><img id="center" src="/arrowchat/applications/plus_one/images/ajax-loader.gif"></img></g:plusone>
</div><br>



</body>
</html>