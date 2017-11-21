<?php
require('./session.php');
Session();

include('../conf/init.php');
include('../bibliotheque/o_categories.php');
include('vues/v_page.php');

$req = CategorieLire($_GET['cat'], $special=True);
$data = mysql_fetch_assoc($req);

if (($data['parent'] == 0 and CategoriesPrincipalesNombre() <= 1) or ($_GET['cat'] < 1)) {
	header('Location: ./index.php');
}

include('vues/v_categorie_supprimer.php');

mysql_close();
?>
