<?php 
$branche=1;

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=Imcrate', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('SELECT nom_photo FROM photos WHERE branche=?');
$req->execute(array($branche));

while ($donnees = $req->fetch())
{
$nom_photo =  $donnees['nom_photo'];
$adresse = "modele/gallerie_thumbnails/".$nom_photo;

?>
		<figure>
    			<img src=<?php echo $adresse ?> alt="Pantheon" />
		</figure>
<?php
}

$req->closeCursor();

?>
