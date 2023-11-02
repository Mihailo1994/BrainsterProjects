<?php

function checkRequest($url) {
    if($_SERVER['REQUEST_METHOD'] != "POST") {
        header("Location:$url");
    } 
}

?>