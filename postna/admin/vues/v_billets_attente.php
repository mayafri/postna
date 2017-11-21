<!--
DÉPENDANCES ====================================================================

	- o_billets.php
	
	- v_page.php
	
DÉPENDANCES ====================================================================
-->


<!doctype html>
<html>

<head>
	<?php GenererBaliseTitleHead($titre_blog); ?>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style/ecran.css" media="all">
</head>

<body>

	<?php
	GenererTitre($titre_blog);
	GenererMenuPrincipal($focus='billets_attente');
	?>

	<h2>Billets en attente de publication</h2>

	<div id="contenu">
	<?php
		echo '<table class="liste_billets">';
		while ($data = mysql_fetch_assoc($req)) {
			if ($data['local'] == 1 and $data['auteur'] == $_SESSION['id']) {
				echo '<tr>';
					echo '<td><a href="../billet.php?id='.$data['id'].'" target="_blank">Lien</a></td> ';
					echo '<td><a href="index.php?cat='.$data['cat'].'">Catégorie</a></td> ';
					echo '<td><strong><a href="envois/e_billet_publier.php?id='.$data['id'].'">Publier</a></td></strong> ';
					echo '<td><a class="art" href="billet_editer.php?id='.$data['id'].'">'.$data['titre'].'</a> ';
					echo '<br><span class="date">'.date($format_date, $data['date']).' '.date($format_heure, $data['date']).'</span></td>';
				echo '</tr>';
			}
		}
		echo '</table>';
	?>
	</div>

</body>

</html>
