<?php

// ECRIRE BILLET
// Écrit ou met à jour un billet (selon l'existence de ID ou non)

function BilletEcrire($id, $titre, $contenu, $cat, $auteur, $tags, $coauteurs, $local) {
	$nb_billets = mysql_num_rows(mysql_query('SELECT * FROM '.$GLOBALS['base'].'_billets WHERE id='.$id));
	
	if ($nb_billets > 0) {
		mysql_query('UPDATE '.$GLOBALS['base'].'_billets SET titre="'.$titre.'", contenu="'.$contenu.'", cat='.$cat.', auteur='.$auteur.', tags="'.$tags.'", coauteurs="'.$coauteurs.'", local='.$local.' WHERE id='.$id);
		mysql_query('UPDATE '.$GLOBALS['base'].'_commentaires SET auteur='.$auteur.', coauteurs="'.$coauteurs.'" WHERE billet='.$id);	
	}
	else {
		mysql_query('INSERT INTO '.$GLOBALS['base'].'_billets (id, date, titre, contenu, cat, auteur, tags, coauteurs, local) VALUES ('.$id.', UNIX_TIMESTAMP(), "'.$titre.'", "'.$contenu.'", '.$cat.', '.$auteur.', "'.$tags.'", "'.$coauteurs.'", '.$local.')');
	}
}

// SUPPRIMER BILLET
// Supprime un billet de la base avec ses commentaires.
// Paramètre : $id (obligatoire) : ID du billet à supprimer.

function BilletSupprimer($id) {
	mysql_query('DELETE FROM '.$GLOBALS['base'].'_billets WHERE id='.$id);
	mysql_query('DELETE FROM '.$GLOBALS['base'].'_commentaires WHERE billet='.$id);
}

?>
