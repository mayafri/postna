<?php

include('conf/init.php');
include('bibliotheque/o_billets.php');
include('bibliotheque/o_categories.php');
include('bibliotheque/o_commentaires.php');
include('visiteur/vues/v_elements.php');

session_start();

$categorie_billet = CategorieDuBillet($_GET['id']);
$categorie_initiale = CategorieParentRacine($categorie_billet);

$data = BilletLire($_GET['id']);

if ($categorie_initiale < 0 or $data['local'] != 0) {
	if (!isset($_SESSION['pseudo'])) {
		header('Location: ./404.php');
		mysql_close();
		exit();
	}
}

include('visiteur/vues/v_billet.php');

mysql_close();

?>
