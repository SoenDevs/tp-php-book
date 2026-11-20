<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: index.php");
    exit();
}

require "controllers/profileCtrl.php";
$title = "Profil";
$link = '<link rel="stylesheet" href="assets/css/profile.css">';
require "ui/head.php";
?>

<body>
	<a href="bookList.php">← Retour à la liste</a>

	<h1><?= $profileUser->firstname . " " . $profileUser->lastname ?></h1>

	<h2>Livres créés</h2>
	<?php if (empty($createdBooks)): ?>
		<p>Aucun livre créé.</p>
	<?php else: ?>
		<ul>
			<?php foreach ($createdBooks as $book): ?>
				<li>
					<a href="book.php?id=<?= $book->id ?>"><?= $book->name ?></a>
					<?php if ($isMe): ?>
						<form method="post" style="display: inline;">
							<input type="hidden" name="book_id" value="<?= $book->id ?>">
							<button type="submit" name="delete_book">Supprimer</button>
						</form>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<h2>Livres likés</h2>
	<?php if (empty($likedBooks)): ?>
		<p>Aucun livre liké.</p>
	<?php else: ?>
		<ul>
			<?php foreach ($likedBooks as $book): ?>
				<li><a href="book.php?id=<?= $book->id ?>"><?= $book->name ?></a></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>

	<?php if ($isMe): ?>
		<form method="post" onsubmit="return confirm('Supprimer définitivement ton compte ?');">
			<button type="submit" name="delete_account">Supprimer mon compte</button>
		</form>
	<?php endif; ?>
</body>

