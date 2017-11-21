<?php
require('./session.php');
Session();

include('../conf/init.php');
include('../bibliotheque/o_categories.php');
include('vues/v_page.php');

if (CategorieNombreEnfants($_GET['cat']) < 1) {
	header('Location: ./index.php');
}

$req = CategorieOuvrir($_GET['cat']);

include('vues/v_categorie_classer.php');

mysql_close();
?>
