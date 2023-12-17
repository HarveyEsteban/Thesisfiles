<?php
session_start();
require_once('Facebook/autoload.php');

$FBObject = new \Facebook\Facebook([
	'app_id' => '1218602689530821',
	'app_secret' => 'd0002d6ec41faa8808607331e54d493e',
	'default_graph_version' => 'v2.10'



]);

$handler = $FBObject -> getRedirectLoginHelper();








?>