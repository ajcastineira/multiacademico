<?php

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
	<style type="text/css">
		#arrowchat_share_wrapper { height:40px; padding: 5px}
	</style>
	<div id="arrowchat_share_wrapper">
		<div class="addthis_toolbox addthis_32x32_style addthis_default_style">
			<a class="addthis_button_facebook"></a>    
			<a class="addthis_button_twitter"></a>
			<a class="addthis_button_myspace"></a>
			<a class="addthis_button_stumbleupon"></a>
			<a class="addthis_button_reddit"></a>
			<a class="addthis_button_digg" title="Digg This"></a>
			<a class="addthis_button_google"></a>
			<a class="addthis_button_email"></a>
			<a class="addthis_button_favorites" title="Bookmark this Page"></a>
		</div>
	</div>
	<script type="text/javascript" src="{$base_url}includes/js/addthis.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			addthis.init();
			addthis.toolbox(".addthis_toolbox");
		});
	</script>
EOD;

?>