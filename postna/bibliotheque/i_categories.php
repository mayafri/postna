<?php

// ECRIRE CATEGORIE
// Écrit ou met à jour une catégorie (selon l'existence de ID ou non)

function CategorieEcrire($id, $nom, $parent, $vitrine, $auteurs, $couleur, $entete) {
	$nb_cat = mysql_num_rows(mysql_query('SELECT * FROM '.$GLOBALS['base'].'_categories WHERE id='.$id));
	
	if ($nb_cat > 0)
		mysql_query('UPDATE '.$GLOBALS['base'].'_categories SET nom="'.$nom.'", parent='.$parent.', vitrine='.$vitrine.', auteurs="'.$auteurs.'", couleur='.$couleur.', entete="'.$entete.'" WHERE id='.$id);
	else
		mysql_query('INSERT INTO '.$GLOBALS['base'].'_categories (id, nom, parent, vitrine, auteurs, couleur, entete) VALUES ('.$id.', "'.$nom.'", '.$parent.', '.$vitrine.', "'.$auteurs.'", '.$couleur.', "'.$entete.'")');	
}

// SUPPRIMER CATEGORIE
// Supprime une catégorie
// Paramètre : $categorie (obligatoire) : le numéro de la catégorie

function CategorieSupprimer($categorie) {
	mysql_query('DELETE FROM '.$GLOBALS['base'].'_categories WHERE id='.$categorie);
}

// CLASSER CATEGORIE
// Classe la catégorie
// Paramètres : $categorie (obligatoire) : le numéro de la catégorie
//				$position (obligatoire) : la position voulue

function CategorieClasser($categorie, $position) {
	mysql_query('UPDATE '.$GLOBALS['base'].'_categories SET classement='.$position.' WHERE id='.$categorie);
}

// SUPPRIMER ARBO
// Supprime tout le contenu d'une catégorie
// Paramètre : $parent (obligatoire) : le numéro de la catégorie à vider

$niveau = 0;
function CategorieVider($parent) {
	global $niveau;
	
	// Suppression des commentaires
	$req = mysql_query('SELECT id FROM '.$GLOBALS['base'].'_billets WHERE cat='.$parent);
	while ($data = mysql_fetch_array($req)) {
		mysql_query('DELETE FROM '.$GLOBALS['base'].'_commentaires WHERE billet='.$data['id']);
	}
	
	// Puis des billets
	mysql_query('DELETE FROM '.$GLOBALS['base'].'_billets WHERE cat='.$parent);
	
	// Puis ensuite des catégories
	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_categories WHERE parent='.$parent.' ORDER BY -classement DESC, nom');
	while ($data = mysql_fetch_assoc($req)) {
		mysql_query('DELETE FROM '.$GLOBALS['base'].'_categories WHERE id='.$data['id']);
		$niveau += 1;
		CategorieVider($data['id']);
		$niveau -= 1;
	}
}

?>

