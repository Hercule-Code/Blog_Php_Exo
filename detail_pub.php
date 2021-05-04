<?php
session_start();
// Validation de la query string dans l'URL.
if (!isset($_GET['id']) || !ctype_digit($_GET['id']) | $_GET['id'] < 1) {
    header('Location:list.php');
    exit();
}

include 'app/config.php';

// Récupération une publication.
$query =
    '
        SELECT
            publications.id_publication,
            titre,
            contenu,
            dateDeCreation,
            pseudo,
            nom,
            prenom
        FROM
            publications
        INNER JOIN
            utilisateurs
        ON
            publications.id_utilisateur = utilisateurs.id_utilisateur
        WHERE
            id_publication = ?
    ';
$resultSet = $pdo->prepare($query);
$resultSet->execute([$_GET['id']]);
$post = $resultSet->fetch();

// Récupération de tous les commentaires lié à la publication.
$query =
    '
        SELECT
            titre,
            contenu,
            dateDeCreation
        FROM
            commentaires
        WHERE
            id_publication = ?
    ';
$resultSet = $pdo->prepare($query);
$resultSet->execute([$_GET['id']]);
$commentaires = $resultSet->fetchAll();

// Sélection et affichage dans le template HTML.
include 'templates/detail_pub.html';
