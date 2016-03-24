<?php

$req = $bdd2->query('SELECT nom_photo FROM head WHERE branche=1');
$donnees = $req->fetch();
$nom_photo =  $donnees['nom_photo'];
$req->closeCursor();

$adresse1 = "photos_thumbnails/".$nom_photo;
$adresse_download_1 = "photos/".$nom_photo;

$time = time();
$year = date('Y',$time);
$month = date('m',$time);
$day = date('j',$time); 

$date_download = $day . '/' . $month . '/' . $year;

?>

<script>
	var adresse_download_1 = <?php echo json_encode($adresse_download_1); ?>;
	var date_download = <?php echo json_encode($date_download); ?>;
</script>