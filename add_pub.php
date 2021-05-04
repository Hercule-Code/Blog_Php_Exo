<?php
session_start();
include 'app/config.php';


$query = $pdo->prepare
	(
	    'SELECT
	        *
	     FROM categories'
	);

	$query->execute();
	$categories = $query->fetchAll(PDO::FETCH_ASSOC);

if(empty($_POST) == false){

	$query = $pdo->prepare('
		INSERT INTO 
		publications (titre, contenu, id_categorie, id_utilisateur, dateDeCreation)
		VALUES (?, ?, ?, "'.$_SESSION['id'].'", NOW())
        ');

	$query->execute(array($_POST['titre'],$_POST['contenu'], $_POST['categorie']));

	
}

	include 'templates/add_pub.html';







