<?php

/*

POUR UTILISER CES FONCTIONS, LE FICHIER D'ENVOI DOIT CONTENIR LA STRUCTURE SUIVANTE :

<html>
	<head>
		<meta charset="UTF-8">
		<noscript><link rel="stylesheet" href="../style/message.css" media="all"></noscript>
	</head>
	<body>

*/



// GENERER MESSAGE ERREUR

// Génère un message d'erreur qui renvoie ensuite l'utilisateur
// Paramètres :
//   - $message : le message à afficher.
//   - $page : la page à afficher ensuite.

function GenererMessageErreur($message, $page) {
	echo '<script>alert("'.$message.'");</script>';
	echo '<script>location.href="'.$page.'"</script>';
}

function DemanderConfirmation($message, $pageoui, $pagenon, $sautlignes=False) {
	if ($sautlignes == True) {
		$message_js = str_replace(array("<br />","<br/>","<br>"), '\n', $message);
	}
	else {
		$message_js = str_replace(array("<br />","<br/>","<br>"), ' ', $message);
	}
	$message_js = strip_tags($message_js);
	echo '<script>
		if (confirm("'.$message_js.'")) {
			location.href="'.$pageoui.'";
		}
		else {
			location.href="'.$pagenon.'";
		}
		</script>';
}

?>
