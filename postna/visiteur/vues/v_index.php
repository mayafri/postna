<!--
DÉPENDANCES ====================================================================

	- o_billets.php
	- o_categories.php
	- o_commentaires.php
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
		MenuPageIndex($categorie_initiale, $categorie);
	echo '</div>';

	echo '<div id="contenu">';

	if ($menuLateral == True) {
		Arborescence($categorie_initiale, $categorie);
	}

	echo '<div id="billets">';
	
	// Affichage de l'entête
	if ($array_cat['entete'] != '') {
		echo '<div id="entete">';
			echo '<p>'.$array_cat['entete'].'</p>';
		echo '</div>';
	}
	
// Boucle d'affichage

while ($data = mysql_fetch_assoc($req)) {
	$cat = CategorieDuBillet($data['id']);
	echo '<div class="bloc">';

	echo '<h2><a href="billet.php?id='.$data['id'].'">'.$data['titre'].'</a></h2>';

	// On vérifie si le mode vitrine est activé ou pas
	if (CategorieVerifierVitrine($cat) == 0) {
		echo '<div class="sous-titre">';
		// On vérifie si les commentaires sont autorisés
		if ($commentaires_autoriser == True) { 
			$nb_com = CommentairesNombre($data['id'], 0, True);
			if ($nb_com > 1)
				echo '<a href="billet.php?id='.$data['id'].'#commentaires">'.$nb_com.' commentaires.</a> ';
			else
				echo '<a href="billet.php?id='.$data['id'].'#commentaires">'.$nb_com.' commentaire.</a> ';
		}
	
		// On vérifie si la date est activée
		if ($date_afficher == True) {
			echo 'Ajouté le '.date($format_date, $data['date']).' à '.date($format_heure, $data['date']).'. ';
		}
		// On fait un lien vers la catégorie dans certains cas
		if ($_GET['cat'] == '' or BilletsNombreSimple() == 0) {
			echo 'Catégorie : <a href="index.php?cat='.$data['cat'].'">'.CategorieNom($data['cat']).'</a>. ';
		}
		// Découpage puis affichage des tags
		if ($data['tags'] != '') {
			$tags = explode(' ', $data['tags']);
			if (count($tags) > 1)
				echo '<br>Étiquettes :';
			else
				echo '<br>Étiquette :';
			foreach ($tags as $elem)
				echo ' <a href="recherche.php?tag='.$elem.'">'.$elem.'</a>';
			echo '.';
		}
		echo '</div>';
	}

	// Troncature pour n'afficher que les entêtes si +1 billet
	if (BilletsNombre() > 1) { 
		echo '<div class="troncature">'.$data['contenu'].'</div>
		<p class="lien_troncature"><a href="billet.php?id='.$data['id'].'">Lire la suite</a></p>';
	}
	else {
		echo $data['contenu'];
	}

	echo '</div>';
}

// Menu des pages
CompteurPagesWidget($billets_par_page, BilletsNombre());
echo '</div>';
?>
	
	</div>
	
	<div id="pied">
		<?php include('themes/'.$theme_blog.'/footer.php'); ?>
	</div>
</body>

</html>
