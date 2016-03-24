<?php
header('Location: ../../main.php');
session_start();

include('feedback_bdd.php');

if (isset($_POST['message']))
{
	$texte = htmlspecialchars($_POST['message']);

	echo $texte . '</br>';

	ajouter_feedback($texte);

}

?>


