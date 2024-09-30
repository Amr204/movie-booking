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
    <h2>Edit movie</h2>
    <hr>



            <?php

if(isset($_GET['movie'])){
    $id = $_GET['movie'];
    require_once('../config.php');
    $sql = "select * from add_movie where id = $id";
    $exe = mysqli_query($conn, $sql);
    if (!$exe) {
    die("Selected Erorr" . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($exe);
if(isset($_POST['edit_movie']))
{
 	$e_id= $_POST['e_id'];
 	$edit_movie_name= $_POST['edit_movie_name'];
 	$edit_directer_name= $_POST['edit_directer_name'];	
	$edit_categroy= $_POST['edit_category'];
	$edit_language= mysqli_real_escape_string($conn,$_POST['edit_language']);
	$tailer= $_POST['edit_tailer'];
	$action= $_POST['edit_action'];
	$decription= $_POST['decription'];
	$edit_show= mysqli_real_escape_string($conn,implode(',',$_POST['show']));
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



		$insert_record=mysqli_query($conn, "UPDATE `add_movie` SET `movie_name` = '$edit_movie_name', `directer` = '$edit_directer_name', `categroy` = '$edit_categroy', `language` = '$edit_language',`you_tube_link` = '$tailer',`action` = '$action',`decription` = '$decription', `show` = '$edit_show', `image` = '$image' WHERE `id` = '$e_id'"); 

	if(!$insert_record){
	 	echo "unsuccesfull";
	}
	else
{
	echo "<script> window.location.href='Add-movie.php' </script>";
}}}
  
    ?>






















             

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="insert_movie" action="insert_data.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Movie Name</label>
                <input type="hidden" name="e_id" value="<?php echo $row['id'];?>">
                <input class="form-control" name="edit_movie_name" id="edit_movie_name" value="<?php echo $row['movie_name'];?>">
                <small></small>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Directer Name</label>
                <input class="form-control" name="edit_directer_name" id="edit_directer_name" value="<?php echo $row['directer'];?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>category</label>
                <input class="form-control" name="edit_category" id ="edit_category" value="<?php echo $row['categroy']; ?>">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>language</label>
                <input type="text" name="edit_language" id="edit_language" class="form-control" value="<?php echo $row['language'];?>">
              </div>
            </div>

            <!-- Time -->
            <div class="col-12">
              <div class="form-group">
                <label>Time</label>
                  <?php
                 
                  $seats = explode(",", $row['show']);
                $sql = mysqli_query($conn,"SELECT * FROM theater_show");
                if (mysqli_num_rows($sql) > 0) {
                  while($fatch = mysqli_fetch_array($sql)) {
                        $checked = $fatch['show'];
                    ?>
                    <font size="2"> <?php echo $fatch['show'];?></font><input type="checkbox" name="show[]" id="show" value="<?php echo $fatch['show'];?>" <?php
                         if(in_array($checked,$seats)){
                                    echo "checked";
                                }
                    ?>>
                
                    <?php
                  }
                }
              ?>
              </div>
            </div>
            <!-- Tailer -->
             <div class="col-12">
              <div class="form-group">
                <label>Tailer</label>
                <input type="text" name="edit_tailer" id="edit_tailer" class="form-control" value="<?php echo $row['you_tube_link'];?>">
              </div>
            </div>
            <!-- Action -->
             <div class="col-12">
              <div class="form-group">
                <label>Action</label>
                <select class="form-control" name="edit_action">
                  <option value="<?php echo $row['action'];?>"><?php echo $row['action'];?></option>
                  <option value="upcoming">upcoming</option>
                  <option value="running">running</option>                    
                </select>
              </div>
            </div>
            <!-- Description -->
            <div class="col-12">
              <div class="form-group">
                <label>Decription</label>
                <textarea type="text" name="decription" id="decription" class="form-control" value="<?php echo $row['decription'];?>">
                <?php echo $row['decription'];?></textarea>
              </div>
            </div> 
            <!-- Set of Time  -->
            <div class="col-12">
              <div class="form-group">
                <label>Image</label>
                <img src="image/<?php echo $row['image'];?>" width="10%">
                <input type="file" name="edit_img" id="edit_img" class="form-control">
                <input type="hidden" name="old_image" value="<?php echo $row['image'];?>" id="old_image" class="form-control">              
              </div>
            </div>
            
            <input type="hidden" name="add_product" value="1">
            <div class="col-12">
            
              <input type="submit" name="updatemovie" id="updatemovie" value="update" class="btn btn-primary">
            </div>
          </div>
          
        </form>
        <div id="preview"></div>
      </div>
    </div>
  </div>
</div> 
  <?php

  
  