<?php
// Contrôleur de bookList.php : récupère tous les livres du site
require_once 'models/Book.php';

$books = getBooks();
