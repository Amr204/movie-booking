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
                <div class="col-3">
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
                        $value = $_GET['find'];
                        include_once 'config.php';
                        $result = mysqli_query($conn, "select * from user where username like '%$value%'  order by id desc");
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
                                    <td> <a href='./delete_user.php?user=<?php echo $row['id']; ?>'
                                            class="btn btn-danger btn-sm" role="button">Delete user</a></td>

                                </tr>
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