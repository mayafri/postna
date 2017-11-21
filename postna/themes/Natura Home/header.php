<h1>
	<a href="index.php">
		<img src="themes/<?php echo $theme_blog; ?>/images/logo.png" alt="<?php echo $titre_blog; ?>" />
	</a>
</h1>


<div id="langue">
	<a href="#"><img src="themes/<?php echo $theme_blog; ?>/images/fr.jpg" alt="FR" /></a>
	<a href="#"><img src="themes/<?php echo $theme_blog; ?>/images/pl.jpg" alt="PL" /></a>
	<a href="#"><img src="themes/<?php echo $theme_blog; ?>/images/en.jpg" alt="EN" /></a>
</div>

<?php
// Ce menu s'affiche dans la page index.php uniquement.
function MenuPageIndex($cat_init, $cat_art) {
	GenererMenuSimple($cat_init);
}

// Ce menu s'affiche dans la page billet.php uniquement.
function MenuPageBillet($cat_init, $cat_art) {
	echo '<div id="menu"><a href="index.php?cat='.$cat_art.'">Revenir sur le blog</a></div>';
}

// Si vous avez choisi un menu simple, alors vous devrez activer le menu latéral
// pour rendre visible vos sous-catégories, si vous en faites.
$menuLateral = True;
?>
