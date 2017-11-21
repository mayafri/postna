<?php

// DÉPENDANCES =================================================================
//
//   - GenererRacineArbo : bibliotheque/o_categories.php
//   - GenererArbo : bibliotheque/o_categories.php
//   - GenererArboForm : bibliotheque/o_categories.php
//   - GenererArboFormFocusParent : bibliotheque/o_categories.php
//
// DÉPENDANCES =================================================================



// GENERER RACINE ARBO

// Fonction qui affiche la racine de l'arborescence.
// Insère des éléments <option> dans un <select> à définir autour.
// Nécessite en paramètre l'index d'une catégorie.
// Exclut les catégories spéciales.

function GenererRacineArbo($categorie) {	
	$req = CategorieOuvrir(0, True);
	while ($data = mysql_fetch_assoc($req)) {
		if ($categorie == $data['id']) { 
			echo '<option value="'.$data['id'].'" selected="selected">'.$espacement.$data['nom'].'</option>';
		}
		else {
			echo '<option value="'.$data['id'].'">'.$espacement.$data['nom'].'</option>';
		}
	}
}

// GENERER ARBO

// Fonction récursive pour afficher les enfants et leurs enfants.
// Insère des éléments <p> à raison de un par ligne.
// Nécessite en paramètre l'index d'une catégorie.

function GenererArbo($categorie) {
	$niveau = 0;
	function AfficherEnfants($categorie, $parent=0) {
		global $niveau;

		$req = CategorieOuvrir($parent);
	
		while ($data = mysql_fetch_assoc($req)) {
			echo '<p style="padding-left: '.$niveau.'em;">';

			if (strpos($_SESSION['droits'], 'B') === False
			and CategorieVerifierAutorisation($data['id'], $_SESSION['id']) != True) {
				$parametre = ' lectureseule';
			}
			else {
				$parametre = '';
			}

			if ($categorie == $data['id']) { 
				echo ' <strong><a class="couleur_'.$data['couleur'].$parametre.'" href="index.php?cat='.$data['id'].'">'.$data['nom'].'</a></strong></p>';
			}
			else {
				echo ' <a class="couleur_'.$data['couleur'].$parametre.'" href="index.php?cat='.$data['id'].'">'.$data['nom'].'</a></p>';
			}
			$niveau += 1.5;
			AfficherEnfants($categorie, $data['id']);
			$niveau -= 1.5;
		}
	}
	AfficherEnfants($categorie);
}

// GENERER ARBO FORM

// Fonction récursive pour afficher les enfants et leurs enfants.
// Insère des éléments <option> dans un <select> à définir autour.
// Nécessite en paramètre l'index d'une catégorie.

function GenererArboForm($categorie) {	
	$niveau = 0;
	
	function AfficherEnfants($selection, $parent=0) {
		global $niveau;

		$req = CategorieOuvrir($parent);
	
		while ($data = mysql_fetch_assoc($req)) {
			$espacement = '';
			for ($i=0; $i<$niveau; $i++) {
				$espacement = $espacement.'⋅ ⋅ ⋅ ';
			}
			
			if (strpos($_SESSION['droits'], 'B') === False
			and CategorieVerifierAutorisation($data['id'], $_SESSION['id']) != True) {
				$parametre = 'disabled="disabled"';
			}
			else {
				$parametre = '';
			}
			
			if ($selection == $data['id']) { 
				echo '<option value="'.$data['id'].'" selected="selected" '.$parametre.'>'.$espacement.$data['nom'].'</option>';
			}
			else {
				echo '<option value="'.$data['id'].'" '.$parametre.'>'.$espacement.$data['nom'].'</option>';
			}
			$niveau += 1;
			AfficherEnfants($selection, $data['id']);
			$niveau -= 1;
		}
	}

	AfficherEnfants($categorie);
}

// GENERER ARBO FORM FOCUS PARENT

// Fonction récursive pour afficher les enfants et leurs enfants.
// Insère des éléments <option> dans un <select> à définir autour.
// Nécessite en paramètre l'index d'une catégorie.

