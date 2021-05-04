<?php
session_start();
require "app/config.php";

// prepare requete sql
//https://sql.sh/fonctions/date_format
$query = $pdo->prepare('
	SELECT titre,contenu, DATE_FORMAT(dateDeCreation,"%e-%m-%Y") as creaDate,id_publication
	FROM publications
	ORDER BY creaDate DESC
	LIMIT 5');

/*envoyer la requête à MySQL pour exécution.*/
$query->execute();

$publications = $query->fetchAll(PDO::FETCH_ASSOC);

/* J'indique e template dans lequel je veux afficher le resultat de ma requete */

include 'templates/list.html';
