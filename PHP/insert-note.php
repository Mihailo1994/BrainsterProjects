<?php

require_once('db.php');
require_once('functions.php');
checkRequest('../admin-page.php');

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$bookId = $data['bookId'];
$userId = $data['userId'];
$note = $data['note'];

$sqlInsert = $connection->prepare("INSERT INTO notes (note, book_id, user_id) VALUES (:note, :bookId, :userId)");
$sqlInsert->bindParam('note', $note);
$sqlInsert->bindParam('bookId', $bookId);
$sqlInsert->bindParam('userId', $userId);
$sqlInsert->execute();

$sqlSelect = $connection->prepare("SELECT * FROM notes WHERE book_id = :bookId AND user_id = :userId");
$sqlSelect->bindParam('bookId', $bookId);
$sqlSelect->bindParam('userId', $userId);
$sqlSelect->execute();
$notes = $sqlSelect->fetchAll();

echo json_encode($notes);





?>