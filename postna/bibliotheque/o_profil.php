<?php

function ProfilLireDepuisPseudo($pseudo) {
	return mysql_query('SELECT * FROM '.$GLOBALS['base'].'_auteurs WHERE pseudo="'.$pseudo.'"');
}

function ProfilLireDepuisID($id) {
	return mysql_query('SELECT * FROM '.$GLOBALS['base'].'_auteurs WHERE id='.$id);
}

function ProfilVerifierDispoPseudo($pseudo) {
	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_auteurs WHERE pseudo="'.$pseudo.'"');
	$data = mysql_fetch_array($req);
	if ($data != NULL and $data['pseudo'] != $_SESSION['pseudo'])
		return True;
}

function ProfilVerifierDispoNom($nom) {
	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_auteurs WHERE nom="'.$nom.'"');
	$data = mysql_fetch_array($req);
	if ($data != NULL and $data['nom'] != $_SESSION['nom'])
		return True;
}

function ProfilLireReinit($pseudo) {
	$data = mysql_fetch_array(ProfilLireDepuisPseudo($pseudo));
	return $data['reinit'];
}

?>

