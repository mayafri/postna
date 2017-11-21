<?php

// Vérif de l'existence d'une catégorie (renvoie 0 ou 1)
// Si aucune catégorie n'est paramétrée en GET, la fonction renvoie 1
function CategorieExiste() {
	if ($_GET['cat'] != 0) {
		$cat = mysql_num_rows(mysql_query('SELECT id FROM '.$GLOBALS['base'].'_categories WHERE id='.$_GET['cat']));
		return $cat;
	}
	else {
		return 1;
	}
}

// CHARGER CATEGORIE
// Renvoie une réponse MySQL avec les informations concernant une catégorie.
// Paramètre : $cat (obligatoire) : numéro de la catégorie
function CategorieLire($cat) {
	return mysql_query('SELECT * FROM '.$GLOBALS['base'].'_categories WHERE id='.$cat);
}

// CHARGER CATEGORIES ENFANT
// Renvoie une réponse MySQL de toutes les catégories d'un parent avec respect d'ordre
// Paramètres :
// - $parent (obligatoire)
// - $special (optionnel, booléen) : si =True, les catégories
//   spéciales seront aussi renvoyées.

function CategorieOuvrir($parent, $special=False) {
	$limitespecial = '';
	if ($special == True)
		$limitespecial = ' AND id>0';
	return mysql_query('SELECT * FROM '.$GLOBALS['base'].'_categories WHERE parent='.$parent.$limitespecial.' ORDER BY -classement DESC, nom');
}

// Renvoie le nombre de catégories principales

function CategoriesPrincipalesNombre() {
	$req = mysql_query('SELECT id FROM '.$GLOBALS['base'].'_categories WHERE parent=0');
	return mysql_num_rows($req);
}

// Renvoie un booléen révélant si l'auteur est bien auteur de la catégorie
// Paramètres : l'ID de catégorie puis l'ID d'auteur
// Renvoie False sur la racine, ainsi que True sur les catégories spéciales (<0)

function CategorieVerifierAutorisation($cat, $auteur) {
	if ($cat > 0) {
		$req = mysql_query('SELECT auteurs FROM '.$GLOBALS['base'].'_categories WHERE id='.$cat);
		$data = mysql_fetch_array($req);

		if (strpos($data['auteurs'], $auteur) !== False) {
			return True;
		}
		else {
			return False;
		}
	}
	else if ($cat == 0) { // On interdit l'écriture de billets hors catégorie
		return False;
	}
	else if ($cat == -1) { // On autorise tout le monde à écrire dans le brouillon
		return True;
	}
}

// Retourne la catégorie initiale qui correspond à la catégorie entrée.
// Paramètres : la catégorie que l'on souhaite remonter

function CategorieParentRacine($cat) {
	$req = mysql_query('SELECT parent FROM '.$GLOBALS['base'].'_categories WHERE id='.$cat);
	$data = mysql_fetch_assoc($req);
	
	if ($data['parent'] != 0) {
		$reponse = CategorieParentRacine($data['parent']);
	}
	else {
		$reponse = $cat;
	}
	return $reponse;
}

// Retourne la catégorie parente de la catégorie entrée.
// Paramètres : la catégorie dont on veut le parent

function CategorieParent($cat) {
	$req = mysql_query('SELECT parent FROM '.$GLOBALS['base'].'_categories WHERE id='.$cat);
	$data = mysql_fetch_assoc($req);
	
	return $data['parent'];
}

// Retourne la catégorie d'un billet.
// Paramètres : l'identifiant d'un billet

function CategorieDuBillet($id) {
	$req = mysql_query('SELECT cat FROM '.$GLOBALS['base'].'_billets WHERE id='.$id);
	$data = mysql_fetch_assoc($req);

	return $data['cat'];
}

// Retourne 1 si la catégorie est en mode vitrine, sinon 0.
// Paramètres : l'identifiant d'une catégorie

function CategorieVerifierVitrine($categorie) {
	global $base;
	$req = mysql_query('SELECT vitrine FROM '.$GLOBALS['base'].'_categories WHERE id='.$categorie);
	$data = mysql_fetch_assoc($req);
	return $data['vitrine'];
}

// Retourne le nombre d'enfants d'une catégorie.
// Paramètres : l'identifiant d'une catégorie

function CategorieNombreEnfants($categorie) {
	return mysql_num_rows(mysql_query('SELECT id FROM '.$GLOBALS['base'].'_categories WHERE parent='.$categorie));
}

// Retourne le nom d'une catégorie.
// Paramètres : l'identifiant d'une catégorie

function CategorieNom($categorie) {
	$nom = mysql_fetch_assoc(mysql_query('SELECT nom FROM '.$GLOBALS['base'].'_categories WHERE id='.$categorie));
	return $nom['nom'];
}

?>
