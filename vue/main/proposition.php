<?php
session_start();

$nom = $_SESSION['photo_proposee'];

$path = 'modele/gallerie/' . $nom;

?>

<div class="download_picture">
<p>
<a href=<?php echo $path ?>  download=<?php echo $nom ?> >Download picture</a>
</p>
</div>