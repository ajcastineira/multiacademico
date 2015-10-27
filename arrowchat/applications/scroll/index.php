<?php

echo <<<EOD
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html> 
<head>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var b = $('.arrowchat_trayclick').attr('id');
			b = b.substr('30');
			$('#arrowchat_applications_button_' + b).click();
			
			$('html, body').animate({scrollTop:0}, 'fast');
		});
	</script>
	
</head>

<body>

</body>

</html>
EOD;

?>