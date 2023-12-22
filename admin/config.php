<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "safs";

$conn = mysqli_connect($server, $username, $password, $database);

if(!$conn){
    die("<script>alert('failed')</script>");
}
?>