<?php

$req = $bdd2->query('SELECT nom_photo FROM head WHERE branche=3');
$donnees = $req->fetch();
$nom_photo =  $donnees['nom_photo'];
$req->closeCursor();

$adresse3 = "photos_thumbnails/".$nom_photo;
$adresse_download_3 = "photos/".$nom_photo;

?>

<script>
	var adresse_download_3 = <?php echo json_encode($adresse_download_3); ?>;
</script>