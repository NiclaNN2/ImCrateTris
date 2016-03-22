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

<div id="element">

	<div id="photo">
	<?php
	$branche=1;
    include('vue/main/photos_branche1.php');
    ?>
	</div>

	<div id="photo">
	<?php
	$branche=2;
    include('vue/main/photos_branche2.php');
    ?>
	</div>

	<div id="photo">
	<?php
	$branche=3;
    include('vue/main/photos_branche3.php');
    ?>
	</div>

</div>

<div id="element">

	<div id="updown">
	<?php
	$branche = 1;
    include('sitepoint1.html');

	if($_SESSION['transfert'] && ($_SESSION['branche_transfert']==1))
		{
		include('vue/main/proposition.php');
		}
	if($_SESSION['erreur_envoi'] && ($_SESSION['branche_transfert']==1))
		{
		echo $_SESSION['erreur_upload'];	
		}	
		?>
	</div>

	<div id="updown">
	<?php
	$branche = 2;
	include('sitepoint2.html');

	if($_SESSION['transfert'] && ($_SESSION['branche_transfert']==2))
		{
		include('vue/main/proposition.php');
		}
	if($_SESSION['erreur_envoi']  && ($_SESSION['branche_transfert']==2))
		{
		echo $_SESSION['erreur_upload'] . '</br>';	
		}
	?>
	</div>

	<div id="updown">
	<?php
	$branche = 3;
	include('sitepoint3.html');

	if($_SESSION['transfert'] && ($_SESSION['branche_transfert']==3))
		{
		include('vue/main/proposition.php');
		}
	if($_SESSION['erreur_envoi'] && ($_SESSION['branche_transfert']==3))
		{
		echo $_SESSION['erreur_upload'];	
		}
	?>
	</div>

</div>
</div>

<?php

include('vue/footer.php');

$_SESSION['transfert']=false;
$_SESSION['erreur_envoi']=false;