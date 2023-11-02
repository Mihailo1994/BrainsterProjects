<?php

$name = $_POST["name"];
$companyName = $_POST["companyName"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$student = $_POST["student"];


$host = "localhost";
$dbname = "employment";
$username = "root";
$password = "";


$conn = mysqli_connect(hostname: $host, username: $username, password: $password, database: $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}


$sql = "INSERT INTO company(name, company_name, email, phone_number, student_type) VALUES ('$name','$companyName','$email','$phone','$student')";



if(mysqli_query($conn, $sql)){
    echo "<h3>Успешно aплицирање</h3>";
} else {
    echo "<h3>Error</h3>";
}