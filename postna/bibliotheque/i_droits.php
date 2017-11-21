<?php

function ProfilChangerAdmin($id, $pseudo, $nom, $droits) {
	mysql_query('UPDATE '.$GLOBALS['base'].'_auteurs SET pseudo="'.$pseudo.'", nom="'.$nom.'", droits="'.$droits.'" WHERE id='.$id);
}

// UTILISATEUR CRÉER
// Attention, le mot de passe doit être haché (password_hash)

function ProfilCreer($id, $pseudo, $mail, $nom, $pass, $droits) {
	mysql_query('INSERT INTO '.$GLOBALS['base'].'_auteurs (id, pseudo, mail, nom, pass, droits) VALUES ('.$id.', "'.$pseudo.'", "'.$mail.'", "'.$nom.'", "'.$pass.'", "'.$droits.'")');
}

function ProfilSupprimer($id) {
	mysql_query('DELETE FROM '.$GLOBALS['base'].'_auteurs WHERE id='.$id);
}

function ProfilSupprimerContenu($id) {
	mysql_query('DELETE FROM '.$GLOBALS['base'].'_billets WHERE auteur='.$id);
	mysql_query('DELETE FROM '.$GLOBALS['base'].'_categories WHERE auteur='.$id);
	mysql_query('DELETE FROM '.$GLOBALS['base'].'_commentaires WHERE auteur='.$id);
}

function ProfilAttribuerContenu($ancien, $nv) {
	mysql_query('UPDATE '.$GLOBALS['base'].'_billets SET auteur='.$nv.' WHERE auteur='.$ancien);
	mysql_query('UPDATE '.$GLOBALS['base'].'_categories SET auteur='.$nv.' WHERE auteur='.$ancien);
	mysql_query('UPDATE '.$GLOBALS['base'].'_commentaires SET auteur='.$nv.' WHERE auteur='.$ancien);
}

?>

