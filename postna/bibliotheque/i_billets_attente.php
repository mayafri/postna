<?php
function BilletPublier($id) {
	mysql_query('UPDATE '.$GLOBALS['base'].'_billets SET local=0 WHERE id='.$id);
}
?>

