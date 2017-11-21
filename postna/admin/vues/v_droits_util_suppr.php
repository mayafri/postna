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
	
	<h2>Supprimer l'utilisateur <?php echo ProfilNom($_GET['id']); ?> (<?php echo ProfilPseudo($_GET['id']); ?>)</h2>

	<div id="contenu">
		<form action="envois/e_droits_util_suppr.php?id=<?php echo $_GET['id']; ?>" method="post">
			<p>À qui définir la propriété du contenu créé par <?php echo ProfilNom($_GET['id']); ?> ?</p>
			<select name="nouv_prop">
				<option value="personne">[Personne : tout supprimer]</option>
				<?php
				$req = ProfilsLire();
				while ($data = mysql_fetch_array($req)) {
					if ($data['id'] != $_GET['id'])
						echo '<option value="'.$data['id'].'">'.$data['nom'].' ('.$data['pseudo'].')</option>';
				}
				?>
			</select>
			<p class="boutons">
				<em><input type="submit" value="Supprimer l'utilisateur DÉFINITIVEMENT" /></em>
			</p>
		</form>
	</div>

</body>

</html>
