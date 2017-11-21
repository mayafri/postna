<?php
require('./session.php');
Session('.', 'E');

include('../conf/init.php');
include('../bibliotheque/o_billets_attente.php');
include('../bibliotheque/o_commentaires.php');
include('vues/v_page.php');

include('../bibliotheque/o_droits.php');

$req = ProfilsLire();

include('vues/v_droits.php');

mysql_close();
?>

