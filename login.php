<?php
include "config.php";
session_start();
if ($_POST['username'] == '' || $_POST['password'] == '') {
    foreach ($_POST as $key => $value) {
        echo "<li>Please Enter " . $key . ".</li>";
    }
    exit();
}
$uname = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
$password =  mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));

$sql_query = "SELECT count(*) as cntUser FROM user WHERE username='?' and password='?'";
$result = mysqli_execute_query($conn, $sql_query, [$uname, md5($password)]);
$row = mysqli_fetch_array($result);
$count = $row['cntUser'];
if ($row) {
    if ($count > 0) {
        $_SESSION['uname'] = $uname;
        echo 1;
    }
} else {
    echo "<li>Invalid Username or password.</li>";
    exit();
}
