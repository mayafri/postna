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
	GenererMenuRetour();
	echo '<h2>Supprimer une catégorie : '.$data['nom'].'</h2>';

	echo '<div id="contenu">';

	echo '<p>Attention : si vous supprimez cette catégorie, vous
	supprimerez aussi définitivement tout ce qu\'elle contient.</p>';

	echo '<p class="boutons">';
	echo '<em><a href="envois/e_categorie_supprimer.php?cat='.$_GET['cat'].'">Supprimer la catégorie et tout son contenu</a></em>';
	echo '</p>';
	
	echo '</div>';
	?>

</body>

</html>
