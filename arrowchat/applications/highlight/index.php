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

<html>
	<head>
<style>
.highlight 
{
background-color: yellow;
color: black;
}
</style>

<script type="text/javascript" src="<?php echo GetFileDir($_SERVER['PHP_SELF']); ?>jquery-1.3.2.min.js" ></script>
		<script type="text/javascript" src="<?php echo GetFileDir($_SERVER['PHP_SELF']); ?>jquery.highlight-3.js" ></script>
<script>
function Check()
{
$('*').highlight($('#highlightt').val());
}
</script>
		<body>&nbsp;&nbsp;
<input name="highlightt" type="text" style="background-color: white;" id="highlightt" size="25"/> &nbsp;

<input type="button" id="btnHighlight" style="background-color: white;" onclick="Check();" value="Highlight!" />

</body>
</html>
