<?php

/*
*
*  Classe qui gère l'upload de photos
*
*/


try
{
    $bdd = new PDO('mysql:host=localhost;dbname=Imcrate', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

		
class Photo_upload
{	
	private $nom;
	private $branche;

	public function __construct($nom)
    {   	
    	$this->nom = $nom;
    }
    
    public function getNom()
    {
        return $this->nom;
    }

    public function getBranche()
    {
        return $this->branche;
    }
    
	public function creer_Photo($nom, $size, $branche) //On met l'identifiant du membre dans la table photo dans le champ id_proprietaire
	    {
		global $bdd;
		
		$req2 = $bdd->prepare('INSERT INTO photos(nom_photo, size, branche) VALUES(:nom_photo, :size, :branche)');
		$req2->execute(array(
		'nom_photo' => $nom,
		'size' => $size,
		'branche' => $branche
		));	
		
		$req2->closeCursor();

	    }
    
    public function set_date_upload($nom_photo)
    {
		global $bdd;
		
		$req = $bdd->prepare('UPDATE photos SET date_upload = CURDATE() WHERE nom_photo = :nom_photo');
		$req->execute(array('nom_photo'=>$nom_photo));
		$req->closeCursor();
		
    }
    
    
}


function desactiver_Photo($nom_photo)
{
	global $bdd;
	$req = $bdd->prepare('DELETE FROM photos WHERE nom_photo = :nom_photo');
	$req->execute(array('nom_photo'=>$nom_photo));
	$req->closeCursor();

	echo $nom_photo . '</br>';
}


