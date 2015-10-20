<?php
/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */
$current_page_uri = $_SERVER['REQUEST_URI'];
//$querystring = $_SERVER['QUERY_STRING'];
//$part_url = explode("/", $current_page_uri);
//$page_name = end($part_url);
//var_dump($current_page_uri,$querystring,$part_url);

header("Location: ".$current_page_uri."web");
