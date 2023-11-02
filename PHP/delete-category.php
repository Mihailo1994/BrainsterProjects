<?php

require_once('db.php');
require_once('functions.php');

checkRequest('../index.php');

$id = $_POST['id'];

$sqlDelete = $connection->prepare("UPDATE categories SET is_deleted = 1 WHERE id = :id");
$sqlDelete->bindParam("id", $id);
$sqlDelete->execute();

header("Location: ../admin-page.php");


?>