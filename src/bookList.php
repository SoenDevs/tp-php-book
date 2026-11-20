<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: index.php");
    exit();
}

require "controllers/bookListCtrl.php";
$title = "Liste des livres";
$link = '<link rel="stylesheet" href="assets/css/bookList.css">';
require "ui/head.php";
?>

<body>
	<h1>Tous les livres</h1>

	<?php foreach ($books as $book): ?>
    <li>
        <a href="book.php?id=<?= $book->id ?>">
            <?= htmlspecialchars($book->name) ?>
        </a>
        (<?= $book->nb_likes ?> likes)
    </li>
	<?php endforeach; ?>
</body>

</html>