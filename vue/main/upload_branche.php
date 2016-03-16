<?php

?>

<div id="upload">

<form action="modele/photos/traitement_upload.php" method="post" enctype="multipart/form-data">
	
	<div id="browse">

		<div class="fileinputs">
        	<input type="file" class="file" name="photo" /><br />
			<div class="fakefile">
			<input />
				<img src="images/bouton-noir.png" />
			</div>
		</div>	

	</div>		

	<div id="send">


		<input type="submit" value="          
		" class="bouton_send"/>

    </div>
				
		<input type="hidden" name="branche" value=<?php echo '"' . $branche .'"' ?> />

</form>



</div>