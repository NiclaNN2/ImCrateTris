<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
    <head>
        <title>Gallerie</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="vue/ImCrate.css" rel="stylesheet" type="text/css" /> 
    </head>
        
    <header>
	<h1>
    <a href="main.php">ImCrate </a>
    <?php
    if($_SESSION['admin'])
    {
        
    ?>

    <div id="admin">
        <p>
        Admin
        </p>

        <p>
        <form action="controleur/admin/log_out_admin.php" method="post">
        </p>
       
        </p>
        Log out admin
        <input type="submit" value="Valider" />
        </p>
         
        </form>

    </div>    

    <?php    
    }

    ?>
    </h1>
	</header>
	
	<body>