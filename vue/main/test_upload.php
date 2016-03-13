<?php
#header('Location: ../../main.php');

#include_once('../../modele/photos/photo_upload.class.php');
include_once('../../head.php');

$existence=false;

if($existence)
{

echo '<br/>';

$minwidth = 10;
$minheight = 10;
$minsize = 0;
$maxsize = 1000000000;
$photo_size = getimagesize($_FILES['photo']['tmp_name']);

$size = $_FILES['photo']['size'];
echo 'size : ' .  $size . '<br/>';

$branche = intval($_POST['branche']);

echo 'branche : ' .  $branche . '</br>';

$succes = false;

$infos_photo = pathinfo($_FILES['photo']['name']);
$extension_upload = $infos_photo['extension'];
$extensions_autorisees = array('jpg', 'jpeg', 'png');

if (in_array($extension_upload, $extensions_autorisees))
{

	$identi = uniqid('photo_'). '.' . $extension_upload; //nom unique de la photo
	$nom =  "../../modele/gallerie/";	
	chdir($nom);
	$resultat = move_uploaded_file($_FILES['photo']['tmp_name'],$identi);

	if ($resultat) 
	{	
		$photo = new Photo_upload($identi, $branche);
		$photo -> creer_Photo($identi,$size,$branche);
		$photo -> set_date_upload($photo->getNom());

		MAJ_branche($photo->getNom(),$branche);

		/* Si l'upload est bon, on propose le téléchargement */

		$succes = true;


		/* Thumbnail */

		$oldname = $identi;
		$newname = "../../modele/gallerie_thumbnails/".$oldname;

		if($extension_upload == 'jpeg' || $extension_upload == 'jpg')
		{
			$im = ImageCreateFromjpeg($oldname); 
			$width=ImageSx($im);              
			$height=ImageSy($im);
			$n_height = 280; 
			$n_width = intval($n_height * $width / $height);
			$newimage=imagecreatetruecolor($n_width,$n_height);                 
			imageCopyResampled($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
			ImageJpeg($newimage,$newname);
			chmod($newname,0777);
		}

		if($extension_upload == 'png')
		{
			$im = ImageCreateFromPNG($oldname); 
			$width=ImageSx($im);              
			$height=ImageSy($im);
			$n_height = 280; 
			$n_width = intval($n_height * $width / $height);
			$newimage=imagecreatetruecolor($n_width,$n_height);                 
			imageCopyResampled($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
			ImagePng($newimage,$newname);
			chmod($newname,0777);
		}
	}

}

}