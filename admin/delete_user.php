<?php
require('../config.php');
$n=$_GET['user'];
$sql = "delete from user where id = $n ";
$exe = mysqli_query($conn,$sql);
if(!$exe)
{
    echo "error" . mysqli_error($conn);
}
header("location:users.php");
mysqli_close($conn);
?>