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

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Edit feedback</h2>
    <hr>
    <?php
        if(isset($_GET['feed'])){
        $id = $_GET['feed'];
        require_once('../config.php');
        $sql = "SELECT * FROM feedback WHERE id = ?";
        $exe = mysqli_execute_query($conn, $sql, [$id]);
        if (!$exe) {
        die("Selected Erorr" . mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($exe);
    if(isset($_POST['edit_feedback']))
    {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $massage = $_POST['massage'];
                $sql = "UPDATE `feedback` SET `name` = '?', `email` = '?', 
                `massage` = '?' WHERE `feedback`.`id` = ?";
                $exe = mysqli_execute_query($conn,$sql, [$name, $email, $massage, $id]);
                if(!$exe){
                    echo "Update Error" . mysqli_error($conn);
                }
                else {
                    header('location:feedback.php');
                }
            
    }}
    mysqli_close($conn);
    ?>
    <form name="News" id="add_ne" action="" method="POST" enctype="multipart/form-data">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td><label class="form-label">Name:</label></td>
                    <td><input class="form-control" id="name" type="text" 
                    name="name" value="<?php echo $row['name']; ?>"></td>
                </tr>
                <tr>
                    <td><label>email</label></td>
                    <td><input class="form-control" id="email" type="email"
                    name="email" value="<?php echo $row['email']; ?>"></td>
                </tr>
                <tr>
                <td><label>massage</label></td>
                    <td><input class="form-control" id="massage" type="text"
                    name="massage" value="<?php echo $row['massage']; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                    <input class="btn btn-success" type="submit" value="Update" name="edit_feedback">
                    <a href="./feedback.php" class="btn btn-danger">Cancel</a>
                    </td>
                </tr>
            </table>
        </div>
    </form>

