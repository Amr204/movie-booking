<?php
require('../config.php');
$n=$_GET['movie'];
$sql = "delete from add_movie where id = ? ";
$exe = mysqli_execute_query($conn,$sql, [$n]);
if(!$exe)
{
    echo "error" . mysqli_error($conn);
}
header("location:Add-movie.php");
mysqli_close($conn);
?>