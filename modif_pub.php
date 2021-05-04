<?php
session_start();
include 'app/config.php';

if (empty($_POST)) {
    // Validation de la query string dans l'URL.
    if (!array_key_exists('id', $_GET) or !ctype_digit($_GET['id'])) {
        header('Location: list.php');
        exit();
    }

    // Récupération d'une publication.
    $query =
        '
            SELECT
                id_publication,
                titre,
                contenu
            FROM
                publications
            WHERE
                id_publication = ?
        ';
    $resultSet = $pdo->prepare($query);
    $resultSet->execute([$_GET['id']]);
    $publication = $resultSet->fetch();

    // Sélection et affichage du template 
    include 'templates/modif_pub.html';
} else {
    // Edition d'une publication du blog.
    $query =
        '
            UPDATE
                publications
            SET
                titre = ?,
                contenu = ?
            WHERE
                id_publication = ?
        ';
    $resultSet = $pdo->prepare($query);
    $resultSet->execute([$_POST['titre'], $_POST['contenu'], $_POST['idpublication']]);

    // Retour a la liste des publications
    header('Location: list.php');
    exit();
}
