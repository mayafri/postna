<?php

function AleaGenererID() {
	$chaine1 = strval(mt_rand(100000000, 999999999));
	$chaine2 = strval(mt_rand(100000000, 999999999));
	return $chaine1.$chaine2;
}

function AleaGenererMotdepasse() {
	return substr(str_shuffle('azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN'.sha1(uniqid())), 0, 10);
}

// COMPTEUR PAGES LIMITE
// Définit la limite de chargement pour les requêtes MySQL, dans le cadre
// d'un compteur de pages.
// PARAMÈTRE : Le nombre d'billets par page
function CompteurPagesWidgetLimite($billets) {
	if (isset($_GET['p'])) {
		return $billets*($_GET['p']-1);
	}
	else {
		return 0;
	}
}

// COMPTEUR PAGES
// Retourne un menu de pages au format HTML dans un DIV.
// PARAMÈTRE : Le nombre d'billets par page, le nombre total de billets et
// le booléen $toujours (qui, si activé, affichera l'élément même si une seule
// page existe pour le contenu)
function CompteurPagesWidget($billets, $nb_billets, $toujours=False, $prefixe='Pages : ', $mode='index') {	
	if ($nb_billets > $billets or $toujours==True) {
		echo '<p id="pages">';
		echo $prefixe;
		if (isset($_GET['p'])) {
			$no_page = $_GET['p'];
		}
		else {
			$no_page = 1;
		}
		if ($mode == 'index') {
			for ($i=1 ; $i <= ceil($nb_billets/$billets) ; $i++) {
				if ($no_page == $i) {
					echo '<strong><a href="index.php?cat='.$_GET['cat'].'&p='.$i.'">'.$i.'</a></strong> ';
				}
				else {
					echo '<a href="index.php?cat='.$_GET['cat'].'&p='.$i.'">'.$i.'</a> ';
				}
			}
		}
		if ($mode == 'tags') {
			for ($i=1 ; $i <= ceil($nb_billets/$billets) ; $i++) {
				if ($no_page == $i) {
					echo '<strong><a href="recherche.php?tag='.$_GET['tag'].'&p='.$i.'">'.$i.'</a></strong> ';
				}
				else {
					echo '<a href="recherche.php?tag='.$_GET['tag'].'&p='.$i.'">'.$i.'</a> ';
				}
			}
		}
		if ($mode == 'mots') {
			for ($i=1 ; $i <= ceil($nb_billets/$billets) ; $i++) {
				if ($no_page == $i) {
					echo '<strong><a href=\'recherche.php?req='.$_GET['req'].'&p='.$i.'\'>'.$i.'</a></strong> ';
				}
				else {
					echo '<a href=\'recherche.php?req='.$_GET['req'].'&p='.$i.'\'>'.$i.'</a> ';
				}
			}
		}
		echo '</p>';
	}
}

?>

