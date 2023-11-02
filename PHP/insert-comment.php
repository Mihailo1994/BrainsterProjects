<?php


require_once('db.php');
require_once('functions.php');
checkRequest('../index.php');

$userId = $_POST['userId'];
$bookId = $_POST['bookId'];
$comment = $_POST['comment'];

$data = [
    'bookId' => $bookId,
    'userId' => $userId,
    'comment' => $comment
];

$sqlInsert = $connection->prepare("INSERT INTO comments (book_id, user_id, comment) VALUES (:bookId, :userId, :comment)");
$sqlInsert->execute($data);

header("Location:../book.php?book=$bookId&success=Thank you for your comment");



?>