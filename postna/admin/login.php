<?php

include('../conf/init.php');
include('vues/v_page.php');

if(!isset($_GET['erpass']))
	$_GET['erpass'] = 0;
	
if(!isset($_GET['pseudo']))
	$_GET['pseudo'] = '';

include('vues/v_login.php');

?>

