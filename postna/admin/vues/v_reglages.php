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
</head>

<body>

	<?php
	GenererTitre($titre_blog);
	GenererMenuPrincipal($focus='reglages');
	?>
	
	<h2>Réglages</h2>

	<div id="contenu">
	
	<form action="envois/e_reglages.php" method="post">
		<table>
			<tr><td colspan='2'><strong>Paramètres généraux</strong></td></tr>
			
			<tr><td>Titre du blog : </td><td><input type="text" name="titre_blog" value="<?php echo $titre_blog; ?>" /></td></tr>
			<tr><td>Thème :</td>
			<td><select name="theme_blog">
				<?php GenererThemes($theme_blog); ?>
			</select></td></tr>
			<tr><td>Page d'accueil :</td>
			<td><select name="redirection_index">
				<option value="">[Automatique : derniers billets]</option>
				<?php GenererRacineArbo($redirection_index); ?>
			</select></td></tr>
			<tr><td>Nombre de billets par page :</td>
			<td><select name="billets_par_page">
				<?php
				for ($i=5; $i<=20 ; $i++) {
					if ($i == $billets_par_page)
						echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
					else
						echo '<option value="'.$i.'">'.$i.'</option>';
				}
				 ?>
			</select></td></tr>
			
			<tr><td colspan='2'></td></tr>
			<tr><td colspan='2'><strong>Date et heure</strong></td></tr>
			
			<tr><td>Format de la date :</td>
			<td><select name="format_date">
				<?php GenererListeDate($format_date); ?>
			</select></td></tr>
			<tr><td>Format de l'heure :</td>
			<td><select name="format_heure">
				<?php GenererListeHeure($format_heure); ?>
			</select></td></tr>

			<tr><td colspan='2'></td></tr>
			<tr><td colspan='2'><strong>Commentaires</strong></td></tr>

			<tr><td>Activer les commentaires : </td><td><?php CaseCocher("commentaires_autoriser", $commentaires_autoriser); ?></td></tr>
			<tr><td>Commentaires soumis à validation : </td><td><?php CaseCocher("commentaires_valider", $commentaires_valider); ?></td></tr>
			<tr><td>Afficher la date des billets : </td><td><?php CaseCocher("date_afficher", $date_afficher); ?></td></tr>
		</table>

		<p class="boutons">
			<strong><input type="submit" value="Valider" /></strong>
		</p>
	</form>
	</div>

</body>

</html>
