<?php

include_once('vue/header.php');

?>

<div id="connexion_admin">	

	<form action="controleur/admin/connecteur.php" method="post">
	<p>
		
    <input type="email" name="email" />
    Email
    </p>
    <p>
   
    <input type="password" name="pass" />
    Mot de passe
    </p>
    
    </p>
    <input type="submit" value="Valider" />
   	</p>
     
	</form>
	
<div/>	