<?php

require_once('db.php');
require_once('functions.php');
checkRequest('../index.php');

$name = $_POST['name'];
$surname = $_POST['surname'];
$bio = $_POST['bio'];

$sqlInsert = $connection->prepare("INSERT INTO authors (name, surname, biography, is_deleted) VALUES (:name, :surname, :bio, 0)");
$sqlInsert->bindParam("name", $name);
$sqlInsert->bindParam("surname", $surname);
$sqlInsert->bindParam("bio", $bio);
$sqlInsert->execute();

header("Location:../admin-page.php");

?>