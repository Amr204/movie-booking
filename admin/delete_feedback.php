<?php
require('../config.php');
$n = $_GET['feed'];
$sql = "delete from feedback where id = ? ";
$exe = mysqli_execute_query($conn, $sql, [$n]);
if (!$exe) {
    echo "error" . mysqli_error($conn);
}
header("location:feedback.php");
mysqli_close($conn);
