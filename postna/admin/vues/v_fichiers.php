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
	<link rel="stylesheet" href="style/fichiers.css" media="all">
</head>

<body>

	<?php
	GenererTitre($titre_blog);
	GenererMenuPrincipal($focus='fichiers');
	?>
	
	<h2>Documents</h2>
	
	<div id="menucat">
		<?php
		if (strpos($_SESSION['droits'], 'C') !== False) {
			echo '<strong><a href="#" onclick="window.open(\'fichiers_actions.php?action=dossier&elem='.$dossier_absolu.'\', \'\', \'width=450,height=400,scrollbars=yes,location=no\')">Nouveau dossier</a></strong> ';
			echo '<strong><a href="#" onclick="window.open(\'fichiers_actions.php?action=uploader&elem='.$dossier_absolu.'\', \'\', \'width=450,height=400,scrollbars=yes,location=no\')">Ajouter un fichier ici</a></strong> ';
		}
		?>
	</div>

	<div id="contenu">
	<?php
	// Barre d'adresse
	
	echo '<p class="boutons">';
	
	if ($_GET['url'] != '')
		echo '<a href="fichiers.php?url='.$parent.'">  Remonter</a> ';
	else
		echo '<a href="#" class="desactive">  Remonter</a> ';
	
	if ($_GET['url'] == '')
		echo '<strong>Espace libre : '.$espace.' Go</strong>';
	else
		echo '<strong> /'.$_GET['url'].'</strong>';
	echo '</p>';
	
	// Boucles d'affichage des éléments
	
	echo '<div id="elements_dossier">';
	
	foreach ($documents as $element) {
		if (is_dir($dossier.$element)
			and $element != '.'
			and $element != '..'
			and substr($element, 0, 1) != '.') {
			
			echo '<div class="elem_dossier"><a href="fichiers.php?url='.$_GET['url'].$element.'/">
			<img src="style/dossier.png" alt="" /><br />'.$element.'</a></div>';
			
			if (strpos($_SESSION['droits'], 'C') !== False) {
				MenuElement($dossier_absolu.$element.'/');
			}
		}
	}
		
	foreach ($documents as $element) {
		if (is_file($dossier.$element) and substr($element, 0, 1) != '.') {	
			// Extension
			$ext = strrpos($element, '.');
			$ext = strtolower(substr($element, $ext));

			// On affiche la miniature si possible, sinon une icone
			if (is_file($dossier.'.min/'.$element)) {
				echo '<div class="elem_dossier"><a href="'.$dossier.$element.'" target="blank_">
				<img src="'.$dossier.'.min/'.$element.'" alt="" /><br />'.$element.'</a></div>';
			}
			else {
				echo '<div class="elem_dossier">';
					if (strpos($ext, '.') !== False)
					echo '<a href="'.$dossier.$element.'" target="blank_"><div class="extension">'.$ext.'</div><img src="style/fichier.png" alt="" /><br />'.$element.'</a>';
				echo '</div>';
			}
			if (strpos($_SESSION['droits'], 'C') !== False) {
				MenuElement($dossier_absolu.$element);
			}
		}
	}
	
	echo '</div>';	
	?>
	
	</div>

</body>

</html>
