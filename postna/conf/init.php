<?php

include('conf.php');

$db = mysql_connect($mysql_serveur, $mysql_id, $mysql_pass);
mysql_select_db($mysql_base,$db);
mysql_set_charset('utf8', $db);

?>
