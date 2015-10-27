<?php

	require_once(dirname(__FILE__)."/config.php");
	require_once(dirname(__FILE__)."/includes/class.twitter.php");

	$object = new twitter($nusername);
	$tweets = $object->fetch_tweets($tweets_number);
	$followers = $object->fetch_followers($followers_number);

	// Gets the folder path without filename
	function GetFileDir($php_self) { 
		$filename2 = "";
		$filename = explode("/", $php_self);
		for( $i = 0; $i < (count($filename) - 1); ++$i ) { 
			$filename2 .= $filename[$i].'/'; 
		} 
		return $filename2; 
	} 

	$base_url = GetFileDir($_SERVER['PHP_SELF']);

echo <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="expires" content="-1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
	
	<link type="text/css" rel="stylesheet" media="all" href="{$base_url}/includes/css/twitter.css?v=1.0.3" /> 
	
</head>
<body>

	<div style="width:100%;margin:0 auto;margin-top: 0px;">

		<div class="twitter_container">
		
			<div style="float:left;width:154px;border-right:1px dotted #ccc;margin-right:10px;padding:10px;">
			
				<a target="_top" href="http://www.twitter.com/{$nusername}"><img border="0" src="{$base_url}/images/follow.png" /></a>
				
				<br/><br/>
				
				{$followers}
				
			</div>
		
		<div style="float:left;width: 314px; height: 300px;overflow:auto" class="twitter_ul">
		
			<ul>
				{$tweets}
			</ul>
			
		</div>
		
		<div style="clear:both"></div>
	
	</div>

</body>

</html>
EOD;

?>