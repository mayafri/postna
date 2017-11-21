<?php

function Session($redir='.', $droit='') {
	session_start();
	
	// Si l'utilisateur n'est pas connecté, on le renvoie au login
	if (!isset($_SESSION['pseudo'])) {
		header('Location: '.$redir.'/login.php');
		exit();
	}
	
	// Si l'adresse IP change en cours de session, on déconnecte l'utilisateur
	if ($_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {
		header('Location: '.$redir.'/logout.php');
		exit();
	}
	
	// Si l'utilisateur n'a pas le droit pour accéder à la page
	if ($droit != '') {
		if(is_array($droit)) {
			foreach($droit as $elem) {
				if (strpos($_SESSION['droits'], $elem) === False) {
					header('Location: '.$redir.'/index.php');
					exit();
				}
			}		
		}
		else {
			if (strpos($_SESSION['droits'], $droit) === False) {
				header('Location: '.$redir.'/index.php');
				exit();
			}
		}
	}
}

?>

