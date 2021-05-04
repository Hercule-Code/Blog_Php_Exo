<!DOCTYPE html>
<html>
<head>
	<title>mon Blog</title><!-- a rendre dynamique -->
	
	<meta charset="utf-8">
</head>
<body>
<header>
<h1><a href="list.php">MON SUPER BLOG </a></h1>
</header>
<?php if(array_key_exists('pseudo', $_SESSION) == true): ?>

	<h2> bonjour <?= $_SESSION['pseudo'] ?></h2>
	<nav class="txtend top">
		<a href="add_pub.php">Publier un article</a>
		<a href="logout.php">deconnexion</a>
	</nav>

<?php else : ?>

	<nav class="txtend top">
		<a href="register.php">S'inscrire</a>
		<a href="login.php">Se connecter</a>	
	</nav>

<?php endif; ?>
