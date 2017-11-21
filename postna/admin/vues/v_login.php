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

	<p id="logo"><img src="style/logo.png" alt="" /></p>

	<form action="envois/e_login.php" method="post">
		<table>
		<tr><td>Identifiant : </td><td><input type="text" name="pseudo" value="<?php echo $_GET['pseudo']; ?>" /></td></tr>
		<tr><td>Mot de passe : </td><td><input type="password" name="pass" /></td></tr>
		</table>
		<p class="boutons"><strong><input type="submit" value="Connexion" /></strong></p>
	</form>
	
	<?php
	if ($_GET['erpass'] == 1) {
		echo '<p><em>Identifiant ou mot de passe incorrect. </em>';
		
		if (trim($_GET['pseudo']) != '')
			echo '<a href="pass_oublie.php?pseudo='.$_GET['pseudo'].'">Mot de passe oublié ?</a>';
		echo '</p>';
	}
	
	elseif ($_GET['erpass'] == 2)
		echo '<p><em>Cliquez sur le lien envoyé par courrier électronique pour générer un nouveau mot de passe.</em></p>';
	
	elseif ($_GET['erpass'] == 3)
		echo '<p><em>Un nouveau mot de passe vous a été envoyé.</em></p>';
		
	elseif ($_GET['erpass'] == 4)
		echo '<p><em>La connexion vous est interdite.</em></p>';
	?>
	
	</div>

</body>
</html>
