<div id="texte">
	
	Have comments or feedback ? 

	<div id='soumettre'>
	<form action="modele/feedback/upload_feedback.php" method="post" class="download">
		
		<p>
   	 	<input type="text" name="message" />
   		</p>
    
     	<p>
   		<input type="submit" value="Post feedback" id="post_feedback" />
   		</p>
   	</form>

   	</div>

</div>

<script>

	var soumettre = document.getElementById('soumettre');
	var where = document.getElementById('post_feedback');
	var thanks = document.createTextNode('Thanks !');

	where.addEventListener('click',function(){
			soumettre.appendChild(thanks);
	});

</script>