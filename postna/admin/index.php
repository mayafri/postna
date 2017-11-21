<?php
require('./session.php');
Session();

include('../conf/init.php');

include('../bibliotheque/o_nombres.php');
include('../bibliotheque/o_categories.php');
include('../bibliotheque/o_commentaires.php');
include('../bibliotheque/o_droits.php');
include('../bibliotheque/o_billets.php');
include('../bibliotheque/o_billets_attente.php');

include('vues/v_page.php');
include('vues/v_widgets.php');

if(!isset($_GET['cat']))
	$_GET['cat'] = 0;

// Envoi de la catégorie ouverte dans une variable de session
if(isset($_GET['p']))
	$_SESSION['categorie'] = $_GET['cat'].'&p='.$_GET['p'];
else
	$_SESSION['categorie'] = $_GET['cat'];

$billets_par_page_admin = 50;
$limite = CompteurPagesWidgetLimite($billets_par_page_admin);

$req_cat = CategorieOuvrir($_GET['cat'], True);
$req = BilletsLire($_GET['cat'], True, $limite, $billets_par_page_admin);

include('vues/v_index.php');

mysql_close();
?>
