<?php

$req = $bdd2->prepare('SELECT nom_photo FROM head WHERE branche=?');
$req->execute(array($branche));

$donnees = $req->fetch();

$nom_photo =  $donnees['nom_photo'];
$adresse = "modele/gallerie_thumbnails/".$nom_photo;

$numero_photo = 'photo' . strval($branche);

?>
	<p>
		<figure>
    			<img id=<?php echo $numero_photo ?> src=<?php echo $adresse ?> alt="Pantheon" />
		</figure>
	</p>
	
<?php

$req->closeCursor();

?>

