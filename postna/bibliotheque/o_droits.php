<?php

function ProfilsNombre() {
	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_auteurs');
	return mysql_num_rows($req);
}

function ProfilsLire() {
	return mysql_query('SELECT * FROM '.$GLOBALS['base'].'_auteurs ORDER BY pseudo');
}

// NOM AUTEUR
// Renvoie le nom d'un auteur
// Paramètre : l'ID d'un auteur

function ProfilNom($id) {
	$req = mysql_query('SELECT nom FROM '.$GLOBALS['base'].'_auteurs WHERE id='.$id);
	$data = mysql_fetch_assoc($req);
	return $data['nom'];
}

// PSEUDO AUTEUR
// Renvoie le pseudo d'un auteur
// Paramètre : l'ID d'un auteur

function ProfilPseudo($id) {
	$req = mysql_query('SELECT pseudo FROM '.$GLOBALS['base'].'_auteurs WHERE id='.$id);
	$data = mysql_fetch_assoc($req);
	return $data['pseudo'];
}

// AUTEUR BILLET
// Renvoie l'ID d'un auteur
// Paramètre : l'ID d'un billet

function BilletProfilID($id) {
	$req = mysql_query('SELECT auteur FROM '.$GLOBALS['base'].'_billets WHERE id='.$id);
	$data = mysql_fetch_assoc($req);
	return $data['auteur'];
}

function BilletProfilCoauteursID($id) {
	$req = mysql_query('SELECT coauteurs FROM '.$GLOBALS['base'].'_billets WHERE id='.$id);
	$data = mysql_fetch_assoc($req);
	return $data['coauteurs'];
}

?>

