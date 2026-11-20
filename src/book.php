<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: index.php");
    exit();
}

require "controllers/bookCtrl.php";
$title =$book->name;
$link = '<link rel="stylesheet" href="assets/css/bookList.css">';
require "ui/head.php";
?>

<body>
	<a href="bookList.php">← Retour à la liste</a>
	<h1><?=$book->name ?></h1>
	<p>
		Par
		<a href="profile.php?id=<?= $owner->id ?>">
			<?= $owner->firstname . " " . $owner->lastname ?>
		</a>
	</p>
	<p><?= $book->description ?></p>
	<p><?= $nbLikes ?> like(s)</p>
	<form method="post">
		<button type="submit" name="like">
			<?= $liked ? 'Je n\'aime plus' : "Like" ?>
		</button>
	</form>
	<?php if ($isOwner): ?>
		<form method="post">
			<button type="submit" name="delete">Delete</button>
		</form>
	<?php endif; ?>
</body>
