<?php

require_once('db.php');
require_once('functions.php');

checkRequest('../admin-page.php');

$json = file_get_contents("php://input");
$data = json_decode($json, true);

$id = $data['id'];

$sqlSelect = $connection->prepare("SELECT * FROM authors WHERE id = :id");
$sqlSelect->bindParam("id", $id);
$sqlSelect->execute();

$authorData = $sqlSelect->fetch();

echo json_encode($authorData);


?>



