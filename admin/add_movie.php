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









      <!-- Add Product Modal start -->

      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Movie</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form name="myform" id="insert_movie" action="insert_data.php" method="post" enctype="multipart/form-data"
              onsubmit="return validateform()">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Movie Name</label>
                    <input class="form-control" name="movie_name" id="movie_name" placeholder="movie name">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Directer Name</label>
                    <input class="form-control" name="directer_name" id="directer_name" placeholder="Directer name">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Release Date</label>
                    <input class="form-control" name="release_date" id="release_date" placeholder="Release Date">
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group">
                    <label>category</label>
                    <br>
                    <select class="form-control" name="category" id="category">
                      <option value="General">General</option>
                      <option value="Action">Action</option>
                      <option value="Horror">Horror</option>
                      <option value="Drama">Drama</option>
                      <option value="Science Fiction">Science Fiction</option>
                      <option value="Romantic">Romantic</option>
                      <option value="Fantasy">Fantasy</option>
                      <option value="Epic">Epic</option>

                    </select>
                  </div>
                </div>



                <div class="col-12">
                  <div class="form-group">
                    <label>Language</label>
                    <br>
                    <select class="form-control" name="language" id="language">
                      <option value="English">English</option>
                      <option value="Spanish">Spanish</option>
                      <option value="Franch">Franch</option>
                      <option value="German">German</option>
                      <option value="Arabic">Arabic</option>
                    </select>
                  </div>
                </div>


                <div class="col-12">
                  <div class="form-group">
                    <label>Theater 1</label>

                    <?php
                    require('../config.php');
                    $result = mysqli_query($conn, "SELECT * FROM theater_show");
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_array($result)) {
                        if ($row['theater'] == 1) {

                          ?>
                          <font size="2">
                            <?php echo $row['show']; ?>
                          </font><input type="checkbox" name="show[]" id="show" value="<?php echo $row['show']; ?>">

                          <?php
                        }
                      }
                    }
                    ?>

                  </div>

                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Theater 2</label>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM theater_show");
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_array($result)) {
                        if ($row['theater'] == 2) {

                          ?>
                          <font size="2">
                            <?php echo $row['show']; ?>
                          </font><input type="checkbox" name="show[]" id="show" value="<?php echo $row['show']; ?>">

                          <?php
                        }
                      }
                    }
                    ?>

                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Tailer</label>
                    <input type="text" name="tailer" id="tailer" class="form-control" placeholder="Enter Tailer">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Action</label>
                    <select class="form-control" name="action" id="action">
                      <option value="">Action</option>
                      <option value="upcoming">upcoming</option>
                      <option value="running">running</option>
                    </select>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Decription</label>
                    <textarea type="text" name="decription" id="decription" class="form-control">
                </textarea>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Uplode Poster</label>
                    <input type="file" name="img" value="img" id="img" class="form-control">
                  </div>
                </div>
                <input type="hidden" name="add_product" value="1">
                <div class="col-12">

                  <input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary">
                </div>
              </div>

            </form>
            <div id="preview"></div>
          </div>
        </div>
      </div>
    </div>