<?php

require_once('db.php');
require_once('functions.php');

checkRequest('../index.php');

$data = [
    'id' => $_POST['id'],
    'title' => $_POST['title'],
    'author' => $_POST['author-id'],
    'year' => $_POST['year'],
    'pages' => $_POST['pages'],
    'picture' => $_POST['picture'],
    'category' => $_POST['category'],
];


$sqlEdit = $connection->prepare("UPDATE books SET title = :title, author_id = :author, release_year = :year, number_of_pages = :pages, picture = :picture, category_id = :category WHERE id = :id");
$sqlEdit->execute($data);

header("Location:../admin-page.php");

?>