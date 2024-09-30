<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Movies Page</title>

    <?php session_start();
    if (!isset($_SESSION['admin'])) {
        header("location:login.php");
    }
    ?>
    
    <?php   require_once('../config.php'); ?>
    <?php include_once("./templates/top.php"); ?>
    <?php include_once("./templates/navbar.php"); ?>
    <div class="container-fluid">
        <div class="row">

            <?php include "./templates/sidebar.php"; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Edit user</h2>
    <hr>





<?php
if(isset($_GET['user'])){
    $id = $_GET['user'];
    require_once('../config.php');
    $sql = "select * from user where id = $id";
    $exe = mysqli_query($conn, $sql);
    if (!$exe) {
    die("Selected Erorr" . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($exe);
if(isset($_POST['edit_user']))
{
 	$e_id= $_POST['e_id'];
 	$edit_Username= $_POST['edit_username'];
 	$edit_email= $_POST['edit_email'];	
	$edit_mobile= $_POST['edit_mobile'];
	$edit_city= $_POST['edit_city'];
	$edit_password= $_POST['edit_password'];
	$edit_old_image= $_POST['old_image'];
	$edit_filename=$_FILES['edit_img']['name'];

if($edit_filename != ''){
	$image=$edit_filename;
	$location='image/'.$image;



$file_extension=pathinfo($location,PATHINFO_EXTENSION);
$file_extension=strtolower($file_extension);
$image_ext=array('jpg','png','jpeg','gif');

$response=0;

if(in_array($file_extension,$image_ext)){
	if(move_uploaded_file($_FILES['edit_img']['tmp_name'],$location)){
		$response=$location;
	}
}
echo $response;


}else{
	$image=$edit_old_image;
}



		$update_record=mysqli_query($conn, "UPDATE `user` SET `username` = '$edit_Username', `email` = '$edit_email', `mobile` = '$edit_mobile', `city` = '$edit_city',`password` = '$edit_password', `image` = '$image' WHERE `id` = '$e_id'"); 

	if(!$update_record){
	 	echo "unsuccesfull";
	}
	else
{
echo "<script> window.location.href='users.php' </script>";
}

}}

?>




















    

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="insert_movie" action="insert_data.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Name</label>
                <input type="hidden" name="e_id" value="<?php echo $row['id'];?>">
                <input class="form-control" name="edit_username" id="edit_username" value="<?php echo $row['username'];?>">
                <small></small>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Email</label>
                <input class="form-control" name="edit_email" id="edit_email" value="<?php echo $row['email'];?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>mobile</label>
                <input type="number" class="form-control" name="edit_mobile" id ="edit_mobile" value="<?php echo $row['mobile']; ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>city</label>
                <input class="form-control" name="edit_city" id ="edit_city" value="<?php echo $row['city']; ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>passord</label>
                <input class="form-control" name="edit_password" id ="edit_password" value="<?php echo $row['password']; ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Image</label>
                <img src="image/<?php echo $row['image'];?>" width="10%">
                <input type="file" name="edit_img" id="edit_img" class="form-control">
                <input type="hidden" name="old_image" value="<?php echo $row['image'];?>" id="old_image" class="form-control">              
              </div>
            </div>
            <div class="col-12">
            
              <input type="submit" name="updateusers" id="updateusers" value="update" class="btn btn-primary">
            </div>
          </div>
          
        </form>
        <div id="preview"></div>
      </div>
    </div>
  </div>
</div> 