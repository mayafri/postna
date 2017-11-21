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
	<link rel="stylesheet" href="style/ecran_fixe.css" media="all">
</head>

<body>

	<?php
	GenererTitre($titre_blog);
	GenererMenuRetourDroits();
	?>
	
	<h2>Nouvel utilisateur</h2>

	<div id="contenu">
	
	<form action="envois/e_droits_util_nv.php" method="post">
		<table>
			<tr><td>Identifiant : </td><td><input type="text" name="pseudo" value="" /></td></tr>
			<tr><td>Nom : </td><td><input type="text" name="nom" value="" /></td></tr>
			<tr><td>Courrier électronique : </td><td><input type="text" name="mail" value="" /></td></tr>
			<tr><td colspan='2'><em>C'est par le biais de l'adresse de courrier électronique que le nouveau membre recevra son mot de passe généré aléatoirement.</em></td></tr>
		</table>
		
		<p class="boutons">
			<strong><input type="submit" value="Valider" /></strong>
		</p>
	</form>
	</div>

</body>

</html>
