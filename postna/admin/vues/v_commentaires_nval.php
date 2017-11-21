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
	GenererMenuPrincipal($focus='com_nval');
	?>

	<h2>Commentaires non validés</h2>
	
	<div id="menucat">
		<em><a href="envois/e_commentaires_suppr.php?nval=True">Supprimer tout</a></em>
		<strong><a href="envois/e_commentaires_val.php">Valider tout</a></strong>
	</div>
		
	<div id="contenu">
	<?php
	
	$req = CommentairesLire('%', 2, '%', 'DESC');

		while ($data = mysql_fetch_assoc($req)) {
			if (CommentaireVerifierAutorisation($data['id'], $_SESSION['id'])) {
				echo '<div class="com">';
				echo '<p><a class="art" href="commentaires.php?art='.$data['billet'].'" target="blank_">Billet : <em>'.BilletTitre($data['billet']).'</em></a></p>';
				echo '<p><strong><a href="envois/e_commentaires_val.php?id='.$data['id'].'&art=nval">Valider</a></strong> ';
				echo '<em><a href="envois/e_commentaires_suppr.php?id='.$data['id'].'&art=nval">✕</a></em> ';
				echo 'Par <em>'.$data['pseudo'].'</em>, le '.date($format_date, $data['date']).' à '.date($format_heure, $data['date']).'</p>';
				echo '<p><strong>'.$data['com'].'</strong></p>';
				echo '</div>';
			}
		}
	?>
	</div>
	
</body>
</html>

