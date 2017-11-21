<?php
require('./session.php');
Session();

include('../conf/init.php');
include('../bibliotheque/o_categories.php');
include('vues/v_page.php');
include('vues/v_widgets.php');

if (isset($_GET['cat'])) {
	$req = CategorieLire($_GET['cat']);
	$data = mysql_fetch_assoc($req);
}

if (strpos($_SESSION['droits'], 'B') !== False) {
	$pasdeparent = '<option value="0">[Pas de parent]</option>';
}
else {
	$pasdeparent = '';
}

if (strpos($_SESSION['droits'], 'B') === False) {
	$avertissement_auteurrietaire = '<tr><td></td><td><em>Attention, si vous spécifiez un autre auteur et que vous n\'avez pas les droits sur les catégories des autres, alors vous n\'y aurez plus accès.</em><t/r></td>';
}
else {
	$avertissement_auteurrietaire = '';
}

function GenererCouleurs($sel) {
	$liste = ['Pas de couleur', 'Rouge', 'Violet', 'Bleu', 'Vert', 'Jaune'];
	for ($i=0 ; $i<=5 ; $i++) {
		if ($sel == $i)
			echo '<option class="couleur_'.$i.'" value="'.$i.'" selected="selected">'.$liste[$i].'</option>';
		else
			echo '<option class="couleur_'.$i.'" value="'.$i.'">'.$liste[$i].'</option>';
	}
}

if (isset($_GET['cat']))
	include('vues/v_categorie_modifier.php');
else
	include('vues/v_categorie_ajouter.php');

mysql_close();
?>

