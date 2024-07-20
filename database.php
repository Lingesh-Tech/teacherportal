<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "teacher_portal";
$conn = mysqli_connect($hostName,$dbUser,$dbPassword,$dbName);

if (!$conn) {
    die("Something went wrong");
}

?>