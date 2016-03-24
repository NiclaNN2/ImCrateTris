<?php
session_start();

?>

<div id="feedback">

<?php
	try
	{
	    $bdd = new PDO('mysql:host=localhost;dbname=Imcrate', 'root', 'root');
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}

	$req4 = $bdd->query('SELECT feedback FROM feedback');

	while ($donnees = $req4->fetch())
		{
		
		$message = $donnees['feedback'];

		?>

		<p> 
		<strong> Feedback </strong>
		</p>
		<p>
			<?php
			echo $message . '<br/>';
			?>
		</p>
			<?php
		}
	
	$req4->closeCursor();

?>
</div>