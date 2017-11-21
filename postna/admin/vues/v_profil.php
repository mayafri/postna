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
	GenererMenuPrincipal($focus='profil');
	?>
	
	<h2>Profil utilisateur</h2>

	<div id="contenu">
	
	<form action="envois/e_profil.php" method="post">
		<table>
			<tr><td colspan='2'><strong>Modifier mon identité</strong></td></tr>
			
			<?php
			if (strpos($_SESSION['droits'], 'D') !== False)
				$disabled = '';
			else
				$disabled = 'disabled="disabled"';
			?>
			<tr><td>Identifiant : </td><td><input <?php echo $disabled; ?> type="text" name="pseudo" value="<?php echo $_SESSION['pseudo']; ?>" /></td></tr>
			<tr><td>Nom : </td><td><input <?php echo $disabled; ?> type="text" name="nom" value="<?php echo $_SESSION['nom']; ?>" /></td></tr>
			<tr><td>Adresse électronique : </td><td><input type="text" name="mail" value="<?php echo $_SESSION['mail']; ?>" /></td></tr>
			<tr><td colspan='2'><em>L'identifiant n'est utile que pour la connexion, alors que le nom apparaît sur toutes vos publications. L'adresse de courrier électronique est nécessaire en cas de perte du mot de passe, pour qu'un nouveau puisse être généré.</em></td></tr>
			
			<tr><td colspan='2'></td></tr>
			
			<tr><td colspan='2'><strong>Modifier mon mot de passe</strong></td></tr>
			<tr><td>Ancien mot de passe : </td><td><input type="password" name="pass_anc" autocomplete="off" /></td></tr>
			<tr><td>Nouveau mot de passe : </td><td><input type="password" name="pass_nv" autocomplete="off" /></td></tr>
			<tr><td>Nouveau mot de passe<br>(confirmation) : </td><td><input type="password" name="pass_nv2" autocomplete="off" /></td></tr>
			<tr><td colspan='2'><em>Un mot de passe très sûr est long ; il contient minuscules, majuscules, chiffres, ponctuation et caractères spéciaux (&£%@~ß¬ ...).</em></td></tr>
		</table>
		
		<p class="boutons">
			<strong><input type="submit" value="Valider" /></strong>
		</p>
	</form>
	</div>

</body>

</html>
