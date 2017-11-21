<!--
DÉPENDANCES ====================================================================

	- v_page.php
	- v_widgets.php
	
DÉPENDANCES ====================================================================
-->


<!doctype html>
<html>

<head>
	<?php GenererBaliseTitleHead($titre_blog); ?>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style/ecran.css" media="all">
	<link rel="stylesheet" href="style/ecran_fixe.css" media="all">
	<link rel="stylesheet" href="style/ecran_index_couleurs.css" media="all">
</head>

<body>

	<?php
	GenererTitre($titre_blog);
	GenererMenuRetour()
	?>
	<h2>Nouvelle catégorie</h2>
	
	<div id="contenu">
	<form action="envois/e_categorie_editer.php" method="post">
	
	<table>
	<tr><td colspan=2><strong>Propriétés</td></strong></tr>
	<tr><td>Nom : </td>
	<td><input type="text" name="nom" value="" /></td></tr>
	
	<tr><td>Catégorie parente : </td>
	<td><select name="menu_cat">
		<?php echo $pasdeparent; ?>
		<?php GenererArboForm($_SESSION['categorie']); ?>
	</select></td></tr>
	
	<?php echo $avertissement_auteurrietaire; ?>
	
	<tr><td>Couleur de classement : </td>
	<td><select name="couleur">
		<?php GenererCouleurs() ?>
	</select></td></tr>	

	<tr><td colspan=2><?php CaseCocher("vitrine"); ?> Mode vitrine (ni commentaire, ni date, ni étiquette)</td></tr>
	
	<tr><td colspan=2></td></tr>
	
	<tr><td colspan=2><strong>Entête</td></strong></tr>
	<tr><td colspan=2><textarea name="entete" class="entete"></textarea></td></tr>

	<tr><td colspan=2></td></tr>
	
	<tr><td colspan=2><strong>Autorisations en écriture pour les billets</td></strong></tr>
	<?php GenererCasesAuteurs(); ?>
	
	</table>
	<p class="boutons"><strong><input type="submit" value="Valider" /></strong></p>

	</form>
	</div>

</body>

</html>
