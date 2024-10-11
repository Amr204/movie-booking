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

      <div class="row">
        <div class="col-10">
          <h2>Add movie</h2>
        </div>
        <div class="col-2">
          <a href="add_movie.php" class="btn btn-primary btn-sm" role="button">Add Movie</a>
        </div>

      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>id</th>
              <th>Movie name</th>
              <th>Directer</th>
              <th>categroy</th>
              <th>language</th>
              <th>Show</th>
              <th>Image</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody id="product_list">
            <?php
            include_once 'config.php';
            $result = mysqli_query($conn, "SELECT * FROM add_movie");

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_array($result)) {
                $id = $row['id']; ?>
                <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['movie_name']; ?></td>
                  <td><?php echo $row['directer']; ?></td>
                  <td><?php echo $row['categroy']; ?></td>
                  <td><?php echo $row['language']; ?></td>

                  <td><?php echo $row['show']; ?></td>
                  <td><img src="image/<?php echo $row['image']; ?>" alt="" class="resize"></td>
                  <td> <a href='./edit_movie.php?movie=<?php echo $row['id']; ?>' class="btn btn-primary btn-sm" role="button">Edit movie</a></td>
                  <td> <a href='./delete_movie.php?movie=<?php echo $row['id']; ?>' class="btn btn-danger btn-sm" role="button">delete movie</a></td>
                </tr>




                <div class="modal fade" id="edit_movie_modal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="hidden" name="e_id" value="<?php echo $row['id']; ?>">
                                <input class="form-control" name="edit_movie_name" id="edit_movie_name" value="<?php echo $row['movie_name']; ?>">
                                <small></small>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label>Directer Name</label>
                                <input class="form-control" name="edit_directer_name" id="edit_directer_name" value="<?php echo $row['directer']; ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label>category</label>
                                <input class="form-control" name="edit_category" id="edit_category" value="<?php echo $row['categroy']; ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label>language</label>
                                <input type="text" name="edit_language" id="edit_language" class="form-control" value="<?php echo $row['language']; ?>">
                              </div>
                            </div>

                            <!-- Time -->
                            <div class="col-12">
                              <div class="form-group">
                                <label>Time</label>
                                <?php
                                $seats = explode(",", $row['show']);
                                $sql = mysqli_query($conn, "SELECT * FROM theater_show");
                                if (mysqli_num_rows($sql) > 0) {
                                  while ($fatch = mysqli_fetch_array($sql)) {
                                    $checked = $fatch['show'];
                                ?>
                                    <font size="2"> <?php echo $fatch['show']; ?></font><input type="checkbox" name="show[]" id="show" value="<?php echo $fatch['show']; ?>" <?php
                                                                                                                                                                            if (in_array($checked, $seats)) {
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
                                <input type="text" name="edit_tailer" id="edit_tailer" class="form-control" value="<?php echo $row['you_tube_link']; ?>">
                              </div>
                            </div>
                            <!-- Action -->
                            <div class="col-12">
                              <div class="form-group">
                                <label>Action</label>
                                <select class="form-control" name="edit_action">
                                  <option value="<?php echo $row['action']; ?>"><?php echo $row['action']; ?></option>
                                  <option value="upcoming">upcoming</option>
                                  <option value="running">running</option>
                                </select>
                              </div>
                            </div>
                            <!-- Description -->
                            <div class="col-12">
                              <div class="form-group">
                                <label>Decription</label>
                                <textarea type="text" name="decription" id="decription" class="form-control" value="<?php echo $row['decription']; ?>">
                <?php echo $row['decription']; ?></textarea>
                              </div>
                            </div>
                            <!-- Set of Time  -->
                            <div class="col-12">
                              <div class="form-group">
                                <label>Set of Time</label>
                                <img src="image/<?php echo $row['image']; ?>" width="10%">
                                <input type="file" name="edit_img" id="edit_img" class="form-control">
                                <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>" id="old_image" class="form-control">
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

              }
            }
            ?>

          </tbody>
        </table>
      </div>

      </main>
    </div>
  </div>


  <!-- Edit movie Modal start -->



  <?php include_once("./templates/footer.php"); ?>
  <script>
    function validateform() {
      var name = document.myform.movie_name.value;
      var directer = document.myform.directer_name.value;


      if (name == "") {
        alert("Requre Movie Name");
        return false;
      } else if (directer == "") {
        alert("Requre Directer Name");
        return false;
      }
    }
  </script>