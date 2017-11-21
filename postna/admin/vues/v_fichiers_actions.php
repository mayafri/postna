<!--
DÉPENDANCES ====================================================================

	- o_fichiers.php
	
	- v_page.php
	
DÉPENDANCES ====================================================================
-->


<!doctype html>
<html>

<head>
	<title><?php echo $fonction; ?></title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style/ecran.css" media="all">
	<link rel="stylesheet" href="style/fichiers.css" media="all">
	<link rel="stylesheet" href="style/fichiers_popup.css" media="all">
</head>

<body>

	<?php	
	echo '<h2>'.$fonction.'</h2>';
	echo '<h3> « '.$element.' » </h3>';
	?>

	<div id="contenu">
		<?php
		if (substr($_GET['elem'], -1) == '/') {
			$chemin = substr($_GET['elem'], 0, -1);
		}
		else {
			$chemin = $_GET['elem'];
		}
		$position = strrpos($chemin, '/', 0);
		$nom_fichier = substr($chemin, $position+1);
		?>
		
		<form enctype="multipart/form-data" action="envois/e_fichiers_actions.php?action=<?php echo $_GET['action']; ?>&mode=<?php echo $_GET['mode']; ?>&type=<?php echo $_GET['type']; ?>&elem=<?php echo $_GET['elem']; ?>" method="post">
	
		<?php
		if ($_GET['action'] == 'renommer') {
			echo '<p>Nouveau nom : <input type="text" name="nom" value="'.$nom_fichier.'" /></p>';
		}
		else if ($_GET['action'] == 'uploader') {
			?>
			<script>
			function commande() {
				var chargement = document.getElementById('chargement');
				chargement.innerHTML = 'Chargement...';
			}
			</script>
			<?php
			echo '<p><input name="userfile" type="file" /></p>';
		}
		else if ($_GET['action'] == 'dossier') {
			echo '<p>Nom du nouveau dossier : <input type="text" name="nom" /></p>';
		}
		else if ($_GET['action'] == 'deplacer') { ?>
			<p>Destination du déplacement : <select name="cible"><?php echo FichiersArborescenceWidgetOption($_SESSION['racine'].'/'.$_SESSION['racine_doc'], $_GET['elem']); ?>'</select></p>
		<?php }
		else if ($_GET['action'] == 'copier') { ?>
			<p>Nouveau nom : <input type="text" name="nom" value="<?php echo CheminExtraireNom($_GET['elem']); ?>" /></p>	
			<p>Destination de la copie : <select name="cible"><?php echo FichiersArborescenceWidgetOption($_SESSION['racine'].'/'.$_SESSION['racine_doc'], $_GET['elem']); ?>'</select></p>
		<?php } ?>
	
		<p class="boutons">
			<?php
			if (isset($_GET['mode']) and $_GET['mode'] == 'editeur')
				echo '<a href="fichiers.php?mode=editeur&type='.$_GET['type'].'&url='.$_SESSION['position_dossier'].'">« Retour</a>';
			?>
			<strong><input type="submit" value="Valider" onclick="commande()" /></strong>
		</p>
	
		</form>
		
		<div id="chargement"></div>
	</div>
</body>
</html>
