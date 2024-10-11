<?php
include "config.php";

$email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email']));
$oldpassword = mysqli_real_escape_string($conn, htmlspecialchars($_POST['oldpassword']));
$newpassword = mysqli_real_escape_string($conn, htmlspecialchars($_POST['newpassword']));


$sql_query = "SELECT * FROM user WHERE email='?' and password='?'";
// $sql_query = "SELECT * FROM user WHERE email='" . $email . "' and password='" . $oldpassword . "'";
$result = mysqli_execute_query($conn, $sql_query, [$email, $oldpassword]);
$row = mysqli_fetch_array($result);
$id = $row['id'];
if ($row) {
    $insert_record = mysqli_execute_query(
        $conn,
        "UPDATE `user` SET `password` = '?' WHERE `id` = '?'",
        [$newpassword, $id]
    );
    echo 1;
} else {
    echo "<li>Invalid Username or password.</li>";
    exit();
}
