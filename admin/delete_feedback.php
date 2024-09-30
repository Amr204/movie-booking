<?php
require('../config.php');
$n=$_GET['feed'];
$sql = "delete from feedback where id = $n ";
$exe = mysqli_query($conn,$sql);
if(!$exe)
{
    echo "error" . mysqli_error($conn);
}
header("location:feedback.php");
mysqli_close($conn);
?>