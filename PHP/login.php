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



if ($sqlSelect->rowCount() == 1) {
    $user = $sqlSelect->fetch();
    if (password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['userId'] = $user['id'];
        if ($user['admin'] === 1) {
            $_SESSION['admin'] = true;
            header("Location:../admin-page.php");
        } else {
            if (!empty($_SESSION['bookpage'])) {
                $id = $_SESSION['bookpage'];
                header("Location:../book.php?book=$id");
            } else {
                header("Location:../index.php");
            }
        }
    } else {
        header("Location:../login-page.php?err=Wrong username or password");        
    }
} else {
    header("Location:../login-page.php?err=Wrong username or password");        
}


?>