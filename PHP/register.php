<?php

require_once('db.php');
require_once('functions.php');

checkRequest('../index.php');

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$sqlSelect = $connection->prepare("SELECT * FROM users WHERE username = :username");
$sqlSelect->bindParam("username", $username);
$sqlSelect->execute();

if ($sqlSelect->rowCount() == 0){
    if(strlen($password) < 4) {
        header("Location:../register-page.php?errorPassword=password must be at least 4 letters");
        die();
    }

    if(strlen($username) < 4) {
        header("Location:../register-page.php?errorUsername=username must be at least 4 letters");
        die();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sqlInsert = $connection->prepare("INSERT INTO users (username, password, admin) VALUES (:username, :password, 0)");
    $sqlInsert->bindParam("username", $username);
    $sqlInsert->bindParam("password", $password_hash);
    $sqlInsert->execute();

    $sqlSelectId = $connection->prepare("SELECT id FROM users WHERE username = :username");
    $sqlSelectId->bindParam("username", $username);
    $sqlSelectId->execute();

    $user = $sqlSelectId->fetch();

    $_SESSION['username'] = $username;
    $_SESSION['userId'] = $user['id'];

    if (!empty($_SESSION['bookpage'])) {
        $id = $_SESSION['bookpage'];
        header("Location:../book.php?book=$id");
        die();
    } else {
        header("Location:../index.php");
        die();
    }

} else {
    header("Location:../register-page.php?errorUsername=username is taken");
    die();
}



?>