<?php 

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
$adresse = "modele/gallerie_thumbnails_graph/".$nom_photo;


if($_SESSION['admin'])
{

		#echo 'nom_photo : ' . $nom_photo . '</br>';

	?>

		<p>
		<form action="controleur/graph/desactiver_photo.php" method="post">
		</p>

	    <input type="hidden" name= "nom_photo" value=<?php echo $nom_photo ?> />

	    <p>
	    Supprimer (dessous)
	    <input type="submit" value="Valider" />
	   	</p>
	     
		</form>
	

	<?php
}

?>
		<div class="ligne_verticale" ></div>
		<div id="photo_graph">
		<figure>
    			<img src=<?php echo $adresse ?> alt="Pantheon" />
		</figure>
		</div>
<?php
}

$req->closeCursor();

?>
