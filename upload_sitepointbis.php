<?php
session_start();

include_once('modele/photos/photo_upload.class.php');
include_once('modele/photos/head.php');


$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);

if ($fn) {

	// AJAX call
	file_put_contents(
		'uploads/' . $fn,
		file_get_contents('php://input')
	);
	echo "$fn uploaded";
	exit();
	
}
else {

	// form submit
	$files = $_FILES['fileselect'];
	$size = $_FILES['fileselect']['size'];
	$branche = intval($_POST['branche']);
	$ext = pathinfo($_FILES['fileselect']['name']);
	$extension_upload = $ext['extension'];

	foreach ($files['error'] as $id => $err) {
		if ($err == UPLOAD_ERR_OK) {

			$identi = uniqid('photo_'). '.' . $extension_upload; //nom unique de la photo

			$resultat = move_uploaded_file($files['tmp_name'][$id],'photos/'.$identi);

			if($resultat)
			{

				$_SESSION['photo_proposee'] = get_head($branche);
				$photo = new Photo_upload($identi, $branche);
				$photo -> creer_Photo($identi,$size,$branche);
				$photo -> set_date_upload($photo->getNom());

				MAJ_branche($photo->getNom(),$branche);

				/* Thumbnail */

					$oldname = $identi;
					$newname = "../gallerie_thumbnails/".$oldname;

					if($extension_upload == 'jpeg' || $extension_upload == 'jpg' || $extension_upload == 'JPG')
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

						$newname_graph = "../gallerie_thumbnails_graph/".$oldname;	
						$n_width_graph = 250;
						$n_height_graph = intval($n_width_graph * $height / $width);

						$newimage_graph=imagecreatetruecolor($n_width_graph,$n_height);  
						imageCopyResampled($newimage_graph,$im,0,0,0,0,$n_width_graph,$n_height_graph,$width,$height);
						ImageJpeg($newimage_graph,$newname_graph);
						chmod($newname_graph,0777);
					}

					if($extension_upload == 'png')
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

						$newname_graph = "../gallerie_thumbnails_graph/".$oldname;	
						$n_width_graph = 250;
						$n_height_graph = intval($n_width_graph * $height / $width);

						$newimage_graph=imagecreatetruecolor($n_width_graph,$n_height);  
						imageCopyResampled($newimage_graph,$im,0,0,0,0,$n_width_graph,$n_height_graph,$width,$height);
						ImagePng($newimage_graph,$newname_graph);
						chmod($newname_graph,0777);
					}
			}

			
			$fn = $files['name'][$id];
			move_uploaded_file(
				$files['tmp_name'][$id],
				'photos/' . $fn
			);



			echo "<p>File $fn uploaded.</p>";
		}
	}

}