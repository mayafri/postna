<?php
include('../../conf/init.php');
include('../../bibliotheque/o_profil.php');
include('../../bibliotheque/i_profil.php');

$req = ProfilLireDepuisPseudo(trim(mysql_real_escape_string($_POST['pseudo'])));
$data = mysql_fetch_assoc($req);

$pass = mysql_real_escape_string($_POST['pass']);

if (password_verify($pass, $data['pass'])) {
	if (strpos($data['droits'], 'F') !== False) {
		mysql_close();
		header('Location: ../login.php?erpass=4');
		exit();
	}
	
	session_start();
	session_regenerate_id(true);
	$_SESSION['id'] = $data['id'];
	$_SESSION['pseudo'] = $data['pseudo'];
	$_SESSION['nom'] = $data['nom'];
	$_SESSION['mail'] = $data['mail'];
	$_SESSION['droits'] = $data['droits'];
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	
	chdir('../../');
	$_SESSION['racine'] = getcwd();
	$_SESSION['racine_doc'] = 'documents/';
	chdir('admin/envois');
	
	if ($data['reinit'] != '')
		ProfilDefinirReinit($data['pseudo'], '');
	
	mysql_close();
	header('Location: ../index.php');
}
else {
	mysql_close();
	header('Location: ../login.php?erpass=1&pseudo='.$_POST['pseudo']);
}
?>
