<?php

#$transfert = false;

?>

<div id="upload">

<form action="modele/photos/traitement_upload.php" method="post" enctype="multipart/form-data">

	<div class="fileinputs">
	<div id="upload_element">
        <input type="file" class="file" name="photo" /><br />
		<div class="fakefile">
			<input />
			<img src="images/bouton-noir.png" />
		</div>
	</div>	
	</div>		

	<div id="upload_element">
		<input type="submit" value="Send" />
    </div>
				
		<input type="hidden" name="branche" value="1" />

</form>

</div>