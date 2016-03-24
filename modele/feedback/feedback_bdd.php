<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=Imcrate', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

function ajouter_feedback($texte)
{
	global $bdd;

	$req = $bdd->prepare('INSERT INTO feedback(feedback) VALUES(:feedback)');
	$req->execute(array('feedback' => $texte));
	$req->closeCursor();

}