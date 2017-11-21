<!--
DÉPENDANCES ====================================================================

	- o_billets.php
	- o_categories.php
	- o_commentaires.php
	
	- v_elements.php
	
DÉPENDANCES ====================================================================
-->


<!doctype html>
<html>

<head>
	<?php
	echo '<title>'.$data['titre'].' - '.$titre_blog.'</title>';
	echo '<meta charset="UTF-8">';
	include('themes/'.$theme_blog.'/inclusions.php');
	?>
</head>

<body>
	<script>
		function Fermer() {
			document.getElementById('form_0').style.display = 'block';
			for (var i = 0; i < document.getElementsByName("forms").length; i++) {
				document.getElementsByName("forms")[i].style.display = 'none';
				document.getElementsByName("boutons")[i].style.display = 'block';
			}
		}
		function Repondre(id) {
			for (var i = 0; i < document.getElementsByName("forms").length; i++) {
				document.getElementsByName("forms")[i].style.display = 'none';
				document.getElementsByName("boutons")[i].style.display = 'block';
			}
			
			document.getElementById('form_0').style.display = 'none';
			document.getElementById('form_'+id).style.display = 'block';
			document.getElementById('bouton_'+id).style.display = 'none';
		}
	</script>
	<?php
	// Inclusion du header et menu
	echo '<div id="header">';
		include('themes/'.$theme_blog.'/header.php');
		GenererChampRecherche();
		MenuPageBillet($categorie_initiale, $categorie_billet);
	echo '</div>';

	echo '<div id="contenu">';
	if ($menuLateral == True) {
		Arborescence($categorie_initiale, $categorie_billet);
	}

	// Affichage du billet chargé plus haut
	echo '<div id="billets">';
		echo '<div class="bloc">';
		echo '<h2>'.$data['titre'].'</h2>';
		
		// Si le billet vient d'une catégorie vitrine, on n'affiche ni date ni commentaires
		$estVitrine = CategorieVerifierVitrine($categorie_billet);
		if ($estVitrine == 0 and ($date_afficher == True or $data['tags'] != '')) {
			echo '<div class="sous-titre">';
			if ($date_afficher == True) {
				echo 'Ajouté le '.date($format_date, $data['date']).' à '.date($format_heure, $data['date']).'. ';
			}
			// Découpage puis affichage des tags
			if ($data['tags'] != '') {
				$tags = explode(' ', $data['tags']);
				if (count($tags) > 1)
					echo 'Étiquettes :';
				else
					echo 'Étiquette :';
				foreach ($tags as $elem)
					echo ' <a href="recherche.php?tag='.$elem.'">'.$elem.'</a>';
				echo '.';
			}
			echo '</div>';
		}
		
		echo $data['contenu'];
		echo '</div>';
	echo '</div>';

		// Si le billet ne vient pas d'une catégorie vitrine, on met en place le système de commentaires
		if ($estVitrine == 0) {
			// Si les commentaires sont autorisés, on affiche le formulaire pour en poster
			if ($commentaires_autoriser == True) {
				echo '<div id="commentaires">';

				// Boucle des commentaires
				function BoucleRecursiveCommentaires($parent, $ordre, $format_date, $format_heure, $id_billet) {
					$req = CommentairesLire($_GET['id'], 0, $parent, $ordre);
					while($truc = mysql_fetch_array($req)) {
						echo '<div class="com" id="com_'.$truc['id'].'">';
							echo '<p class="pseudo"><a href="billet.php?id='.$id_billet.'#com_'.$truc['id'].'">Par '.$truc['pseudo'].', le '.date($format_date, $truc['date']).' à '.date($format_heure, $truc['date']).'</a></p>';
							echo '<p>'.$truc['com'].'</p>';
							
							BoucleRecursiveCommentaires($truc['id'], 'ASC', $format_date, $format_heure, $id_billet);

							// Formulaire de réponse, caché par défaut via CSS
							echo '<p><input type="button" name="boutons" id="bouton_'.$truc['id'].'" onclick="Repondre(\''.$truc['id'].'\')" value="Répondre" /></p>';
							echo '<div style="display:none" name="forms" id="form_'.$truc['id'].'">';
								echo '<form action="visiteur/envois/e_commentaire.php?id='.$_GET['id'].'&parent='.$truc['id'].'" method="post">';
								echo '	<p>Pseudo : <input type="text" name="pseudo" value="" /></p>';
								echo '	<p><textarea maxlength="500" name="com"></textarea></p>';
								echo '	<p><input type="button" onclick="Fermer()" value="Fermer" /> <input type="submit" value="Valider" /></p>';
								echo '</form>';
							echo '</div>';
						echo '</div>';
					}
				}
				
				BoucleRecursiveCommentaires(0, 'ASC', $format_date, $format_heure, $data['id']);

				echo '<div id="form_0"><form action="visiteur/envois/e_commentaire.php?id='.$_GET['id'].'" method="post">';
				echo '	<p class="titre">Laisser un commentaire</p>';
				echo '	<p>Pseudo : <input type="text" name="pseudo" value="" /></p>';
				echo '	<p><textarea maxlength="500" name="com"></textarea></p>';
				echo '	<p><input type="submit" value="Valider" /></p>';
				echo '</form></div>';

				if (isset($_GET['envoi'])) {
					if ($_GET['envoi'] == 0) {
						echo '<p class="erreur">Vous devez remplir toutes les cases.</p>';
					}
					elseif ($_GET['envoi'] == 1) {
						echo '<p class="ok">Le commentaire n\'a pas été envoyé, car ceci est une démonstration.</p>';
					}
				}
			}
		}
		?>
	</div>
	</div>
	</div>
	
	<div id="pied">
		<?php include('themes/'.$theme_blog.'/footer.php'); ?>
	</div>
</body>

</html>
