<?php
session_start();

require "app/config.php";

$error = false;
$message = '';


if (!empty($_POST)) {

    /* TESTER ET VALIDER UN CHAMP */
    /* strlen — Calcule la taille d'une chaîne */

    /* ctype_alnum — Vérifie qu'une chaîne est alphanumérique */
    if (!isset($_POST['mdp']) || !ctype_alnum($_POST['mdp']) || strlen($_POST['mdp']) < 1) {
        $error = true;
        $message = "le champ mdp n'est pas valide.";
    }

    /* la fonction filter_var() avec l'argument | filter_var($_POST['pseudo'],FILTER_VALIDATE_EMAIL permet de valider une adresse mail */
    if (!isset($_POST['mail']) || filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) == false) {
        $error = true;
        $message = "le champ mail n'est pas valide.";
    }


    if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 1) {
        $error = true;
        $message = "le champ pseudo n'est pas valide.";
    }

    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 1) {
        $error = true;
        $message = "le champ prenom n'est pas valide.";
    }

    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 1) {
        $error = true;
        $message = "le champ nom n'est pas valide.";
    }


    /* SI IL N'Y A PAS D'ERREUR => ENVOIE DES DONNES DANS LA BASE DE DONNÉES => REQUETE INSERT INTO */
    if (!$error) {
        /* stock le mot entré dans l'input par l'utilisateur */
        $password = $_POST['mdp'];
        /* parametre la fonction qui va hacher le mot de passe entré par l'utulisateur 
    https://www.php.net/manual/fr/function.password-hash.php */
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        /* prepare ma requete sql insert into qui va permetre d'inserer les données dans la base de données
    INSERT INTO nomDelaTable (nomDesColonnes séparer par des virgules) VALUES (correspond aux valeurs à entrer dans les colonnes séparer par des virgules */
        $query = $pdo->prepare(
                'INSERT INTO utilisateurs(nom, prenom, pseudo, mail, mdp) VALUES (?, ?, ?, ?, ?)'
            );

        $query->execute([$_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['mail'], $hashPassword]);
        header('Location:login.php');
    }
}

/* le template correspondant à l'affichage du formulaire d'inscription */
include 'templates/register.html';
