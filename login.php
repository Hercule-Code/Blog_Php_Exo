<?php

session_start();

$error = false;
$message = '';

if (!empty($_POST)) {
    //var_dump($_POST);
    require "app/config.php";

    $query = $pdo->prepare(
            'SELECT * FROM utilisateurs WHERE mail= ?'
        );

    $query->execute([$_POST['mail']]);
    /* parametre la forme de la reponse à ma query ici sous forme d'un tableau à 1 dimension */
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user == false) {

        $error = true;
        $message = "Votre adresse mail n'existe pas...";
    } else if ($user['mail'] == $_POST['mail'] && password_verify($_POST['mdp'], $user['mdp'])) {

        //var_dump('connecté');
        $_SESSION['id'] = $user['id_utilisateur'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['pseudo'] = $user['pseudo'];
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['mdp'] = $user['mdp'];
        header('Location:list.php');
    } else {
        $error = true;
        $message = "Votre mot de passe est incorrect...";
    }
}


include "templates/login.html";
