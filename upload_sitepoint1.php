<?php

session_start();

include_once('modele/photos/photo_upload.class.php');
include_once('modele/photos/head.php');

$identi = uniqid('photo_') . '.JPG'; //nom unique de la photo
$size=3000;

$photo = new Photo_upload($identi, 1);
$photo -> creer_Photo($identi,$size,1);
$photo -> set_date_upload($photo->getNom());
MAJ_branche($photo->getNom(),1);

$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);

if ($fn) {

	// AJAX call

	file_put_contents(
		'photos/' . $identi,
		file_get_contents('php://input')
	);
	echo "$fn uploaded";

	//exit();

}
else {

	// form submit
	$files = $_FILES['fileselect'];

	foreach ($files['error'] as $id => $err) {
		if ($err == UPLOAD_ERR_OK) {
			$fn = $files['name'][$id];
			move_uploaded_file($files['tmp_name'][$id],'photos/' . $identi);
			echo "<p>File $fn uploaded.</p>";

		}
	}

}


/* Thumbnail */

$chdir = 'photos/';
chdir($chdir);

$oldname = $identi;
$newname = "../photos_thumbnails/".$oldname;

$im = ImageCreateFromjpeg($oldname); 
$width=ImageSx($im);              
$height=ImageSy($im);

if($width<$height)
{
	$n_height = 250; 
	$n_width = intval($n_height * $width / $height);
}
else
{
	$n_width = 250; 
	$n_height = intval($n_width * $height / $width);
}

$newimage=imagecreatetruecolor($n_width,$n_height);                 
imageCopyResampled($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
ImageJpeg($newimage,$newname);
chmod($newname,0777);

/* Thumbnail -- graph */

$newname_graph = "../photos_thumbnails_graph/".$oldname;	
$n_width_graph = 250;
$n_height_graph = intval($n_width_graph * $height / $width);

$newimage_graph=imagecreatetruecolor($n_width_graph,$n_height);  
imageCopyResampled($newimage_graph,$im,0,0,0,0,$n_width_graph,$n_height_graph,$width,$height);
ImageJpeg($newimage_graph,$newname_graph);
chmod($newname_graph,0777); 


