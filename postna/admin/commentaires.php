<?php
require('./session.php');
Session();

include('../conf/init.php');
include('../bibliotheque/o_commentaires.php');
include('../bibliotheque/o_billets.php');
include('../bibliotheque/o_billets_attente.php');

if (strpos($_SESSION['droits'], 'A') === False) {
	if ($_GET['art'] != 'nval') {
		if (BilletVerifierAutorisation($_GET['art'], $_SESSION['id']) != True) {
			header('Location: ./index.php');
			exit();
		}
	}
}

include('vues/v_page.php');

if ($_GET['art'] == 'nval')
	include('vues/v_commentaires_nval.php');
else
	include('vues/v_commentaires_page.php');

mysql_close();
?>

