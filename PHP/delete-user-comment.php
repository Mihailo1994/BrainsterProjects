<?php

require_once('db.php');
require_once('functions.php');

checkRequest('../index.php');

session_start();


$userId = $_POST['userId'];
$bookId = $_POST['bookId'];
$id = $_SESSION['bookpage'];

$sqlDelete = $connection->prepare("DELETE FROM comments WHERE book_id = :bookId AND user_id = :userId");
$sqlDelete->bindParam('bookId', $bookId);
$sqlDelete->bindParam('userId', $userId);
$sqlDelete->execute();

header("Location: ../book.php?book=$id");

?>