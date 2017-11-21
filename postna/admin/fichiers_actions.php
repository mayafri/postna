<?php
require('./session.php');
Session('.', 'C');

include('../bibliotheque/o_fichiers.php');

if (isset($_GET['elem'])) {
	if (is_dir($_GET['elem']))
		$type = 'dossier';
	else
		$type = 'fichier';

	$element = CheminExtraireNom($_GET['elem']);
}
else {
	$type = 'fichier';
}

if ($_GET['action'] == 'renommer') {
	$fonction = 'Renommer le '.$type.'';
}
else if ($_GET['action'] == 'deplacer') {
	$fonction = 'Déplacer le '.$type.'';
}
else if ($_GET['action'] == 'copier') {
	$fonction = 'Copier le '.$type.'';
}
else if ($_GET['action'] == 'uploader') {
	$fonction = 'Envoyer un fichier';
}
else if ($_GET['action'] == 'dossier') {
	$fonction = 'Nouveau dossier';
}

include('vues/v_page.php');
include('vues/v_fichiers_actions.php');
?>
