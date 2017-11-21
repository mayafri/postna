<?php
require('./session.php');
Session();

include('../conf/init.php');
include('../bibliotheque/o_commentaires.php');
include('../bibliotheque/o_billets.php');
include('../bibliotheque/o_billets_attente.php');

include('vues/v_page.php');

$req = BilletsLire();
$nb = BilletNombreNonPublies();
include('vues/v_billets_attente.php');

mysql_close();
?>

