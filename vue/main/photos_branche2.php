<?php

$req = $bdd2->query('SELECT nom_photo FROM head WHERE branche=2');
$donnees = $req->fetch();
$nom_photo =  $donnees['nom_photo'];
$req->closeCursor();

$adresse2 = "photos_thumbnails/".$nom_photo;
$adresse_download_2 = "photos/".$nom_photo;

//echo 'branche : ' . $branche . '</br>';

?>
<!--
<div id='adresse_photo2'>
	<?php //echo $adresse2 ?>
</div>
-->


<script>
	var adresse_download_2 = <?php echo json_encode($adresse_download_2); ?>;
</script>