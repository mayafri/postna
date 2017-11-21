<!--
DÉPENDANCES ====================================================================

	- o_droits.php
	
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
	GenererMenuPrincipal($focus='droits');
	?>

	<h2>Utilisateurs et droits</h2>
	
	<div id="menucat">
		<strong><a href="droits_util_nv.php">Nouvel utilisateur</a></p></strong>
	</div>
		
	<div id="contenu">

	<?php if (ProfilsNombre() > 1) { ?>

	<form action="envois/e_droits.php" method="post" class="droits">
		<table>
		<tr>
		<td><strong>Identifiant</strong></td>
		<td><strong>Nom</strong></td>
		<td><strong>Billets</strong></td>
		<td><strong>Catégories</strong></td>
		<td><strong>Documents</strong></td>
		<td><strong>Profil</strong></td>
		<td><strong>Réglages</strong></td>
		<td><strong>Bloqué ?</strong></td>
		</tr>
	
	<?php
		while ($data = mysql_fetch_assoc($req)) {
			if (strpos($data['droits'], 'E') === False) {
				echo '<tr>';
				echo '<input name="id[]" type="hidden" value="'.$data['id'].'" />'; // ID
				echo '<td><input type="text" name="pseudo[]" value="'.$data['pseudo'].'" /></td>'; // Pseudo
				echo '<td><input type="text" name="nom[]" value="'.$data['nom'].'" /></td>'; // Nom
			
				// Billets
				echo '<td><select name="billets[]">';
				if (strpos($data['droits'], 'A') !== False) {
					echo '<option value="soi">Accès personnel</option>';
					echo '<option value="tout" selected="selected">Accès total</option>';
				} else {
					echo '<option value="soi" selected="selected">Accès personnel</option>';
					echo '<option value="tout">Accès total</option>';
				}
				echo '</select></td>';	

				// Catégories
				echo '<td><select name="categories[]">';
				if (strpos($data['droits'], 'B') !== False) {
					echo '<option value="soi">Accès limité</option>';
					echo '<option value="tout" selected="selected">Accès total</option>';
				}
				else {
					echo '<option value="soi" selected="selected">Accès limité</option>';
					echo '<option value="tout">Accès total</option>';
				}
				echo '</select></td>';	

				// Documents
				echo '<td><select name="fichiers[]">';
				if (strpos($data['droits'], 'C') !== False) {
					echo '<option value="non">Aucun accès</option>';
					echo '<option value="lecture">Lecture seule</option>';
					echo '<option value="ecriture" selected="selected">Écriture</option>';
				}
				elseif (strpos($data['droits'], 'c') !== False) {
					echo '<option value="non">Aucun accès</option>';
					echo '<option value="lecture" selected="selected">Lecture seule</option>';
					echo '<option value="ecriture">Écriture</option>';
				}
				else {
					echo '<option value="non" selected="selected">Aucun accès</option>';
					echo '<option value="lecture">Lecture seule</option>';
					echo '<option value="ecriture">Écriture</option>';
				}
				echo '</select></td>';			
			
				// Profil étendu
				echo '<td><select name="profil_etendu[]">';
				if (strpos($data['droits'], 'D') !== False) {
					echo '<option value="non">Simple</option>';
					echo '<option value="oui" selected="selected">Étendu</option>';
				} else {
					echo '<option value="non" selected="selected">Simple</option>';
					echo '<option value="oui">Étendu</option>';
				}
				echo '</select></td>';	
			
				// Réglages
				echo '<td><select name="reglages[]">';
				if (strpos($data['droits'], 'e') !== False) {
					echo '<option value="non">Non</option>';
					echo '<option value="oui" selected="selected">Accessibles</option>';
				} else {
					echo '<option value="non" selected="selected">Non</option>';
					echo '<option value="oui">Accessibles</option>';
				}
				echo '</select></td>';	
			
				// Bloqué
				echo '<td><select name="bloque[]">';
				if (strpos($data['droits'], 'F') !== False) {
					echo '<option value="non">Non</option>';
					echo '<option value="oui" selected="selected">BLOQUÉ</option>';
				} else {
					echo '<option value="non" selected="selected">Non</option>';
					echo '<option value="oui">BLOQUÉ</option>';
				}
				echo '</select></td>';
				
				// Supprimer
				echo '<td><em><a href="droits_util_suppr.php?id='.$data['id'].'">✕</a></td>';
			}
		}
	?>
		</table>
		<p class="boutons">
			<strong><input type="submit" value="Valider" /></strong>
		</p>
	</form>
	<?php } ?>
	</div>
	
</body>
</html>

