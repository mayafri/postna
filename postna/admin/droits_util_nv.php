<?php
require('./session.php');
Session('.', 'E');

include('../conf/init.php');
include('../bibliotheque/o_commentaires.php');
include('vues/v_page.php');

include('vues/v_droits_util_nv.php');

mysql_close();
?>

