<?php
function BilletNombreNonPublies() {
	$req = mysql_query('SELECT id FROM '.$GLOBALS['base'].'_billets WHERE local=1 AND auteur='.$_SESSION['id']);
	return mysql_num_rows($req);
}
?>

