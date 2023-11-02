<?php


require_once('db.php');
require_once('functions.php');

checkRequest('../index.php');

$id = $_POST['id'];
$status = $_POST['status'];

var_dump($id);
echo "<br>";
var_dump($status);
echo "<br>";


$query = "";
if ($status === "approve") {
    $query = "UPDATE comments SET is_approved = 1 WHERE id = $id";
} elseif ($status === "decline") {
    $query = "UPDATE comments SET is_approved = 0 WHERE id = $id";
}

$sqlUpdate = $connection->prepare($query);
$sqlUpdate->execute();

header("Location:../admin-page.php");



?>