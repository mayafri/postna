<?php

require('./session.php');
Session();

include('../conf/init.php');

include('../bibliotheque/o_fichiers.php');

// On définit le dossier à afficher selon le GET de l'URL par rapport
// au dossier choisi à la base.

if (!isset($_GET['url']))
	$_GET['url'] = '';
if (!isset($_GET['mode']))
	$_GET['mode'] = '';
		
$_SESSION['position_dossier'] = $_GET['url'];
$dossier = '../'.$_SESSION['racine_doc'].$_GET['url'];
$dossier_absolu = $_SESSION['racine'].'/'.$_SESSION['racine_doc'].$_GET['url'];
$documents = scandir($dossier);

// Une regex coupe la dernière partie de l'arborescence pour qu'on puisse
// remonter au dossier parent proprement. Ce qui évite des choses du genre :
// « /dossier/dossier2/../dossier3/../../dossier2/ »

$parent = preg_replace("/^([^\/]*)\/$/", "", $_GET['url']);
$parent = preg_replace("/(.*)\/(.*)\//", "$1/", $parent);

if (strpos($_SESSION['droits'], 'c') === False and strpos($_SESSION['droits'], 'C') === False) {
	if ($_GET['mode'] == 'inserer')
		echo '<script>window.close();</script>';
	else
		header('Location: ./index.php');
	exit();
}
if (!isset($_SESSION['pseudo']) or substr($_GET['url'], 0, 3) == '../') {
	header('Location: ./index.php');
	exit();
}

$espace = round(disk_free_space('/')/1024/1024/1024, 2);

if ($_GET['mode'] == 'editeur') {

	function MenuElement($fichier) {
		echo '<div class="menu_element">';
		echo '	<p><a href="fichiers_actions.php?action=deplacer&mode=editeur&type='.$_GET['type'].'&elem='.$fichier.'">Déplacer</a></p>';
		echo '	<p><a href="fichiers_actions.php?action=copier&mode=editeur&type='.$_GET['type'].'&elem='.$fichier.'">Copier</a></p>';
		echo '	<p><a href="fichiers_actions.php?action=renommer&mode=editeur&type='.$_GET['type'].'&elem='.$fichier.'">Renommer</a></p>';
		echo '	<p><a href="envois/e_fichiers_supprimer.php?mode=editeur&type='.$_GET['type'].'&elem='.$fichier.'">Supprimer</a></p>';
		echo '</div>';
	}
	
	include('vues/v_fichiers_editeur.php');
}

else {
	include('../bibliotheque/o_billets_attente.php');
	include('../bibliotheque/o_commentaires.php');
	include('vues/v_page.php');

	function MenuElement($fichier) {
		echo '<div class="menu_element">';
		echo '	<p><a href="#" onclick="window.open(\'fichiers_actions.php?action=deplacer&elem='.$fichier.'\', \'\', \'width=450,height=400,scrollbars=yes,location=no\')">Déplacer</a></p>';
		echo '	<p><a href="#" onclick="window.open(\'fichiers_actions.php?action=copier&elem='.$fichier.'\', \'\', \'width=450,height=400,scrollbars=yes,location=no\')">Copier</a></p>';
		echo '	<p><a href="#" onclick="window.open(\'fichiers_actions.php?action=renommer&elem='.$fichier.'\', \'\', \'width=450,height=400,scrollbars=yes,location=no\')">Renommer</a></p>';
		echo '	<p><a href="envois/e_fichiers_supprimer.php?elem='.$fichier.'">Supprimer</a></p>';
		echo '</div>';
	}

	include('vues/v_fichiers.php');
}

mysql_close();
?>
