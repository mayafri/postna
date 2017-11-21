<?php

// DÉPENDANCES =================================================================

//   - Arborescence : bibliotheque/o_categories.php
//   - GenererMenuSimple : bibliotheque/o_categories.php

// DÉPENDANCES =================================================================



// Génère un panneau latéral <div id="arbo"> qui comporte l'arborescence
// d'une catégorie principale, avec sélection de l'élément voulu.
// Paramètres : la catégorie initiale et la catégorie à sélectionner

function Arborescence($categorie, $selection) {
	$nb_enfants = CategorieNombreEnfants($categorie);

	if ($nb_enfants > 0 and $categorie > 0) {
		echo '<div id="arbo">';

		// Fonction récursive pour afficher les enfants et leurs enfants
		$niveau = 0;
		function AfficherEnfants($parent, $selection) {
			global $niveau;

			$req = CategorieOuvrir($parent);
	
			while ($data = mysql_fetch_assoc($req)) {
				echo '<p style="padding-left: '.$niveau.'em;">';

				if ($selection == $data['id']) { 
					echo '<strong><a href="index.php?cat='.$data['id'].'">'.$data['nom'].'</a></strong></p>';
				}
				else {
					echo '<a href="index.php?cat='.$data['id'].'">'.$data['nom'].'</a></p>';
				}
				$niveau += 1;
				AfficherEnfants($data['id'], $selection);
				$niveau -= 1;
			}
		}
	
		AfficherEnfants($categorie, $selection);
		echo '</div>';
	}
}

// Génère un menu horizontal <div id="menu"> qui comporte uniquement les
// catégories principales.
// Paramètres : la catégorie à sélectionner (optionnel)

function GenererMenuSimple($selection='') {
	echo '<div id="menu">';
	$req = CategorieOuvrir(0, True);
	while ($data = mysql_fetch_assoc($req)) {
		// Affichage dans le menu, avec sélection de la catégorie ouverte (sauf catégories spéciales)
		if ($selection == $data['id']) {
			echo '<a href="index.php?cat='.$data['id'].'" class="oui">'.$data['nom'].'</a> ';
		}
		else {
			echo '<a href="index.php?cat='.$data['id'].'">'.$data['nom'].'</a> ';
		}
	}
	echo '</div>';
}

function GenererChampRecherche($contenu='') {
	echo '<form method="get" action="recherche.php"><p id="recherche">';
	echo '	<input type="text" name="req" value="'.stripslashes($contenu).'" />';
	echo '	<input type="submit" value="Ok" />';
	echo '</p></form>';
}

?>
