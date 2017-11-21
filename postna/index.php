<?php

include('conf/init.php');

include('bibliotheque/o_billets.php');
include('bibliotheque/o_categories.php');
include('bibliotheque/o_nombres.php');
include('bibliotheque/o_commentaires.php');
include('visiteur/vues/v_elements.php');

if (!isset($_GET['cat']))
	$_GET['cat'] = 0;

// Définition de variables pour le header
$categorie_initiale = CategorieParentRacine($_GET['cat']);
$categorie = $_GET['cat'];

// Si on ouvre la page sans catégorie, il suit la config choisie (conf.php)
// Soit il redirige vers une section définie, soit il affiche tout
if ($_GET['cat'] == 0) {
	if ($redirection_index != '') {
		header('Location: ./index.php?cat='.$redirection_index);
		exit();
	}
}

// Si la catégorie n'existe pas, on redirige vers la page 404.php
if ($_GET['cat'] < 0 or CategorieExiste() == 0) {
	header('Location: ./404.php');
	mysql_close();
	exit();
}

// Définition des paramètres pour la limite MySQL du compteur de pages
$limite = CompteurPagesWidgetLimite($billets_par_page);

$array_cat = mysql_fetch_array(CategorieLire($categorie));

$req = BilletsLireRecursif($categorie, $limite, $billets_par_page);
include('visiteur/vues/v_index.php');

mysql_close();

?>
