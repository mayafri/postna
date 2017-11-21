<?php
include('../../conf/init.php');
include('../../bibliotheque/o_categories.php');
include('../../bibliotheque/o_nombres.php');
include('../../bibliotheque/o_droits.php');
include('../../bibliotheque/i_commentaires.php');

$date = date('d/m/Y');
$heure = date('H:i');
$pseudo = mysql_real_escape_string(htmlentities(trim($_POST['pseudo'])));
$com = mysql_real_escape_string(htmlentities(trim($_POST['com'])));

if ($_GET['parent'] == '')
	$parent = 0;
else
	$parent = mysql_real_escape_string(htmlentities(trim($_GET['parent'])));

//Si la taille limite n'est pas dépassée
if (strlen($com) <= 500) {
	// Si le mode vitrine n'est pas activé
	if (CategorieVerifierVitrine(CategorieDuBillet($_GET['id'])) == 0) {
		// Si les commentaires sont autorisés
		if ($commentaires_autoriser == True) {
			// Vérification de la validité de l'ID
			$req = mysql_query('SELECT id FROM '.$GLOBALS['base'].'_billets WHERE id='.$_GET['id']);
			$data = mysql_fetch_assoc($req);
		
			if ($_GET['id'] == $data['id']) {
				$id_billet = $data['id'];
				$auteur = BilletProfilID($id_billet);

				if ($pseudo == '' or $com == '') {
					header('Location: ../../billet.php?id='.$id_billet.'&envoi=0#commentaires');
				}
				else {
					mysql_close();
					header('Location: ../../billet.php?id='.$id_billet.'&envoi=1#commentaires');
					
				}
			}
		}
	}
}
?>
