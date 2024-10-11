<?php
require('../config.php');
$n=$_GET['user'];
$sql = "delete from user where id = ? ";
$exe = mysqli_execute_query($conn,$sql, [$n]);
if(!$exe)
{
    echo "error" . mysqli_error($conn);
}
header("location:users.php");
mysqli_close($conn);
?>