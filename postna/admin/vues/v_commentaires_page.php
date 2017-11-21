<!--
DÉPENDANCES ====================================================================

	- o_billets.php
	- o_commentaires.php
	
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
	?>

	<h2>Commentaires</h2>
	
	<div id="menucat">
		<?php
		echo '<a href="../billet.php?id='.$_GET['art'].'" target="blank_">Voir le billet</a> ';
		if (CommentairesNombre($billet=$_GET['art'], $nval=0) > 0) {
			echo '<em><a href="envois/e_commentaires_suppr.php?art='.$_GET['art'].'">Supprimer tout</a></em> ';
		}
		if (CommentairesNombre($billet=$_GET['art'], $nval=2) > 0) {
			echo '<em><a href="envois/e_commentaires_suppr.php?art='.$_GET['art'].'&nval=True">Supprimer les non-validés</a></em> ';
			echo '<strong><a href="envois/e_commentaires_val.php?art='.$_GET['art'].'">Valider tout</a></p></strong>';
		}
		?>
	</div>

	<div id="contenu">
	<?php	
		function BoucleRecursiveCommentaires($parent, $ordre, $format_date, $format_heure) {
			$req = CommentairesLire($_GET['art'], 1, $parent, $ordre);
			while ($data = mysql_fetch_assoc($req)) {
				if ($data['val'] == 0) {
					echo '<div class="com_nval"><p>';
					echo '<p><strong><a href="envois/e_commentaires_val.php?id='.$data['id'].'">Valider</a></strong> ';
				}
				else {
					echo '<div class="com"><p>';
				}
				echo '<em><a href="envois/e_commentaires_suppr.php?id='.$data['id'].'">✕</a></em> ';
				echo 'Par <em>'.$data['pseudo'].'</em>, le '.date($format_date, $data['date']).' à '.date($format_heure, $data['date']).'</p>';
				echo '<p><strong>'.$data['com'].'</strong></p>';
				
				BoucleRecursiveCommentaires($data['id'], 'ASC', $format_date, $format_heure);
				
				echo '</div>';
			}
		}
		BoucleRecursiveCommentaires(0, 'ASC', $format_date, $format_heure);
	?>
	</div>

</body>

</html>
