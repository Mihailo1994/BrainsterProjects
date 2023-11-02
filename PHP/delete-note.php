<?php

require_once('db.php');
require_once('functions.php');

checkRequest('../admin-page.php');

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$bookId = $data['bookId'];
$userId = $data['userId'];
$noteId = $data['noteId'];

$sqlDelete = $connection->prepare("DELETE FROM notes WHERE id = :noteId");
$sqlDelete->bindParam('noteId', $noteId);
$sqlDelete->execute();

$sqlSelect = $connection->prepare("SELECT * FROM notes WHERE book_id = :bookId AND user_id = :userId");
$sqlSelect->bindParam('bookId', $bookId);
$sqlSelect->bindParam('userId', $userId);
$sqlSelect->execute();
$notes = $sqlSelect->fetchAll();

echo json_encode($notes);





?>