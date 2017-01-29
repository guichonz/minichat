<?php
session_start();
$pseudo = htmlspecialchars($_POST['pseudo']);
$_SESSION['nom']=$pseudo;
$message = htmlspecialchars($_POST['message']);
try
{
    $bdd = new PDO('mysql:host=sql.free.fr;dbname=minichat;charset=utf8', '**', '**');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$req = $bdd->prepare('INSERT INTO minichat(pseudo, message) VALUES(:pseudo, :message)');
$req->execute(array(
	'pseudo' => $pseudo,
	'message' => $message,
	));
header('Location: minichat.php');
?>