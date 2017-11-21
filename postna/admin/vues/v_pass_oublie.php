<!--
DÉPENDANCES ====================================================================

	- v_page.php
	
DÉPENDANCES ====================================================================
-->


<!doctype html>
<html>

<head>
	<?php GenererBaliseTitleHead($titre_blog); ?>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style/ecran.css" media="all">
	<link rel="stylesheet" href="style/ecran_login.css" media="all">
</head>

<body>
	<?php GenererTitre($titre_blog); ?>

	<div id="contenu">
		<p>Vous pouvez réinitialiser votre mot de passe,  un nouveau vous
		en sera envoyé par courrier électronique.</p>
		
		<p class="boutons">
		<a href="login.php?pseudo=<?php echo $_GET['pseudo']; ?>">« Annuler</a>
		<a href="envois/e_pass_oublie.php?pseudo=<?php echo $_GET['pseudo']; ?>">Réinitialiser le mot de passe</a>
		</p>

	</div>
</body>
</html>
