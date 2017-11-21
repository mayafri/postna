<?php
include('conf/init.php');
include('bibliotheque/o_categories.php');
include('visiteur/vues/v_elements.php');
?>

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
	<div id="header">
		<?php include('themes/'.$theme_blog.'/header.php');
		 MenuPageIndex(0, 0); ?>
	</div>
	
	<div id="contenu">
		<div id="billets">
			<h2>Erreur 404 : Page introuvable</h2>
			<p>Le contenu auquel vous tentez d'accéder n'est plus accessible.
			Il a été déplacé ou supprimé.</p>
			<p><a href="index.php">Retour au site</a></p>
		</div>
	</div>
	
	<div id="pied">
		<?php include('themes/'.$theme_blog.'/footer.php'); ?>
	</div>
</body>

</html>
