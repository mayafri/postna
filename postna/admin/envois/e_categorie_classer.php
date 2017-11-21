<html>
	<head>
		<meta charset="UTF-8">
	</head>
	<body>

<?php

include('../session.php');
Session('..');


header('location: ../index.php?cat='.$_SESSION['categorie']);

?>
