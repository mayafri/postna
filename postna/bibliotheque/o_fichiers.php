<?php

// GENERER ARBO FICHIERS
// Insère des éléments <option> dans un <select> à définir autour.
// Paramètres :
//   - $racine : la racine du dossier à parcourir.
//   - $exclure (optionnel) : le chemin du dossier à exclure de l'affichage.

function FichiersArborescenceWidgetOption($racine, $exclure='') {	
	echo '<option value="'.$racine.'">Documents</option>';
	$niveau = 0;
	function AfficherEnfants($dossier, $exclure) {
		global $niveau;
	
		foreach (scandir($dossier) as $element) {
			if (is_dir($dossier.$element)
				and $element != '.'
				and $element != '..'
				and substr($element, 0, 1) != '.'
				and $dossier.$element.'/' != $exclure) {
								
				$espacement = '⋅ ⋅ ⋅ ';
				for ($i=0; $i<$niveau; $i++) {
					$espacement = $espacement.'⋅ ⋅ ⋅ ';
				}
				echo '<option value="'.$dossier.$element.'/'.'">'.$espacement.$element.'</option>';
				$niveau += 1;
				AfficherEnfants($dossier.$element.'/', $exclure);
				$niveau -= 1;
			}
		}
	}

	AfficherEnfants($racine, $exclure);
}

function CheminExtraireNom($chemin) {
	if (substr($chemin, -1) == '/') {
		$position = strrpos($chemin, '/', -2);
	}
	else {
		$position = strrpos($chemin, '/', 0);
	}
	
	$element = substr($chemin, $position);
	return str_replace('/', '', $element);
}

function CheminRetirerNom($chemin) {
	if (substr($chemin, -1) == '/') {
		$position = strrpos($chemin, '/', -2);
	}
	else {
		$position = strrpos($chemin, '/', 0);
	}
	return substr($chemin, 0, $position+1);
}

function FichierNomValide($element) {
	if (trim($element) == '' or
	strpos($element, '<') !== False or
	strpos($element, '>') !== False or
	strpos($element, '/') !== False or
	strpos($element, '\\') !== False or
	strpos($element, '&') !== False) {
		return False;
	}
	else {
		return True;
	}
}

function CheminMiniatureFichier($fichier) {
	return CheminRetirerNom($fichier).'.min/'.CheminExtraireNom($fichier);
}

?>
