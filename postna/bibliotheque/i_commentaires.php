<?php

function CommentaireEcrire($id, $id_billet, $pseudo, $contenu, $parent, $valider=False) {
	$parametre = '';
	$val = '';
	if ($valider == True) {
		$parametre = ', 1';
		$val = ', val';
	}
	mysql_query('INSERT INTO '.$GLOBALS['base'].'_commentaires (id, billet, date, pseudo, com, parent'.$val.') VALUES ('.$id.', '.$id_billet.', UNIX_TIMESTAMP(), "'.$pseudo.'", "'.$contenu.'", "'.$parent.'"'.$parametre.')');
}

function CommentaireSupprimer($id) {
	$req = mysql_query('SELECT * FROM '.$GLOBALS['base'].'_commentaires WHERE parent='.$id);
	if (mysql_num_rows($req) > 0) {
		while ($data = mysql_fetch_array($req)) {
			CommentaireSupprimer($data['id']);
			mysql_query('DELETE FROM '.$GLOBALS['base'].'_commentaires WHERE id='.$data['id']);
		}
	}
	mysql_query('DELETE FROM '.$GLOBALS['base'].'_commentaires WHERE id='.$id);
}

function CommentaireValider($id) {
	mysql_query('UPDATE '.$GLOBALS['base'].'_commentaires SET val=1 WHERE id='.$id);
}

?>
