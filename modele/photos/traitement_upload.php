<?php
header('Location: ../../main.php');
session_start();

include_once('Photo_upload.class.php');
include_once('head.php');

?>
<a href="../../main.php">Main</a>
<?php

$minwidth = 10;
$minheight = 10;
$minsize = 0;
$maxsize = 1000000000;
$photo_size = getimagesize($_FILES['photo']['tmp_name']);

$size = $_FILES['photo']['size'];
echo 'size : ' .  $size . '<br/>';

$branche = intval($_POST['branche']);
$_SESSION['branche_transfert'] = $branche;

$infos_photo = pathinfo($_FILES['photo']['name']);
$extension_upload = $infos_photo['extension'];
$extensions_autorisees = array('jpg', 'jpeg', 'png', 'JPG');

echo 'branche : ' .  $branche . '</br>';

if (isset($_FILES['photo']) AND $_FILES['photo']['error'] == 0)
{


	if(($_FILES['photo']['size'] < $minsize))
	{
		echo 'The image is too small' . '</br>';
		$_SESSION['erreur_envoi'] = true;
		$_SESSION['erreur_upload'] = 'The image is too small : please use a larger image.';
	}

	elseif ($_FILES['photo']['size'] > $maxsize) 
	{
		echo 'The image is too large' . '</br>';
		$_SESSION['erreur_envoi'] = true;
		$_SESSION['erreur_upload'] = 'The image is too large : please use a smaller image.';
	}

	else
	{
		if ($image_sizes[0] < $minwidth OR $image_sizes[1] < $minheight) 
		{

			if (in_array($extension_upload, $extensions_autorisees))
			{

				$identi = uniqid('photo_'). '.' . $extension_upload; //nom unique de la photo
				$nom =  "../gallerie/";	
				chdir($nom);
				$resultat = move_uploaded_file($_FILES['photo']['tmp_name'],$identi);

				if ($resultat) 
				{	

					$_SESSION['photo_proposee'] = get_head($branche);

					$photo = new Photo_upload($identi, $branche);
					$photo -> creer_Photo($identi,$size,$branche);
					$photo -> set_date_upload($photo->getNom());

					MAJ_branche($photo->getNom(),$branche);

					/* Si l'upload est bon, on propose le téléchargement */

					$_SESSION['transfert'] = true;
					$_SESSION['erreur_envoi'] = false;

					/* Thumbnail */

					$oldname = $identi;
					$newname = "../gallerie_thumbnails/".$oldname;

					if($extension_upload == 'jpeg' || $extension_upload == 'jpg' || $extension_upload == 'JPG')
					{
						$im = ImageCreateFromjpeg($oldname); 
						$width=ImageSx($im);              
						$height=ImageSy($im);
						$n_width = 230; 
						$n_height = intval($n_width * $height / $width);
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
						$n_width = 230; 
						$n_height = intval($n_width * $height / $width);
						$newimage=imagecreatetruecolor($n_width,$n_height);                 
						imageCopyResampled($newimage,$im,0,0,0,0,$n_width,$n_height,$width,$height);
						ImagePng($newimage,$newname);
						chmod($newname,0777);
					}
				}

			}

			else
		    {
		    echo 'Extension non autorisée' . '<br/>';
		    $_SESSION['erreur_envoi'] = true;
		    $_SESSION['erreur_upload']="Extension not authorized : please use png, or jpeg.";
		    }

		}

		else
		{
			echo 'Image trop petite' . '<br/>';
			$_SESSION['erreur_envoi'] = true;
			$_SESSION['erreur_upload']="The image is too small.";
		}

	}

}

else
{
	echo 'erreur lors du transfert' . '<br/>';
	$_SESSION['erreur_envoi'] = true;
	$_SESSION['erreur_upload']="There was an error during the image transfer.";
}