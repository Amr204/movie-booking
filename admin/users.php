<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Manageuser Page</title>


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
          <h2>Users</h2>
        </div>
        <div class="col-4">
          <!-- Search -->
          <?php
          require_once('search.php');
          ?>
        </div>
      </div>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>id</th>
              <th>Name</th>
              <th>email</th>
              <th>mobile</th>
              <th>city</th>
              <th>password</th>
              <th>image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="product_list">
            <?php
            include_once 'Database.php';
            $result = mysqli_query($conn, "SELECT * FROM user");

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_array($result)) {
                $id = $row['id']; ?>
                <tr>
                  <td>
                    <?php echo $row['id']; ?>
                  </td>
                  <td>
                    <?php echo $row['username']; ?>
                  </td>
                  <td>
                    <?php echo $row['email']; ?>
                  </td>
                  <td>
                    <?php echo $row['mobile']; ?>
                  </td>
                  <td>
                    <?php echo $row['city']; ?>
                  </td>
                  <td>
                    <?php echo $row['password']; ?>
                  </td>
                  <td><img src="image/<?php echo $row['image']; ?>" alt="" class="resize"></td>

                  <td> <a href='./edit_user.php?user=<?php echo $row['id']; ?>' class="btn btn-primary btn-sm"
                      role="button">Edit user</a></td>
                  <td> <a href='./delete_user.php?user=<?php echo $row['id']; ?>' class="btn btn-danger btn-sm"
                      role="button">Delete user</a></td>

                </tr>



                <div class="modal fade" id="edit_users_modal<?php echo $row['id']; ?>" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="hidden" name="e_id" value="<?php echo $row['id']; ?>">
                                <input class="form-control" name="edit_username" id="edit_username"
                                  value="<?php echo $row['username']; ?>">
                                <small></small>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="edit_email" id="edit_email"
                                  value="<?php echo $row['email']; ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label>mobile</label>
                                <input type="number" class="form-control" name="edit_mobile" id="edit_mobile"
                                  value="<?php echo $row['mobile']; ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label>city</label>
                                <input class="form-control" name="edit_city" id="edit_city"
                                  value="<?php echo $row['city']; ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label>passord</label>
                                <input class="form-control" name="edit_password" id="edit_password"
                                  value="<?php echo $row['password']; ?>">
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="form-group">
                                <label>Image</label>
                                <img src="image/<?php echo $row['image']; ?>" width="10%">
                                <input type="file" name="edit_img" id="edit_img" class="form-control">
                                <input type="hidden" name="old_image" value="<?php echo $row['image']; ?>" id="old_image"
                                  class="form-control">
                              </div>
                            </div>
                            <div class="col-12">

                              <input type="submit" name="updateusers" id="updateusers" value="update"
                                class="btn btn-primary">
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