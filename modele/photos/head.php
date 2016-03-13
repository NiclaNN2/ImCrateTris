<?php

/*
*
*  Mise à jour des photos heads
*
*/


try
{
    $bdd2 = new PDO('mysql:host=localhost;dbname=Imcrate', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}


function MAJ_branche($nom_photo, $branche)
{
	global $bdd2;

	$req = $bdd2->prepare('UPDATE head SET nom_photo = :nom_photo WHERE branche = :branche');
	$req->execute(array('nom_photo'=>$nom_photo, 'branche'=>$branche));

	$req->closeCursor();
	
}

function get_head($branche)
{
	global $bdd2;

	$req = $bdd2->prepare('SELECT nom_photo FROM head WHERE branche=?');
	$req->execute(array($branche));
	$donnees = $req->fetch();

	$nom_photo = $donnees['nom_photo']; 
	return $nom_photo;

	$req->closeCursor();

}