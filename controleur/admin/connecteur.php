<?php
header('Location: ../../main.php');
session_start();

if (isset($_POST['pass']) AND isset($_POST['email']))
	{

	$pass = htmlspecialchars($_POST['pass']);
	$email = htmlspecialchars($_POST['email']);

	if(strlen($_POST['email']) == 0)
		{
		echo "Vous n'avez pas indiqué d'email." . '<br/>';
		?>
		<p>
		<a href="../../admin.php">Retour à la page admin</a><br/>
		<p/>
		<?php
		}
	
	elseif(strlen($_POST['pass']) == 0)
		{
		echo "Vous n'avez pas indiqué de mot de passe" . '<br/>';
		?>
		<p>
		<a href="../../admin.php">Retour à la page admin</a><br/>
		<p/>
		<?php
		}
	
	else
		{
	
		if (($pass == 'gl1002ou$$WS') && ($email == 'zobizobi@hotmail.com')) 
		{
			echo "Vous êtes l'adiministrateur du site.";
			$_SESSION['admin'] = true;
		}
		else
		{
			echo "Vous n'êtes pas l'administrateur du site.";
		}


		}
}

else
{
	echo 'Il manque un mot de passe ou un pseudo' . '<br/>';
}

?>
<p>
<a href="../../main.php">Main</a><br/>
<p/>
