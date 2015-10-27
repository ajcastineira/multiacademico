<?php

	require_once(dirname(__FILE__)."/config.php");

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
	<link type="text/css" rel="stylesheet" media="all" href="{$base_url}includes/css/style.css" /> 
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
	<script src="{$base_url}includes/js/functions.js" type="text/javascript"></script>

	<script type="text/javascript">

		jQuery(document).ready(function($) {
			$("li").click(function() {
				parent.addLanguageCode();
				var b = $('.arrowchat_trayclick').attr('id');
				b = b.substr('30');
				
				var info = $(this).attr('id');
				if (info != b) {
					$('.goog-te-combo', top.document).val(info);
					parent.changeLanguage();
					
					$('#arrowchat_applications_button_' + b).click();
					$('#arrowchat_applications_button_' + b + ' img').attr('src', '{$base_url}images/'+info+'.png');
					$('#arrowchat_app_link_' + b + ' img').attr('src', '{$base_url}images/'+info+'.png');
				}
			});
		});

	</script>

</head>

<body>

	<div style="width:100%;margin:0 auto;margin-top: 0px;height:300px" class="translate_ul">

		<div class="translate_container" style="height:300px;">

			<ul class="languages" style="height: 300px;">
			<li id="af">Afrikaans</li>
			<li id="sq">Albanian</li>
			<li id="ar">Arabic</li>
			<li id="be">Belarusian</li>
			<li id="bg">Bulgarian</li>
			<li id="ca">Catalan</li>
			<li id="zh-CN">Chinese (Simpl)</li>
			<li id="zh-TW">Chinese (Trad)</li>
			<li id="hr">Croatian</li>
			<li id="cs">Czech</li>
			<li id="da">Danish</li>
			<li id="nl">Dutch</li>
			<li id="en">English</li>
			<li id="et">Estonian</li>
			<li id="tl">Filipino</li>
			<li id="fi">Finnish</li>
			<li id="fr">French</li>
			<li id="gl">Galician</li>
			<li id="de">German</li>
			<li id="el">Greek</li>
			<li id="ht">Haitian Creole</li>
			<li id="iw">Hebrew</li>
			<li id="hi">Hindi</li>
			<li id="hu">Hungarian</li>
			<li id="is">Icelandic</li>
			<li id="id">Indonesian</li>
			<li id="ga">Irish</li>
			<li id="it">Italian</li>
			<li id="ja">Japanese</li>
			<li id="ko">Korean</li>
			<li id="lv">Latvian</li>
			<li id="lt">Lithuanian</li>
			<li id="mk">Macedonian</li>
			<li id="ms">Malay</li>
			<li id="mt">Maltese</li>
			<li id="no">Norwegian</li>
			<li id="fa">Persian</li>
			<li id="pl">Polish</li>
			<li id="pt">Portuguese</li>
			<li id="ro">Romanian</li>
			<li id="ru">Russian</li>
			<li id="sr">Serbian</li>
			<li id="sk">Slovak</li>
			<li id="sl">Slovenian</li>
			<li id="es">Spanish</li>
			<li id="sw">Swahili</li>
			<li id="sv">Swedish</li>
			<li id="th">Thai</li>
			<li id="tr">Turkish</li>
			<li id="uk">Ukrainian</li>
			<li id="vi">Vietnamese</li>
			<li id="cy">Welsh</li>
			<li id="yi">Yiddish</li>
			</ul>

			<div class="translating">
				{$translate_language[0]}
			</div>

			<div style="clear:both"></div>
		
		</div>
	
	</div>
	
</body>

</html>
EOD;

?>