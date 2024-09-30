<?php
require('../config.php');
$n=$_GET['movie'];
$sql = "delete from add_movie where id = $n ";
$exe = mysqli_query($conn,$sql);
if(!$exe)
{
    echo "error" . mysqli_error($conn);
}
header("location:Add-movie.php");
mysqli_close($conn);
?>