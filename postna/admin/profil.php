<?php
require('./session.php');
Session();

include('../conf/init.php');
include('../bibliotheque/o_billets_attente.php');
include('../bibliotheque/o_commentaires.php');
include('vues/v_page.php');

include('vues/v_profil.php');

mysql_close();
?>
