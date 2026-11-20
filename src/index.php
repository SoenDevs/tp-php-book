<?php
session_start();
if (isset($_SESSION["email"])) {
    header("Location: bookList.php");
    exit();
}
require "controllers/indexCtrl.php";
$title = "Connexion";
$link = '<link rel="stylesheet" href="assets/css/index.css">';
require "ui/head.php";
?>

<body>
	<h1>Création</h1>
	<form method="post">
		<label for="firstname">Prénom</label>
		<?php if (isset($error["firstname"])): ?>
			<p style="color: red;"><?= $error["firstname"] ?></p>
		<?php endif; ?>
		<input id="firstname" type="text" name="firstname" placeholder="Prénom" required>
		<label for="lastname">Nom</label>
		<?php if (isset($error["lastname"])): ?>
			<p style="color: red;"><?= $error["lastname"] ?></p>
		<?php endif; ?>
		<input id="lastname" type="text" name="lastname" placeholder="Nom" required>
		<label for="email">Email</label>
		<?php if (isset($error["email"])): ?>
			<p style="color: red;"><?= $error["email"] ?></p>
		<?php endif; ?>
		<input id="email" type="email" name="email" placeholder="Email" required>
		<label for="password">Mot de passe</label>
		<?php if (isset($error["password"])): ?>
			<p style="color: red;"><?= $error["password"] ?></p>
		<?php endif; ?>
		<input id="password" type="password" name="password" placeholder="Mot de passe" required>
		<label for="confirmPassword">Confirmation du mot de passe</label>
		<?php if (isset($error["confirmPassword"])): ?>
			<p style="color: red;"><?= $error["confirmPassword"] ?></p>
		<?php endif; ?>
		<input id="confirmPassword" type="password" name="confirmPassword" placeholder="Mot de passe" required>
		<button type="submit" name="register">Créer un compte</button>
	</form>

	<h1>Connexion</h1>
	<form method="post">
		<?php if (isset($error["login"])): ?>
			<p style="color: red;"><?= $error["login"] ?></p>
		<?php endif; ?>
		<label for="login_email">Email</label>
		<input id="login_email" type="email" name="login_email" placeholder="Email" required>
		<label for="login_password">Mot de passe</label>
		<input id="login_password" type="password" name="login_password" placeholder="Mot de passe" required>
		<button type="submit" name="login">Se connecter</button>
	</form>
</body>

</html>
