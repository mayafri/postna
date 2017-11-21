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
	<script src="ckeditor/ckeditor.js"></script>
</head>

<body>

	<?php
	GenererTitre($titre_blog);
	GenererMenuRetour();
	?>
	<h2>Supprimer un billet</h2>
	
	<form action="envois/e_billet_supprimer.php?id=<?php echo $_GET['id']; ?>" method="post">
	
		<div id="menucat">
			<input disabled="disabled" type="text" name="titre" value="<?php echo $data['titre']; ?>" />
		</div>
	
		<div id="contenu">
			<div id="billet_g">
				<textarea disabled="disabled" class="ckeditor" name="contenu"><?php echo $data['contenu'] ?></textarea>
			</div>
			<div id="billet_d">
				<p><strong>Catégorie :</strong></p>
				<p><select disabled="disabled" name="menu_cat">
					<?php GenererArboForm($data['cat']); ?>
				</select></p>
				
				<p><strong>Auteur :</strong></p>
				<p><select disabled="disabled" id="menu_auteurs" name="menu_auteurs">
					<?php GenererListeAuteurs($data['auteur']); ?>
				</select></p>
				
				<?php if (strpos($_SESSION['droits'], 'A') !== False or BilletVerifierProprietaire($data['id'], $_SESSION['id']) == True) { ?>
					<p><strong>Co-auteurs :</strong></p>
					<p><?php GenererCasesCoauteurs($data['coauteurs'], 'disabled="disabled"'); ?></p>	
				<?php } ?>
			
				<p><strong>Étiquettes :</strong></p>
				<p><textarea disabled="disabled" name="tags"><?php echo $data['tags']; ?></textarea></p>
				<p><em>Séparez les étiquettes par des espaces.</em></p>
			
				<p><strong>Publication :</strong></p>
				<p><?php CaseCocher("local", $data['local'], 'disabled="disabled"'); ?><span id="texte_case">Ne pas publier</span></p>

				<p><strong>Actions :</strong></p>
				<em><input type="submit" value="Supprimer le billet définitivement" /></em>
			</div>
		</div>
	
	</form>

</body>

</html>
