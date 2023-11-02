<?php

require_once('db.php');
require_once('functions.php');
checkRequest('../index.php');

$name = $_POST['name'];

$sqlInsert = $connection->prepare("INSERT INTO categories (name, is_deleted) VALUES (:name ,0)");
$sqlInsert->bindParam("name", $name);
$sqlInsert->execute();

header("Location:../admin-page.php");


?>