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
	<meta name="viewport" content="width=device-width, user-scalable=yes" />
	<link rel="stylesheet" href="style/ecran.css" media="all">

	<?php if ($_GET['mode'] == 'interactif') { ?>
		<script src="ckeditor/ckeditor.js"></script>
	<?php } ?>
</head>

<body>

	<?php
	GenererTitre($titre_blog);
	GenererMenuRetour();
	
	if ($_SESSION['temp_billet_titre'] != '')
		$titre = $_SESSION['temp_billet_titre'];
		
	if ($_SESSION['temp_billet_contenu'] != '')
		$contenu = $_SESSION['temp_billet_contenu'];
	?>
	
	<h2><?php echo $type; ?> un billet</h2>
	
	<form id="formulaire" class="billet" action="envois/e_billet_editer.php?id=<?php echo $_GET['id']; ?>&mode=<?php echo $_GET['mode']; ?>" method="post">
	
	<div id="menucat">
		<input type="text" name="titre" value="<?php echo $titre; ?>" />
	</div>
	
	<div id="contenu">
		<div id="billet_g">
			<?php
			if ($_GET['mode'] == 'brut')
				include('vues/v_billet_editer_brut.php');
			if ($_GET['mode'] == 'interactif')
				include('vues/v_billet_editer_interactif.php');	
			?>
		</div>
		<div id="billet_d">
		
			<div class="elem">
			
				<?php if (strpos($_SESSION['droits'], 'A') === False) { ?>
				<script>
				function caseAction() {
					var liste = document.getElementById("menu_auteurs");
					var valeur = liste.options[liste.selectedIndex].value;
					if (valeur != <?php echo $cible_auteur; ?>) {
						document.getElementsByName("local")[0].checked = true;
						document.getElementById("texte_case").style.color = "gray";
					}
					else {
						document.getElementById("texte_case").style.color = "inherit";
					}
				}
				</script>
				<?php } ?>

				<p><strong>Mode d'édition :</strong></p>
				<?php
				if ($_GET['mode'] == 'interactif') {
					echo '<p><a href="billet_editer.php?id='.$_GET['id'].'&mode=brut">Brut</a>
					<a class="enfonce" href="billet_editer.php?id='.$_GET['id'].'&mode=interactif">Interactif</a></p>';
				}
				if ($_GET['mode'] == 'brut') {
					echo '<p><a class="enfonce" href="billet_editer.php?id='.$_GET['id'].'&mode=brut">Brut</a>
					<a href="billet_editer.php?id='.$_GET['id'].'&mode=interactif">Interactif</a></p>';
				}
				
				echo '<p><em>Attention, vous perdez les modifications non sauvées en cliquant sur ce bouton.</em></p>';
				?>
			
				<?php if ($_GET['id'] == '' or strpos($_SESSION['droits'], 'A') !== False or BilletVerifierProprietaire($data['id'], $_SESSION['id']) == True) { ?>
				
					<p><strong>Catégorie :</strong></p>
					<p><select name="menu_cat">
						<?php GenererArboForm($cible_arbo); ?>
					</select></p>
					
					<p><strong>Auteur :</strong></p>
					<p><select id="menu_auteurs" name="menu_auteurs">
						<?php GenererListeAuteurs($cible_auteur, $options='onclick="caseAction()"'); ?>
					</select></p>
					
					<p><strong>Co-auteurs :</strong></p>
					<p><?php GenererCasesCoauteurs($coauteurs); ?></p>
					
				<?php }
				
				else { ?>
					<p><strong>Catégorie :</strong></p>
					<p><select name="menu_cat" disabled="disabled">
						<?php GenererArboForm($cible_arbo); ?>
					</select></p>
				
					<p><strong>Auteur :</strong></p>
					<p><select name="menu_auteurs" disabled="disabled">
						<?php GenererListeAuteurs($cible_auteur); ?>
					</select></p>
				<?php } ?>
				
				<p><strong>Étiquettes :</strong></p>
				<p><textarea name="tags"><?php echo $tags; ?></textarea></p>
				<p><em>Séparez les étiquettes par des espaces.</em></p>
				
				<p><strong>Publication :</strong></p>
				<p><?php CaseCocher("local", $local, 'onclick="caseAction()"'); ?><span id="texte_case">Ne pas publier</span></p>
					
				<p class="boutons">
					<input name="sauver" type="submit" value="Sauvegarder" />
					<strong><input name="valider" type="submit" value="Valider" /></strong>
				</p>
				
			</div>
			
		</div>
	</div>
	
	</form>
	
	<?php
	$_SESSION['temp_billet_titre'] = '';
	$_SESSION['temp_billet_contenu'] = '';
	?>

</body>

</html>
