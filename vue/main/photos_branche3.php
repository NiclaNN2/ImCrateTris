<?php 
$branche=3;
?>


<?php
try
{
    $bdd2 = new PDO('mysql:host=localhost;dbname=Imcrate', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$req = $bdd2->prepare('SELECT nom_photo FROM head WHERE branche=?');
$req->execute(array($branche));

$donnees = $req->fetch();

$nom_photo =  $donnees['nom_photo'];
$adresse = "modele/gallerie_thumbnails/".$nom_photo;

?>
	<p>
		<figure>
    			<img src=<?php echo $adresse ?> alt="Pantheon" />
		</figure>
	</p>

<?php

$req->closeCursor();

?>

