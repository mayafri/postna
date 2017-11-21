<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style/ecran.css" media="all">
	<link rel="stylesheet" href="style/fichiers.css" media="all">
	<link rel="stylesheet" href="style/fichiers_popup.css" media="all">
	<title>Insérer une image</title>
	<style type="text/css">
	</style>
</head>

<body>
	<script>
	function Retour(toto) {
		toto = toto.substring(1); // On coupe le "../" en "./" pour le visiteur
		try {
			window.opener.CKEDITOR.tools.callFunction(0, toto);
			window.close();
		}
		
		finally {
			var texte_alternatif = document.getElementById('texte_alternatif');

			textarea = window.opener.document.getElementById('texte');
			toto = '<img src="'+toto+'" alt="'+texte_alternatif.value+'" />';
	
			var debut = textarea.selectionStart;
			var fin = textarea.selectionEnd;

			textarea.value = textarea.value.substring(0, debut)
			+ toto
			+ textarea.value.substring(fin, textarea.value.length);

			textarea.selectionStart = fin+toto.length;
			textarea.selectionEnd = fin+toto.length;

			textarea.focus();
			window.close();
		}
	}

	</script>
	
	<div id="alternatif">
		Texte alternatif : <input type="text" id="texte_alternatif" />
	</div>
	
	<?php
	if (!isset($_GET['type']))
	$_GET['type'] = '';
		
	// Barre d'adresse
	
	echo '<p>';
	if (strpos($_SESSION['droits'], 'C') !== False)
		echo '<p class="upload"><strong><a href="fichiers_actions.php?action=uploader&mode=editeur&type='.$_GET['type'].'&elem='.$dossier_absolu.'">+</a></strong> ';
		echo '<strong><a href="fichiers_actions.php?action=dossier&mode=editeur&type='.$_GET['type'].'&elem='.$dossier_absolu.'">D</a></strong></p> ';

		if ($_GET['url'] != '')
			echo '<a href="fichiers.php?mode=editeur&type='.$_GET['type'].'&url='.$parent.'"></a> ';
		else
			echo '<a href="#" class="desactive"></a> ';
	echo '</p>';
	echo '<p class="url">';	
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
			
			echo '<div class="elem_dossier"><a href="fichiers.php?mode=editeur&type='.$_GET['type'].'&url='.$_GET['url'].$element.'/">
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
				echo '<div class="elem_dossier"><a href="#" onclick="Retour(\''.$dossier.$element.'\')">
				<img src="'.$dossier.'.min/'.$element.'" alt="" /><br />'.$element.'</a></div>';
			}
			else {
				echo '<div class="elem_dossier">';
					if (strpos($ext, '.') !== False)
					echo '<a href="#" onclick="Retour(\''.$dossier.$element.'\')"><div class="extension">'.$ext.'</div><img src="style/fichier.png" alt="" /><br />'.$element.'</a>';
				echo '</div>';
			}
			if (strpos($_SESSION['droits'], 'C') !== False) {
				MenuElement($dossier_absolu.$element);
			}
		}
	}
	
	echo '</div>';	
	?>

</body>

</html>
