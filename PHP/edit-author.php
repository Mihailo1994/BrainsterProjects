<?php

require_once('db.php');
require_once('functions.php');

checkRequest('../index.php');

$id = $_POST['id'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$bio = $_POST['bio'];

$data = [
    'name' => $name,
    'surname' => $surname,
    'bio' => $bio,
    'id' => $id
];

$sqlEdit = $connection->prepare("UPDATE authors SET name = :name, surname = :surname, biography = :bio WHERE id = :id");
$sqlEdit->execute($data);

header("Location: ../admin-page.php");

?>