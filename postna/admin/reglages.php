<?php
require('./session.php');
Session();

if (strpos($_SESSION['droits'], 'e') === False
and strpos($_SESSION['droits'], 'E') === False) {
	header('Location: ./index.php');
	exit();
}

include('../conf/init.php');
include('../bibliotheque/o_billets_attente.php');
include('../bibliotheque/o_categories.php');
include('../bibliotheque/o_commentaires.php');
include('vues/v_page.php');
include('vues/v_widgets.php');

// Si ces widgets sont amenés à servir en dehors de admin/reglages.php, alors il
// serait avisé de les déplacer dans admin/vues/v_widgets.php.

function GenererThemes($theme_blog) {
	$dossiers = scandir("../themes");
	foreach ($dossiers as $element) {
		if ($element == $theme_blog) {
			echo '<option selected="selected" value="'.$element.'">'.$element.'</option>';
		}
		elseif ($element != "." and $element != "..") {
			echo '<option value="'.$element.'">'.$element.'</option>';
		}
	}
}

function GenererListeDate($format_date) {
	$annee = date(Y);
	$mois = date(m);
	$f1 = ['d/m/Y', 'd-m-Y', 'Y/m/d', 'Y-m-d'];
	$f2 = ['31/'.$mois.'/'.$annee, '31-'.$mois.'-'.$annee, $annee.'/'.$mois.'/31', $annee.'-'.$mois.'-31'];

	$i = 0;
	while ($i < count($f1)) {
		if ($f1[$i] == $format_date)
			echo '<option value="'.$f1[$i].'" selected="selected">'.$f2[$i].'</option>';
		else
			echo '<option value="'.$f1[$i].'">'.$f2[$i].'</option>';
		$i++;
	}
}

function GenererListeHeure($format_heure) {
	$f1 = ['H:i', 'h:i a', 'h:i A'];
	$f2 = ['24 heures', '12 heures (am/pm)', '12 heures (AM/PM)'];

	$i = 0;
	while ($i < count($f1)) {
		if ($f1[$i] == $format_heure)
			echo '<option value="'.$f1[$i].'" selected="selected">'.$f2[$i].'</option>';
		else
			echo '<option value="'.$f1[$i].'">'.$f2[$i].'</option>';
		$i++;
	}
}

include('vues/v_reglages.php');

mysql_close();
?>