function GenererArboFormFocusParent($categorie) {
	$variable_parent = CategorieParent($categorie);

	$niveau = 0;
	function AfficherEnfants($no_cat, $sel_parent, $parent=0) {
		global $niveau;

		$req = CategorieOuvrir($parent);
	
		while ($data = mysql_fetch_assoc($req)) {
			$espacement = '';
			for ($i=0; $i<$niveau; $i++) {
				$espacement = $espacement.'⋅ ⋅ ⋅ ';
			}
			
			if (strpos($_SESSION['droits'], 'B') === False
			and CategorieVerifierAutorisation($data['id'], $_SESSION['id']) != True) {
				$parametre = 'disabled="disabled"';
			}
			else {
				$parametre = '';
			}
			
			if ($sel_parent == $data['id']) {
				echo '<option value="'.$data['id'].'" selected="selected" '.$parametre.'>'.$espacement.$data['nom'].'</option>';
			}
			else if ($no_cat != $data['id']) {
				echo '<option value="'.$data['id'].'" '.$parametre.'>'.$espacement.$data['nom'].'</option>';			
			}
		
			if ($data['id'] != $no_cat) {
				$niveau += 1;
				AfficherEnfants($no_cat, $sel_parent, $data['id']);
				$niveau -= 1;
			}
		
		}
	}

	AfficherEnfants($categorie, $variable_parent);
}

// CASE COCHER

// Génère une case à cocher avec gestion de la sélection selon une condition
// Nécessite la variable à vérifier (booléen) et le nom

function CaseCocher ($nom, $var=0, $options='') {
	if ($var == True)
		echo '<input '.$options.' type="checkbox" name="'.$nom.'" checked="checked" />';
	else
		echo '<input '.$options.' type="checkbox" name="'.$nom.'" />';
}

// GÉNÉRER LISTE AUTEURS

// Fonction qui affiche la liste des auteurs.
// Insère des éléments <option> dans un <select> à définir autour.
// Peut prendre en paramètre l'ID d'un auteur pour le sélectionner.

function GenererListeAuteurs($id='', $options='') {
	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_auteurs');
	while ($data = mysql_fetch_assoc($req)) {
		if($id == $data['id'])
			echo '<option '.$options.' value="'.$data['id'].'" selected="selected">'.$data['nom'].'</option>';
		else
			echo '<option '.$options.' value="'.$data['id'].'">'.$data['nom'].'</option>';
	}
}

function GenererCasesAuteurs($auteurs='') {
	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_auteurs WHERE id>0'); // On n'affiche pas l'admin
	while ($data = mysql_fetch_assoc($req)) {
		if(strpos($data['droits'], 'B') === False) {
			if(strpos($auteurs, $data['id']) !== False)
				echo '<tr><td colspan=2><input '.$auteurs.' type="checkbox" name="auteurs[]" checked="checked" value="'.$data['id'].'" />'.$data['nom'].' ('.$data['pseudo'].')</td></tr>';
			else
				echo '<tr><td colspan=2><input '.$auteurs.' type="checkbox" name="auteurs[]" value="'.$data['id'].'" />'.$data['nom'].' ('.$data['pseudo'].')</td></tr>';
		}
	}
}

function GenererCasesCoauteurs($auteurs='', $options='') {
	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_auteurs WHERE id>0'); // On n'affiche pas l'admin
	while ($data = mysql_fetch_assoc($req)) {
		if(strpos($data['droits'], 'A') === False and $data['id'] != $_SESSION['id']) {
			if(strpos($auteurs, $data['id']) !== False)
				echo '<p><input type="checkbox" '.$options.' name="coauteurs[]" checked="checked" value="'.$data['id'].'" />'.$data['nom'].' ('.$data['pseudo'].')</p>';
			else
				echo '<p><input type="checkbox" '.$options.' name="coauteurs[]" value="'.$data['id'].'" />'.$data['nom'].' ('.$data['pseudo'].')</p>';
		}
	}
}

?>
