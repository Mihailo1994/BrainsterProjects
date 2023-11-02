<?php

try {
    $connection = new PDO("mysql:host=localhost;dbname=library", "root", '');
} catch (PDOException $e) {
    echo "Database down";
    die();
}

?>