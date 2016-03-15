<?php
session_start();

include('vue/header.php');

include('vue/menu.php');

include_once('modele/photos/photo_upload.id.php');

?>

<div id="tout_main">

<div id="element">

	<div id="photo">
	<?php
	$branche=1;
    include('vue/main/photos_branche.php');
    ?>
	</div>

	<div id="photo">
	<?php
	$branche=2;
    include('vue/main/photos_branche.php');
    ?>
	</div>

	<div id="photo">
	<?php
	$branche=3;
    include('vue/main/photos_branche.php');
    ?>
	</div>

</div>

<div id="element">

	<div id="updown">
	<?php
    include('vue/main/upload_branche1.php');
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
    include('vue/main/upload_branche2.php');
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
    include('vue/main/upload_branche3.php');
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