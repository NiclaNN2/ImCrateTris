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
		
		$req = $bdd->prepare('UPDATE photos SET date_upload = CURDATE() WHERE nom = :nom');
		$req->execute(array('nom'=>$nom_photo));
		$req->closeCursor();
		
    }
    
    public function set_date_download($nom_photo)
    {
		global $bdd;
		
		$req = $bdd->prepare('UPDATE photos SET date_download = CURDATE() WHERE nom = :nom');
		$req->execute(array('nom'=>$nom_photo));
		$req->closeCursor();
		
    }
    
    public function retirer_Photo($id_photo) //On retire la photo de la gallerie une fois qu'elle est prise par un utilisateur
    {
		global $bdd;

		$req = $bdd->prepare('UPDATE photos SET libre = false WHERE id_photo = :id_photo');
		$req->execute(array('id_photo'=>$id_photo));
		
		$req->closeCursor();
    }
    
    public function id_poisson_dans_bdd($id_poisson,$id_photo)
    {
		global $bdd;
		
		$req = $bdd->prepare('UPDATE photos SET id_poisson = :id_poisson WHERE id_photo = :id_photo');
		$req->execute(array('id_poisson' => $id_poisson,'id_photo'=>$id_photo));
		$req->closeCursor();
		
    }
    
}

function infos_photo($id_photo)
{
	global $bdd;
	
	$size = 1; // On l'initialise pour pas avoir de problème		
	$req = $bdd->prepare('SELECT size, nom, id_proprietaire, date_download FROM photos WHERE id_photo=?');
	$req->execute(array($id_photo));
	$donnees = $req->fetch();
	
	$size = $donnees['size'];
	$nom = $donnees['nom'];
	$id_proprietaire = $donnees['id_proprietaire'];
	$date_download = $donnees['date_download']; 
		
	return array($size,$nom,$id_proprietaire,$date_download);
			
	$req->closeCursor();
}

function infos_upload($id_photo)
{
	global $bdd;
	
	$req = $bdd->prepare('SELECT date_upload FROM photos WHERE id_photo=?');
	$req->execute(array($id_photo));
	$donnees = $req->fetch();
	
	$date_upload = $donnees['date_upload']; 
	
	return $date_upload;
			
	$req->closeCursor();
}


function desactiver_Photo($id_photo)
{
	global $bdd;
	$req = $bdd->prepare('DELETE FROM photos WHERE id_photo = :id_photo');
	$req->execute(array('id_photo'=>$id_photo));
	$req->closeCursor();
}

function nom_avec_id($id_photo)
{
	global $bdd;

	$req = $bdd->prepare('SELECT nom FROM photos WHERE id_photo=?');
	$req->execute(array($id_photo));
	$donnees = $req->fetch();
	
	$nom_photo = $donnees['nom']; 
	return $nom_photo;
			
	$req->closeCursor();
}

function proprietaire_avec_id($id_photo)
{
	global $bdd;
	$req = $bdd->prepare('SELECT id_proprietaire FROM photos WHERE id_photo=?');
	$req->execute(array($id_photo));
	$donnees = $req->fetch();
	
	$id_proprietaire = $donnees['id_proprietaire']; 
	return $id_proprietaire;
			
	$req->closeCursor();
}