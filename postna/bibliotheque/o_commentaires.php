<?php

// Révèle si le commentaire appartient au propriétaire donné
// Paramètre : $commentaire (obligatoire), $prop (obligatoire)

function CommentaireVerifierAutorisation($commentaire, $auteur) {
	if (strpos($_SESSION['droits'], 'A') !== False) {
		return True;
	}
	else {
		$req = mysql_query('SELECT billet FROM '.$GLOBALS['base'].'_commentaires WHERE id='.$commentaire);
		$data = mysql_fetch_array($req);
		
		$req = mysql_query('SELECT auteur, coauteurs FROM '.$GLOBALS['base'].'_billets WHERE id='.$data['billet']);
		$data = mysql_fetch_array($req);
		
		if ($data['auteur'] == $auteur or strpos($data['coauteurs'], $auteur) !== False)
			return True;
		else
			return False;
		}
}

// Récupère le nombre de commentaires
// Paramètres : - $billet : l'ID de l'billet (si vide alors compte tout)
//				- $nval : si 0, compte les validés
//						  si 1, compte les non-validés et les validés
//						  si 2, compte uniquement les non-validés

function CommentairesNombre($billet=0, $nval=0, $visiteur=False) {
	if ($billet != 0) {
		if ($nval == 0)
			$req = mysql_query('SELECT id FROM '.$GLOBALS['base'].'_commentaires WHERE billet='.$billet.' AND val=1');
		else if ($nval == 1)
			$req = mysql_query('SELECT id FROM '.$GLOBALS['base'].'_commentaires WHERE billet='.$billet);		
		else if ($nval == 2)
			$req = mysql_query('SELECT id FROM '.$GLOBALS['base'].'_commentaires WHERE billet='.$billet.' AND val=0');
	}
	else {
		if ($nval == 0)
			$req = mysql_query('SELECT id FROM '.$GLOBALS['base'].'_commentaires WHERE val=1');
		else if ($nval == 1)
			$req = mysql_query('SELECT id FROM '.$GLOBALS['base'].'_commentaires');		
		else if ($nval == 2)
			$req = mysql_query('SELECT id FROM '.$GLOBALS['base'].'_commentaires WHERE val=0');
	}
	
	$nombre = 0;
	while($data = mysql_fetch_array($req)) {
		if ($visiteur=True or CommentaireVerifierAutorisation($data['id'], $_SESSION['id']))
			$nombre++;
	}
	return $nombre;
}

// Récupère les commentaires
// Paramètres : - $billet : l'ID de l'billet (si vide alors compte tout)
//				- $nval : si 0, compte les validés
//						  si 1, compte les non-validés et les validés
//						  si 2, compte uniquement les non-validés
//				- $visiteur : si 1, ne prend pas en compte la vérif utilisateur
// Renvoie une réponse MySQL

function CommentairesLire($billet = '%', $nval=0, $parent='%', $ordre='ASC') {

	if ($nval == 2)
			return mysql_query('SELECT * FROM '.$GLOBALS['base'].'_commentaires WHERE val=0 AND parent LIKE "'.$parent.'" AND billet LIKE "'.$billet.'" ORDER BY date '.$ordre);
	else if ($nval == 1)
			return mysql_query('SELECT * FROM '.$GLOBALS['base'].'_commentaires WHERE parent LIKE "'.$parent.'" AND billet LIKE "'.$billet.'" ORDER BY date '.$ordre);
	else if ($nval == 0)
		return mysql_query('SELECT * FROM '.$GLOBALS['base'].'_commentaires WHERE val=1 AND parent LIKE "'.$parent.'" AND billet LIKE "'.$billet.'" ORDER BY date '.$ordre);
}

// Renvoie l'ID du billet auquel appartient un commentaire
// Paramètre : l'ID du commentaire

function BilletDuCom($commentaire) {
	$req = mysql_query('SELECT billet FROM '.$GLOBALS['base'].'_commentaires WHERE id='.$commentaire);
	$data = mysql_fetch_array($req);
	
	$toto = $data['billet'];
	
	return $toto;
}

?>
