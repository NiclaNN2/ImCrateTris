<?php

header('Location: ../../graph.php');

include('../../modele/photos/photo_upload.class.php');

$photo_a_supprimer = $_POST['nom_photo'];

echo $photo_a_supprimer . '</br>';

desactiver_Photo($photo_a_supprimer);
