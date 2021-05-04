<?php

session_start();

include 'app/config.php';

//var_dump($_POST);

$query = $pdo->prepare(
	' INSERT INTO
            commentaires
            (titre, contenu,id_publication, dateDeCreation)
        VALUES
            (:titre, :contenu, :publicationId, NOW())'
	);


$query->bindParam(':titre', $_POST['titre'], PDO::PARAM_STR);
$query->bindParam(':contenu', $_POST['contenu'], PDO::PARAM_STR);
$query->bindParam(':publicationId', $_POST['publicationId'], PDO::PARAM_STR);
$query->execute();

header('Location: detail_pub.php?id='.$_POST['publicationId']);
exit();


/*
$query = $pdo->prepare(
	' INSERT INTO
            commentaires
            (titre, contenu,id_publication, dateDeCreation)
        VALUES
            (?, ?, ?, NOW())'
	);

$query->execute( [ $_POST['titre'], $_POST['contenu'], $_POST['publicationId'] ] );

header('Location: detail_pub.php?id='.$_POST['publicationId']);
exit();
*/



?>
