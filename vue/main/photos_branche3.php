<?php

$req = $bdd2->query('SELECT nom_photo FROM head WHERE branche=3');
$donnees = $req->fetch();
$nom_photo =  $donnees['nom_photo'];
$req->closeCursor();

$adresse = "photos_thumbnails/".$nom_photo;

echo 'branche : ' . $branche . '</br>';

?>

<div id='adresse_photo3'>
	<?php echo $adresse ?>
</div>

<div id="photo3">

	<figure>
	    <img src=<?php echo $adresse ?>  alt="Pantheon" />
	</figure>


</div>