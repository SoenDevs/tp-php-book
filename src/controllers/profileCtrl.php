<?php
require_once 'models/User.php';
require_once 'models/Book.php';
require_once 'models/Like.php';

$currentUser = getUserByEmail($_SESSION['email']);

if (isset($_GET['id'])) {
    $profileUser = getUser($_GET['id']);
} else {
    $profileUser = $currentUser;
}
if (!$profileUser) {
    header("Location: bookList.php");
    exit();
}

$isMe = $currentUser->id == $profileUser->id;

if (isset($_POST['delete_book']) && $isMe) {
    $book = getBook($_POST['book_id']);
    if ($book && $book->id_users == $currentUser->id) {
        deleteBook($book->id);
    }
    header("Location: profile.php?id=" . $profileUser->id);
    exit();
}

if (isset($_POST['delete_account']) && $isMe) {
    deleteUser($currentUser->id);
    session_destroy();
    header("Location: index.php");
    exit();
}

$createdBooks = getBooksOfUser($profileUser->id);

$likedBooks = [];
foreach (getBooks() as $book) {
    if (isLiked($book->id, $profileUser->id)) {
        $likedBooks[] = $book;
    }
}