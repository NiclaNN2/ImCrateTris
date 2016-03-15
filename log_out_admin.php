<?php
session_start();
header('Location: main.php');

echo 'salut : ' . '<br/>';

$_SESSION['admin'] = false;

if ($_SESSION['admin']) 
{
	echo 'admin' . '</br>';
}
else
{
	echo 'pas admin' . '</br>';
}