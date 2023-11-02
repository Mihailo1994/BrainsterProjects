<?php

require_once('db.php');
require_once('functions.php');

checkRequest('../index.php');

$id = $_POST['id'];
$name = $_POST['name'];

$sqlEdit = $connection->prepare("UPDATE categories SET name = :name WHERE id = :id");
$sqlEdit->bindParam("id", $id);
$sqlEdit->bindParam("name", $name);
$sqlEdit->execute();

header("Location:../admin-page.php");


?>