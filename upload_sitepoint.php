<?php

session_start();

include_once('modele/photos/photo_upload.class.php');
include_once('modele/photos/head.php');

$branche = intval($_POST['branche']);

$identi = uniqid('photo_'). '.' . $extension_upload; //nom unique de la photo


$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);

if ($fn) {

	// AJAX call

	file_put_contents(
		'photos/' . $identi . 'jpeg',
		file_get_contents('php://input')
	);
	echo "$fn uploaded";
	exit();

}
else {

	// form submit
	$files = $_FILES['fileselect'];

	foreach ($files['error'] as $id => $err) {
		if ($err == UPLOAD_ERR_OK) {
			$fn = $files['name'][$id];
			move_uploaded_file(
				$files['tmp_name'][$id],
				'uploads/' . $identi
			);
			echo "<p>File $fn uploaded.</p>";
		}
	}

}