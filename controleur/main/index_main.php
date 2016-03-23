<?php
session_start();

include('vue/header.php');

include('vue/menu.php');

try
{
    $bdd2 = new PDO('mysql:host=localhost;dbname=Imcrate', 'root', 'root');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

?>

<div id="tout_main">

	<div id="photo">
	<?php
	$branche=1;
	include('vue/main/photos_branche1.php');
	include('sitepoint1.html');
    ?>
	</div>

	<div id="photo">
	<?php
	$branche=2;
    include('vue/main/photos_branche2.php');
	include('sitepoint2.html');
    ?>
	</div>

	<div id="photo">
	<?php
	$branche=3;
    include('vue/main/photos_branche3.php');
	include('sitepoint3.html');
    ?>
	</div>

</div>

<?php

include('vue/footer.php');