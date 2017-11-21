<!--
DÉPENDANCES ====================================================================

	- o_billets.php
	- o_categories.php
	- o_commentaires.php
	- o_droits.php
	- o_nombres.php
	
	- v_page.php
	
DÉPENDANCES ====================================================================
-->


<!doctype html>
<html>

<head>
	<?php GenererBaliseTitleHead($titre_blog); ?>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=yes" />
	<link rel="stylesheet" href="style/ecran.css" media="all">
	<link rel="stylesheet" href="style/ecran_index_couleurs.css" media="all">
</head>

<body>
	<?php
		// Titre
		GenererTitre($titre_blog);
		
		// Menu principal
		GenererMenuPrincipal($focus='tdb');
		
		echo '<h2>Billets</h2>';

		echo '<div id="menucat">';
		
			echo '<strong><a href="billet_editer.php?cat='.$_GET['cat'].'">Nouveau billet</a></strong> ';
			
			if (strpos($_SESSION['droits'], 'B') !== False) {
					
				echo '<strong><a href="categorie_editer.php">Nouvelle catégorie</a></strong> ';
			
				echo '&nbsp;&nbsp;&nbsp;';
		
				if ($_GET['cat'] > 0 and $_GET['cat'] != 0)
					echo '<a href="categorie_editer.php?cat='.$_GET['cat'].'">Modifier la catégorie</a> ';

				if ($_GET['cat'] == 0)
					echo '<a href="categorie_classer.php?cat=0">Classer les catégories principales</a> ';

				elseif (CategorieNombreEnfants($_GET['cat']) > 1)
					echo '<a href="categorie_classer.php?cat='.$_GET['cat'].'">Classer les éléments</a> ';

				if ($_GET['cat'] > 0 and CategoriesPrincipalesNombre() > 1)
					echo '<em><a href="categorie_supprimer.php?cat='.$_GET['cat'].'">Supprimer la catégorie</a></em>';
			}
			
		echo '</div>';
		
		echo '<div id="contenu">';
		
			// Arborescence
			echo '<div id="arbo">';
				if ($_GET['cat'] != 0)
					echo '<a href="index.php">[Tout]</a>';
				else
					echo '<strong><a href="index.php">[Tout]</a></strong>';
				GenererArbo($_GET['cat']);
			echo '</div>';


			echo '<div id="billets">';
			
				// Affichage du titre de catégorie
				if (CategorieNom($_GET['cat']) != '')
					echo '<div id="nomcategorie">'.CategorieNom($_GET['cat']).'</div>';
				else
					echo '<div id="nomcategorie">[Toutes les catégories]</div>';
				
				// Affichage des sous-catégories
				echo '<p class="ligne_dossiers">';
					if ($_GET['cat'] != 0)
						echo '<a href="index.php?cat='.CategorieParent($_GET['cat']).'"></a> ';
					while ($data = mysql_fetch_assoc($req_cat)) {
						if (strpos($_SESSION['droits'], 'B') === False
						and CategorieVerifierAutorisation($data['id'], $_SESSION['id']) != True) {
							$parametre = ' lectureseule';
						}
						else {
							$parametre = '';
						}
						echo '<a class="couleur_'.$data['couleur'].$parametre.'" href="index.php?cat='.$data['id'].'">'.$data['nom'].'</a> ';
					}
					if (mysql_num_rows($req_cat) < 1)
						echo 'Pas de sous-catégorie';
				echo '</p>';
		
				// Affichage des billets
				echo '<table class="liste_billets">';
				while ($data = mysql_fetch_assoc($req)) {
					echo '<tr>';

					echo '<td><a href="../billet.php?id='.$data['id'].'" target="_blank">Lien</a></td> ';
					
					if (strpos($_SESSION['droits'], 'A') !== False or BilletVerifierAutorisation($data['id'], $_SESSION['id']) == True) {
						echo '<td><em><a href="billet_supprimer.php?id='.$data['id'].'">✕</a></em></td> ';
						
						if (CommentairesNombre($data['id'], $nval=1) > 0)
							echo '<td><a href="commentaires.php?art='.$data['id'].'">Com : '.CommentairesNombre($data['id']).' ['.CommentairesNombre($data['id'], $nval=2).']</a></td> ';
						else
							echo '<td><a href="#" class="desactive">Com : 0 [0]</a></td> ';

						echo '<td><a class="art" href="billet_editer.php?id='.$data['id'].'">'.$data['titre'].'</a> '; 
					}
					else {
						echo '<td></td>';
						echo '<td></td>';
						echo '<td><a class="art" href="#">'.$data['titre'].'</a>';	
					}

					if (BilletVerifierProprietaire($data['id'], $_SESSION['id']) != True and BilletVerifierAutorisation($data['id'], $_SESSION['id']) == True)
						$coauteur = ', vous êtes co-auteur.';
					else
						$coauteur = '';
					
					if ($data['local'] == 1)
						$local = '<strong>[Non publié]</strong> ';
					else
						$local = '';
					
					if (BilletVerifierProprietaire($data['id'], $_SESSION['id']) == True)
						$auteur = 'Vous';
					else
						$auteur = ProfilNom($data['auteur']);
					
					echo '<br><span class="date">'.$local.$auteur.', '.date($format_date, $data['date']).' '.date($format_heure, $data['date']).$coauteur.'</span></td>';
					echo '</tr>';
				}
				echo '</table>';

				CompteurPagesWidget($billets_par_page_admin, BilletsNombreAdmin($_GET['cat']), $toujours=False, $prefixe='🗍 ');
			echo '</div>';
		
		echo '</div>';
	
	?>

</body>

</html>
