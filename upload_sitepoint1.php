<?php

session_start();

include_once('modele/photos/photo_upload.class.php');
include_once('modele/photos/head.php');

$identi = uniqid('photo_'); //nom unique de la photo

$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);

if ($fn) {

	// AJAX call

	$name = htmlspecialchars($_SERVER['HTTP_X_FILENAME']);
	$ext = new SplFileInfo($name);
	$extension = $ext->getExtension();
	$nom_final = $identi . '.' . $extension;

	file_put_contents(
		'photos/' . $nom_final,
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

			$name = htmlspecialchars($files['name'][$id]);
			$ext = new SplFileInfo($name);
			$extension = $ext->getExtension();
			$nom_final = $identi . '.' . $extension;

			$fn = $files['name'][$id];
			move_uploaded_file($files['tmp_name'][$id],'photos/' . $nom_final);
			echo "<p>File $fn uploaded.</p>";

		}
	}

}

/* Bdd */

$photo = new Photo_upload($nom_final, 1);
$photo -> creer_Photo($nom_final,1);
$photo -> set_date_upload($photo->getNom());
MAJ_branche($photo->getNom(),1);

/* Thumbnail */

$chdir = 'photos/';
chdir($chdir);

$oldname = $nom_final;
$newname = "../photos_thumbnails/".$oldname;

/* JPEG */

if($extension == 'jpeg' || $extension == 'JPG' || $extension == 'jpg')

{

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

}

/* PNG */

if($extension == 'png')
{

	$im = ImageCreateFromPNG($oldname); 
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
	ImagePng($newimage,$newname);
	chmod($newname,0777);

	/* Thumbnail -- graph */

	$newname_graph = "../photos_thumbnails_graph/".$oldname;	
	$n_width_graph = 250;
	$n_height_graph = intval($n_width_graph * $height / $width);

	$newimage_graph=imagecreatetruecolor($n_width_graph,$n_height);  
	imageCopyResampled($newimage_graph,$im,0,0,0,0,$n_width_graph,$n_height_graph,$width,$height);
	ImagePng($newimage_graph,$newname_graph);
	chmod($newname_graph,0777); 

}