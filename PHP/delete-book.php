<?php

require_once('functions.php');
require_once('db.php');

checkRequest('../admin-page.php');

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$id = $data['id'];

$sqlDeleteComments = $connection->prepare("DELETE FROM comments WHERE book_id = :id");
$sqlDeleteComments->bindParam('id', $id);
$sqlDeleteComments->execute();

$sqlDeleteBook = $connection->prepare("DELETE FROM books WHERE id = :id");
$sqlDeleteBook->bindParam('id', $id);
$sqlDeleteBook->execute();

echo json_encode('deleted');

?>



