<?php
session_start();

include('vue/header.php');

include('vue/menu.php');

include_once('modele/photos/photo_upload.id.php');

?>

<div id="tout">



<div id="colonne">
	
	<div id="photo">
	<?php
	#echo 'photos_branche1'  . '</br>';
    include('vue/main/photos_branche1.php');
    ?>
	</div>

	<div id="upload">
	<?php
    include('vue/main/upload_branche1.php');
    ?>
	</div>

	<div id='download'>
	<?php
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

</div>

<div id="colonne">
	
	<div id="photo">
	<?php
	#echo 'photos_branche1'  . '</br>';
    include('vue/main/photos_branche2.php');
    ?>
	</div>

	<div id="upload">
	<?php
    include('vue/main/upload_branche2.php');
    ?>
	</div>

	<div id='download'>
	<?php
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

</div>

<div id="colonne">
	
	<div id="photo">
	<?php
	#echo 'photos_branche1'  . '</br>';
    include('vue/main/photos_branche3.php');
    ?>
	</div>

	<div id="upload">
	<?php
    include('vue/main/upload_branche3.php');
    ?>
	</div>

	<div id='download'>
	<?php
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