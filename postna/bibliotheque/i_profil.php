<?php

function ProfilNouveauMotdepasse($pseudo, $pass) {
	$pass_hache = password_hash($pass, PASSWORD_DEFAULT);
	mysql_query('UPDATE '.$GLOBALS['base'].'_auteurs SET pass="'.$pass_hache.'" WHERE pseudo="'.$pseudo.'"');
}

function ProfilChanger($id, $pseudo, $nom, $mail, $pass='') {
	mysql_query('UPDATE '.$GLOBALS['base'].'_auteurs SET pseudo="'.$pseudo.'", nom="'.$nom.'", mail="'.$mail.'" WHERE id='.$id);
	if ($pass != '')
		ProfilNouveauMotdepasse($pseudo, $pass);
}

function ProfilDefinirReinit($pseudo, $cle) {
	mysql_query('UPDATE '.$GLOBALS['base'].'_auteurs SET reinit="'.$cle.'" WHERE pseudo="'.$pseudo.'"');
}

?>

