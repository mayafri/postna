<?php

include('conf/init.php');

include('bibliotheque/o_billets.php');
include('bibliotheque/o_categories.php');
include('bibliotheque/o_commentaires.php');
include('bibliotheque/o_nombres.php');
include('visiteur/vues/v_elements.php');

// Définition de variables pour le header
if (isset($_GET['cat'])) {
	$categorie_initiale = CategorieParentRacine($_GET['cat']);
}
else {
	$_GET['cat'] = 0;
	$categorie_initiale = 0;
}

// Définition des paramètres pour la limite MySQL du compteur de pages
$limite = CompteurPagesWidgetLimite($billets_par_page);

// Requête globale qui sera triée dans le WHILE de la boucle d'affichage
$req = BilletsLire('', False);

if (isset($_GET['tag'])) {
	include('visiteur/vues/v_recherche_tag.php');
}
elseif (isset($_GET['req'])) {
	$requete = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml|grave);/", "$1", strtolower(trim($_GET['req'])));
	
	// Arguments longs négatifs -"..." -> "-..."
	$requete = str_replace('-"', '"-', $requete);
	
	// Pour isoler les expression en guillemets, on parcourt la chaine.
	// À chaque guillement, l'interrupteur change d'état.
	// Si l'interrupteur est activé, on recopie tous les caractères
	// de la chaine jusqu'au prochain guillemet inclus, qui va
	// désactiver l'interrupteur. Ensuite, on coupe la chaine en array
	// en se servant du dernier guillemet recopié.

	$requete_expr = '';
	$switch = False;
	for ($i=0 ; $i < strlen($requete) ; $i++) {
		if ($requete[$i] == '"') {
			if ($switch == False)
				$switch = True;
			else
				$switch = False;
		}
		if ($switch == True)
			$requete_expr = $requete_expr.$requete[$i];
	}
	
	// On crée le array des expressions longues
	$array_requete_expr = explode('"', $requete_expr);
	
	// On enlève de la requète d'origine les expressions longues
	foreach ($array_requete_expr as $i)
		$requete = str_replace('"'.$i.'"', '', $requete);
	
	// On crée le array des expressions (simples + longues)
	$array_requete = explode(' ', $requete);
	$array_requete = array_merge($array_requete, $array_requete_expr);
	$array_requete = array_filter($array_requete);
	
	// On crée le array des exclusions et on nettoie l'autre array
	// des expressions en conséquence
	$array_requete_exclusion = [];
	foreach ($array_requete as $i => $element) {
		if (substr($element, 0, 1) == '-') {
			unset($array_requete[$i]);
			array_push($array_requete_exclusion, substr($element, 1));
		}
	}
	
	include('visiteur/vues/v_recherche_mots.php');
}
else {
	header('Location: ./index.php');
}

mysql_close();

?>
