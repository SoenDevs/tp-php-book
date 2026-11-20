<?php
require_once 'models/Book.php';
require_once 'models/User.php';
require_once 'models/Like.php';

$book = getBook($_GET['id']);
if (!$book) {
    header("Location: bookList.php");
    exit();
}

$currentUser = getUserByEmail($_SESSION['email']);

$owner = getUser($book->id_users);

$isOwner = $currentUser->id == $book->id_users;

if (isset($_POST['like'])) {
    if (isLiked($book->id, $currentUser->id)) {
        deleteLike($book->id, $currentUser->id);
    } else {
        newLike($book->id, $currentUser->id);
    }
    header("Location: book.php?id=" . $book->id);
    exit();
}

if (isset($_POST['delete']) && $isOwner) {
    deleteBook($book->id);
    header("Location: bookList.php");
    exit();
}

$liked = isLiked($book->id, $currentUser->id);
$nbLikes = count(getLikes($book->id));
