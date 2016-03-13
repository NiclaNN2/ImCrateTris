<?php
session_start();

include('vue/header.php');

include('vue/menu.php');

include_once('modele/photos/photo_upload.class.php');

	?>
    <div id="photo_1">
    <?php
    echo 'branche 1' . '</br>';
    include('vue/main/photos_branche1.php');
    ?>
    </div>

    <div id="upload_1">
    <?php
	include('vue/main/upload_branche1.php');
        if($_SESSION['transfert'] && ($_SESSION['branche_transfert']==1))
		{
		include('vue/main/proposition.php');
		}
	?>
    </div>



    <div id="photo_2">
    <?php
    echo 'branche 2' . '</br>';
    include('vue/main/photos_branche2.php');
    ?>
    </div>

    <div id="upload_2">
    <?php
	include('vue/main/upload_branche2.php');
	if($_SESSION['transfert'] && ($_SESSION['branche_transfert']==2))
		{
		include('vue/main/proposition.php');
		}    
	?>	
	</div>


	
    <div id="photo_3">
    <?php
    echo 'branche 3' . '</br>';
    include('vue/main/photos_branche3.php');
    ?>
    </div>

    <div id="upload_3">
    <?php
	include('vue/main/upload_branche3.php');
	if($_SESSION['transfert'] && ($_SESSION['branche_transfert']==3))
		{
		include('vue/main/proposition.php');
		}    
	?>
	</div>


    <?php


include('vue/footer.php');

$_SESSION['transfert']=false;