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

    <?php include_once("./templates/top.php"); ?>
    <?php include_once("./templates/navbar.php"); ?>
    <div class="container-fluid">
        <div class="row">

            <?php include "./templates/sidebar.php"; ?>



<!-- Add show -->

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="myform" id="insert_movie" action="insert_data.php" method="post" enctype="multipart/form-data" onsubmit="return validateform()" >
          
            <div class="col-12">
              <div class="form-group">
                <label>theater-name</label>
                <select class="form-control" name="theater_name" id="theater_name">
                  <option value="">theater name</option>
                  <option value="1">1</option>
                  <option value="2">2</option>                    
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Enter Show</label>
                <input type="time" name="show" id="show">
              </div>
            </div>
            
            
            <input type="hidden" name="add_product" value="1">
            <div class="col-12">
            
              <input type="submit" name="addshow" id="addshow" value="submit" class="btn btn-primary">
            </div>
          
          
        </form>
        
      </div>
    </div>
  </div>
</div>

<!-- done -->


<?php include_once("./templates/footer.php"); ?>



<script>  
function validateform(){  
var theater_name=document.myform.theater_name.value;  
var show=document.myform.show.value;  


if (theater_name==""){  
  alert("Reqiure theater name");  
  return false;  
}
else if(show==""){  
  alert("Reqiure Enter show");  
  return false;  
  }  

}


</script>  