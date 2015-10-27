<?php

	require_once(dirname(__FILE__)."/config.php");

echo <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="expires" content="-1">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/> 
</head>

<body>

	<iframe src="http://www.facebook.com/connect/connect.php?id={$pageId}&name={$pageName}&connections={$connections}&stream={$displayStream}&css=http://www.arrowchat.com/scripts/facebook.css?v4" width="396" height="352" scrolling="no" frameborder="0"></iframe>
	
</body>

</html>
EOD;

?>