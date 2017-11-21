<?php

// DÉPENDANCES =================================================================
//
//   - GenererMenuPrincipal : bibliotheque/o_commentaires.php
//							  bibliotheque/o_billets_attente.php
//
// DÉPENDANCES =================================================================



// GENERER MENU PRINCIPAL

// Génère le menu principal pour la console d'administration
// Prend en option le focus pour la page voulue
// - 'tdb' (pour le tableau de bord)
// - 'com_nval' (pour les commentaires non validés)
// - 'billets_attente'
// - 'reglages'
// - 'fichiers'
// - 'profil'

function GenererMenuPrincipal ($focus='') {
	echo '<div id="menu">';
	
	// Liens sections
	echo '<p>';
	
		if ($focus=='tdb') {echo '<strong><a href="index.php?cat='.$_SESSION['categorie'].'">Billets</a></strong> ';}
		else {echo '<a href="index.php?cat='.$_SESSION['categorie'].'">Billets</a> ';}

		if (strpos($_SESSION['droits'], 'c') !== False
		or strpos($_SESSION['droits'], 'C') !== False) {
			if ($focus=='fichiers') {echo '<strong><a href="fichiers.php">Documents</a></strong> ';}
			else {echo '<a href="fichiers.php">Documents</a> ';}
		}

		if (strpos($_SESSION['droits'], 'e') !== False
		or strpos($_SESSION['droits'], 'E') !== False) {
			if ($focus=='reglages') {echo '<strong><a href="reglages.php">Réglages</a></strong> ';}
			else {echo '<a href="reglages.php">Réglages</a> ';}
		}
	
		if (strpos($_SESSION['droits'], 'E') !== False) {
			if ($focus=='droits') {echo '<strong><a href="droits.php">Droits</a></strong> ';}
			else {echo '<a href="droits.php">Droits</a> ';}
		}
	
		echo '<a href="../" target="_blank">Visiteur...</a> ';
		
		$nb_com_n_val = CommentairesNombre($billet='', $nval=2);
		if ($focus=='com_nval') {echo '<strong><a href="commentaires.php?art=nval"><strong>Commentaires à valider : '.$nb_com_n_val.'</strong></a></strong> ';}
		else if ($nb_com_n_val > 0) {
			echo '<a href="commentaires.php?art=nval"><strong>Commentaires à valider : '.$nb_com_n_val.'</strong></a> ';
		}

		$nb_billets_local = BilletNombreNonPublies();
		if ($focus=='billets_attente') {echo '<strong><a href="billets_attente.php"><strong>Billets en attente : '.$nb_billets_local.'</strong></a></strong> ';}
		else if ($nb_billets_local > 0) {
			echo '<a href="billets_attente.php"><strong>Billets en attente : '.$nb_billets_local.'</strong></a> ';
		}
		
	// Liens connexion
	echo '<p id="login">';	
	
		if ($focus=='profil') {echo '<strong><a href="profil.php">'.$_SESSION['nom'].' ('.$_SESSION['pseudo'].')</a></strong> ';}
		else {echo '<a href="profil.php">'.$_SESSION['nom'].' ('.$_SESSION['pseudo'].')</a> ';}
	
		echo '<a href="logout.php">Déconnexion</a>';
		
	echo '</p>';
	
	echo '</p></div>';
}

// GENERER MENU RETOUR

// Génère un menu de retour dans le style du menu principal

function GenererMenuRetour() {
	echo '<div id="menu">';
		echo '<p id="login">';	
			echo '<a href="logout.php">Déconnexion</a>';
		echo '</p>';
		echo '<a href="index.php?cat='.$_SESSION['categorie'].'">« Revenir au tableau de bord</a>';
	echo '</p></div>';
}

// Génère un menu de retour pour la page des fichiers

function GenererMenuRetourFichiers() {
	echo '<div id="menu">';
		echo '<p id="login">';	
			echo '<a href="logout.php">Déconnexion</a>';
		echo '</p>';
		echo '<a href="fichiers.php?url='.$_SESSION['position_dossier'].'">« Revenir au gestionnaire de fichiers</a>';
	echo '</p></div>';
}

// Génère un menu de retour pour la page des droits

function GenererMenuRetourDroits() {
	echo '<div id="menu">';
		echo '<p id="login">';	
			echo '<a href="logout.php">Déconnexion</a>';
		echo '</p>';
		echo '<a href="droits.php">« Revenir à la gestion des droits</a>';
	echo '</p></div>';
}

// GENERER TITRE

// Gégère le titre pour la console d'administration
// Nécessite le titre du blog en option

function GenererTitre ($titre) {
	echo '<h1>Postna : '.$titre.' | Attention : version de démonstration, les changements ne sont pas appliqués !</h1>';
}

// Gégère la balise HTML <title> pour la console d'administration
// Nécessite le titre du blog en option

function GenererBaliseTitleHead ($titre) {
	echo '<title>Postna : '.$titre.'</title>';
}

?>
