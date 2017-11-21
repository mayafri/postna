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
	GenererMenuRetour()
	?>
	<h2>Organiser la catégorie</h2>
	
	<div id="contenu">
	<?php

	echo '<form action="envois/e_categorie_classer.php?cat='.$_GET['cat'].'" method="post">';
	while ($data = mysql_fetch_assoc($req)) {
		if ($data['id'] != -1) {
			echo '<p class="ligne_element"><input type="number" min="0" name="'.$data['id'].'" style="width:4em" value="'.$data['classement'].'" /> ';
			echo $data['nom'].'</p>';
		}
	}
	echo '<p class="boutons"><strong><input type="submit" value="Valider" /></strong></p>';
	echo '</form>';
	
	?>
	</div>

</body>

</html>
