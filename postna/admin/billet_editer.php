<?php
require('./session.php');
Session();

include('../conf/init.php');

include('../bibliotheque/o_billets.php');
include('../bibliotheque/o_categories.php');

// Si nous n'avons pas les droits spéciaux sur les billets
if (strpos($_SESSION['droits'], 'A') === False) {
	// Si nous éditons sans être auteur ou co-auteur
	if (isset($_GET['id']) and BilletVerifierAutorisation($_GET['id'], $_SESSION['id']) != True) {
		header('Location: ./index.php');
		exit();	
	}
}

include('vues/v_page.php');
include('vues/v_widgets.php');

if (isset($_GET['id'])) {
	$data = BilletLire($_GET['id']);

	$type = 'Modifier';
	$contenu = $data['contenu'];
	$coauteurs = $data['coauteurs'];
	$titre = $data['titre'];
	$cible_arbo = $data['cat'];
	$cible_auteur = $data['auteur'];
	$tags = $data['tags'];
	$local = $data['local'];
}
else {
	$_GET['id'] = 0;
	$type = 'Ajouter';
	$contenu = '';
	$coauteurs = '';
	$titre = '';
	$cible_arbo = $_GET['cat'];
	$cible_auteur = $_SESSION['id'];
	$tags ='';
	$local = '';
}

if (!isset($_GET['mode']))
	$_GET['mode'] = 'interactif';

if (!isset($_SESSION['temp_billet_titre']))
	$_SESSION['temp_billet_titre'] = '';

if (!isset($_SESSION['temp_billet_contenu']))
	$_SESSION['temp_billet_contenu'] = '';

include('vues/v_billet_editer.php');

mysql_close();
?>
