<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>

<?php

include('../session.php');
Session('..');

if (isset($_GET['mode']))
	$mode = $_GET['mode'];
else
	$mode = '';
	
if (isset($_GET['type']))
	$type = $_GET['type'];
else
	$type = '';
	

echo ('<script>location.href="../fichiers.php?mode='.$mode.'&type='.$type.'&url='.$_SESSION['position_dossier'].'"</script>');

?>
