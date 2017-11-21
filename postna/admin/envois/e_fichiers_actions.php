<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>

<?php

include('../session.php');
Session('..');

if (isset($_GET['type']))
	$type = $_GET['type'];
else
	$type = '';

if ($_GET['mode'] == 'editeur') {
	header('location: ../fichiers.php?mode=editeur&type='.$type.'&url='.$_SESSION['position_dossier']);
}
else {
	echo '<script>window.close();</script>';
}
?>
