<?php

// Cette fonction nécessite o_categories.php

function BilletsLireRecursif($categorie, $limite, $billets_par_page) {
	if (BilletsNombreSimple() > 0) {
		$req = BilletsLire($categorie, False, $limite, $billets_par_page);
	}
	else {
		global $billets;
		function AffichageRecursif($index) {
			global $billets;
			$req = CategorieOuvrir($index);
		
			while ($data = mysql_fetch_array($req)) {
				$req_bi = BilletsLire($data['id']);
			
				if (CategorieParentRacine($data['id']) > 0) {
					while ($data_bi = mysql_fetch_array($req_bi)) {
						$billets = $billets.$data_bi['id'].' OR id=';
					}
					AffichageRecursif($data['id']);
				}
			}
			return $billets;
		}
		AffichageRecursif($categorie);
		
		$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_billets WHERE local=0 AND (id='.substr($billets, 0, -7).') ORDER BY date DESC LIMIT '.$limite.', '.$billets_par_page);
	}
	return $req;
}

// Récupère les billets de la page
// Paramètres : les variables $limite (défini en contrôleur) et $billets_par_page (de conf.php)
// Renvoie une réponse MySQL

function BilletsLire($cat=0, $special=True, $limite='', $billets='') {
	$creneau = ' LIMIT '.$limite.', '.$billets;
		
	if ($creneau == ' LIMIT , ')
		$creneau = '';

	if ($special != True)
		$special = 'local=0';
		$special2 = ' AND '.$special;

	if ($cat == 0)
		return mysql_query('SELECT * FROM '.$GLOBALS['base'].'_billets WHERE '.$special.' ORDER BY date DESC'.$creneau);
	else
		return mysql_query('SELECT * FROM '.$GLOBALS['base'].'_billets WHERE cat='.$cat.$special2.' ORDER BY date DESC'.$creneau);
}

// Renvoie un booléen si l'auteur est bien propriétaire du billet
// Paramètres : l'ID de billet puis l'ID d'auteur

function BilletVerifierProprietaire($billet, $auteur) {
	$req = mysql_query('SELECT auteur FROM '.$GLOBALS['base'].'_billets WHERE id='.$billet);
	$auteur_billet = mysql_fetch_array($req);

	if ($auteur_billet['auteur'] == $auteur) {
		return True;
	}
	else {
		return False;
	}
}

// Renvoie un booléen révélant si l'auteur est bien coauteur du billet
// Paramètres : l'ID de catégorie puis l'ID d'auteur
// Renvoie False sur la racine, ainsi que True sur les catégories spéciales (<0)

function BilletVerifierAutorisation($billet, $auteur) {
	if (BilletVerifierProprietaire($billet, $auteur)) {
		return True;
	}
	else {
		$req = mysql_query('SELECT coauteurs FROM '.$GLOBALS['base'].'_billets WHERE id='.$billet);
		$data = mysql_fetch_array($req);

		if (strpos($data['coauteurs'], $auteur) !== False) {
			return True;
		}
		else {
			return False;
		}
	}
}


// Fonction Lire Billet
// Renvoie un array
function BilletLire($billet) {
	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_billets WHERE id='.$billet);
	return mysql_fetch_assoc($req);
}

// Fonction de service

function CompteRecursif($index=0, $compte=0) {
	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_billets WHERE cat='.$index.' AND local=0');
	global $billets;
	$billets = $compte + mysql_num_rows($req);

	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_categories WHERE id>0 AND parent='.$index);

	while ($categories = mysql_fetch_assoc($req)) {
		if (mysql_num_rows($req) > 0)
			CompteRecursif($categories['id'], $compte=$billets);
		else
			return $billets;
	}
	return $billets;
}

// Compte le nombre de billets récursivement, excluant les spéciaux
// $cat : si non spécifié, sera $_GET['cat'], sinon la catégorie définie

function BilletsNombre($cat=0) {
	if ($cat == 0)
		$cat = $_GET['cat'];
		
	// Si nous sommes dans une catégorie
	if ($cat != 0) {
		$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_billets WHERE cat='.$cat.' AND cat>0 AND local=0');
		// Si cette catégorie est vide, on compte ses enfants
		if (mysql_num_rows($req) == 0)
			$nombre = CompteRecursif($cat);
		else
			$nombre = mysql_num_rows($req);
	}
	// Sinon, nous comptons tout
	else {
		$nombre = CompteRecursif();
	}
	return $nombre;
}

// Compte le nombre de billets d'une catégorie donnée ou sinon tout, incluant les spéciaux.

function BilletsNombreAdmin($cat=0) {
	if ($cat != 0)
		$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_billets WHERE cat='.$cat);
	else
		$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_billets');
	return mysql_num_rows($req);
}

// Compte le nombre de billets d'une catégorie donnée sinon de $_GET['cat'], excluant les spéciaux.

function BilletsNombreSimple($cat=0) {
	if ($cat == 0)
		$cat = $_GET['cat'];
		
	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_billets WHERE cat='.$cat.' AND cat>0 AND local=0');
	return mysql_num_rows($req);
}

// Renvoie le titre d'un billet.
// Paramètre : l'ID de billet
function BilletTitre($id) {
	$req = mysql_query('SELECT titre FROM '.$GLOBALS['base'].'_billets WHERE id='.$id);
	$data = mysql_fetch_assoc($req);
	return $data['titre'];
}

?>
