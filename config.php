<?php
$server = 'localhost'; //127.0.0.1 or ip for hosting
$username = 'root';
$password = '';
$db_name = 'moviebook';

// $conn = @mysqli_connect($server,$username,$password,$db_name);
// if(!$conn){
//     die("Connect Error");
// }
$conn = @mysqli_connect($server, $username, $password, $db_name, 4306) or die("Connect Error");
// لدعم اللغة العربية
$conn->query("SET NAMES utf8");
$conn->query("SET CHARACTER SET utf8");
$conn->set_charset("utf8");
