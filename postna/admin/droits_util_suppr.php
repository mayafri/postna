<?php
require('./session.php');
Session('.', 'E');

include('../conf/init.php');
include('../bibliotheque/o_commentaires.php');
include('vues/v_page.php');

include('../bibliotheque/o_droits.php');
include('vues/v_droits_util_suppr.php');

mysql_close();
?>

