<!--
DÉPENDANCES ====================================================================

	- o_billets.php
	- o_categories.php
	- o_nombres.php
	
	- v_elements.php
	
DÉPENDANCES ====================================================================
-->


<!doctype html>
<html>

<head>
	<?php
	echo '<title>'.$titre_blog.'</title>';
	echo '<meta charset="UTF-8">';
	include('themes/'.$theme_blog.'/inclusions.php');
	?>
</head>

<body>
<?php

// Génération du header
echo '<div id="header">';
	include('themes/'.$theme_blog.'/header.php');
	GenererChampRecherche();
	MenuPageIndex($categorie_initiale, $_GET['cat']);
echo '</div>';

echo '<div id="contenu">';
	echo '<div id="billets">';
	echo '<h2>Étiquette « '.htmlentities($_GET['tag']).' »</h2>';
	
	// Boucle d'affichage
	$iteration = 0; // On compte le nombre d'éléments ici, à cause du filtrage du tag
	while ($data = mysql_fetch_array($req)) {
	
		if (strpos($data['tags'], $_GET['tag']) !== False) {
			if ($iteration >= $limite and $iteration < $billets_par_page+$limite) {
		
				echo '<div class="bloc">';
			
					echo '<h3><a href="billet.php?id='.$data['id'].'">'.$data['titre'].'</a></h3>';
				
					echo '<div class="sous-titre">';
					
						// On vérifie si le mode vitrine est activé ou pas
						if (CategorieVerifierVitrine($data['cat']) == 0) {
							// On vérifie si les commentaires sont autorisés
							if ($commentaires_autoriser == True) { 
								$nb_com = CommentairesNombre($data['id'], 0, True);
								if ($nb_com > 1)
									echo '<a href="billet.php?id='.$data['id'].'#commentaires">'.$nb_com.' commentaires.</a> ';
								else
									echo '<a href="billet.php?id='.$data['id'].'#commentaires">'.$nb_com.' commentaire.</a> ';
							}
						}
					
						echo 'Ajouté le '.date($format_date, $data['date']).' à '.date($format_heure, $data['date']).'. ';
						echo ' Catégorie : <a href="index.php?cat='.$data['cat'].'">'.CategorieNom($data['cat']).'</a>.<br>';
						// Découpage puis affichage des tags
						$tags = explode(' ', $data['tags']);
						if (count($tags) > 1)
							echo 'Étiquettes :';
						else
							echo 'Étiquette :';
						foreach ($tags as $elem)
							echo ' <a href="recherche.php?tag='.$elem.'">'.$elem.'</a>';
						echo '.';
					echo '</div>';
				
					$extrait = strip_tags($data['contenu']);
					if (strlen($extrait) > 1000) {
						$extrait = substr($extrait, 0, 1000);
						$espace = strrpos($extrait, ' ');
						$extrait = substr($extrait, 0, $espace).'...';
					}
				
					echo '<p>'.$extrait.'</p>';
				
				echo '</div>';
			}
		$iteration++;
		}
	}
	CompteurPagesWidget($billets_par_page, $iteration, False, '', 'tags');
	echo '</div>';
echo '</div>';
?>

<div id="pied">
	<?php include('themes/'.$theme_blog.'/footer.php'); ?>
</div>
</body>

</html>
