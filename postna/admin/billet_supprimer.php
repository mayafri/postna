<?php
require('./session.php');
Session();

include('../conf/init.php');
include('../bibliotheque/o_billets.php');
include('../bibliotheque/o_categories.php');

include('vues/v_page.php');
include('vues/v_widgets.php');

$data = BilletLire($_GET['id']); // Seul usage de fonctions.php dans l'appareil

include('vues/v_billet_supprimer.php');

mysql_close();
?>
