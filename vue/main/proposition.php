<?php
session_start();

$nom = $_SESSION['photo_proposee'];

$path = 'modele/gallerie/' . $nom;

?>

<p><a href=<?php echo $path ?>  download=<?php echo $nom ?> >Download picture</a></p>

