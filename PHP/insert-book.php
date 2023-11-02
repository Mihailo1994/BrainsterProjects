<?php

require_once('db.php');
require_once('functions.php');

checkRequest('../index.php');

$data = [
    'title' => $_POST['title'],
    'author' => $_POST['author-id'],
    'year' => $_POST['year'],
    'pages' => $_POST['pages'],
    'picture' => $_POST['picture'],
    'category' => $_POST['category'],
];

$sqlInsert = $connection->prepare("INSERT INTO books (title, author_id, release_year, number_of_pages, picture, category_id) VALUES (:title, :author, :year, :pages, :picture, :category)");
$sqlInsert->execute($data);

header("Location:../admin-page.php");

?>