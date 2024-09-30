<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!--My Css -->
    <link rel="stylesheet" href="./css/mystyle.css">
</head>


<!-- new one -->

<?php
$E_user_name = "";
$E_password1 = "";
$E_password2 = "";
$E_eq = "";
$E_email = "";
$E_phone = "";
$E_country = "";




        if(isset($_POST['ok'])){
            require_once('config.php');
            $name = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['mobile'];
            $country = $_POST['city'];
            $password1 = $_POST['user_password1'];
            $password2 = $_POST['user_password2'];

            // password Strong
            $uppercase = preg_match('@[A-Z]@', $password1);
            $lowercase = preg_match('@[a-z]@', $password1);
            $number    = preg_match('@[0-9]@', $password1);
            ////////////////////
            if (empty($name)) {
                $E_user_name = "You must enter the name or Enter only ALPHABET characters";
                // echo "<script>alert( 'You must enter the name or Enter only ALPHABET characters' )</script>";
            }
            

            elseif (empty($password1) || !$uppercase || !$lowercase || !$number
              ) {
                    $E_password1 = "Password should be at least 4 characters in length and should include at least one upper case letter, one number";
                // echo "<script>alert( 'Password should be at least 4 characters in length 
                // and should include at least one upper case letter, one number, and one special character' )</script>";
            }
            
            elseif (empty($password2)) {
                $E_password2 = "You must enter to confirm the password";
                // echo "<script>alert( 'You must enter the confirming password' )</script>";
            } 
            
            elseif ($password2 !== $password1) {
                $E_eq = 'Your confirming password is not correct';
                // echo "<script>alert( 'Your confirming password is not correct' )</script>";
            }
            
            elseif (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL))
            // (!preg_match("\w+@(gmail|hotmail|yahoo).(com|net|org)$", $email))
            ) {
                $E_email = 'Your email is either empty or Enter only with EMAIL FORMAT';
               //  echo "<script>alert( 'Your email is either empty or Enter only with EMAIL FORMAT' )</script>";
            }
            
            elseif (empty($phone) || (!(ctype_digit($phone))) || strlen($phone) != 9) {
              $E_phone = 'Your phone is either empty or Enter only NUMERIC data';
              // echo "<script>alert( 'Your phone is either empty or Enter only NUMERIC data' )</script>";
          }
          
          elseif (strlen($country) == 1) {
            $E_country = "You must choease the City";
            // echo "<script>alert( 'You must choease the country' )</script>";
        } 


            else if(isset($_FILES['user_uplode']) && empty($_FILES['user_uplode']['tmp_name'])) {
                $password2 = md5($_POST['user_password2']);
                $sql = "insert into user(username,email,mobile,city,password)
                values('$name','$email','$phone','$country','$password2')";
                $result = mysqli_query($conn,$sql);
                if(!$result){
                    echo "Insert Error" . mysqli_error($conn);
                }
                 echo "<script>alert( 'You have registered successfully' )</script>";

                mysqli_close($conn);
            }


            else {
                $folder ="./Uplode/";
                $img = $_FILES['user_uplode']['name'];
                $tmp = $_FILES['user_uplode']['tmp_name'];
                $password2 = md5($_POST['user_password2']);
                $sql = "insert into user(username,email,mobile,city,password,image)
                values('$name','$email','$phone','$country','$password2','$img')";
                $result = mysqli_query($conn,$sql);
                if(!$result){
                    echo "Insert Error" . mysqli_error($conn);
                }
                move_uploaded_file($tmp,$folder.$img);
                echo "<script>alert( 'You have successfully register' )</script>";

                mysqli_close($conn);
            }
        }
        ?>

        
<!-- main  -->
<div style="margin-top:20px;margin-bottom:20px;" class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h3>Registeration</h3>
        <form name="Register" id="reg" action="register_form.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td><label class="form-label">Name:</label></td>
                    <td><input class="form-control" id="name" type="text" name="username" placeholder="Full Name"></td>
                    <td>
                        <pre> * </pre>
                    </td>
                    <td style="color: red;">
                        <?php echo $E_user_name;?>
                    </td>
                </tr>

                <tr>
                    <td><label>Password:</label></td>
                    <td><input class="form-control" id="pass" type="password" name="user_password1" placeholder="Must be at least 4 characters in uppercase, lowercase, number, symbol"></td>
                    <td>
                        <pre> * </pre>
                    </td>
                    <td style="color: red;">
                        <?php echo $E_password1;?>
                    </td>
                </tr>

                <tr>
                    <td><label>Confirm Password:</label></td>
                    <td><input class="form-control" id="pass1" type="password" name="user_password2"></td>
                    <td>
                        <pre> *</pre>
                    </td>
                    <td style="color: red;">
                        <?php echo $E_password2; echo $E_eq;?>
                    </td>
                </tr>

                <tr>
                    <td><label>Email:</label></td>
                    <td><input class="form-control" id="email" type="email" name="email"></td>
                    <td>
                        <pre> *</pre>
                    </td>
                    <td style="color: red;">
                        <?php echo $E_email;?>
                    </td>
                </tr>

                <tr>
                    <td><label>Phone Number:</label></td>
                    <td><input class="form-control" id="tel" type="tel" name="mobile" placeholder="Must consist of 9 numbers"></td>
                    <td>
                        <pre> *</pre>
                    </td>
                    <td style="color: red;">
                        <?php echo $E_phone;?>
                    </td>
                </tr>
                <tr>
                    <td><label>City:</label></td>
                    <td><select name="city" id="country">
                            <option value="w">Choose your city</option>
                            <option value="Sana'a">Sana'a</option>
                            <option value="Ibb">Ibb</option>
                            <option value="Aden">Aden</option>
                            <option value="Taiz">Taiz</option>
                        </select></td>
                    <td>
                        <pre> *</pre>
                    </td>
                    <td style="color: red;">
                        <?php echo $E_country;?>
                    </td>
                </tr>
                <tr>
                    <td>Uplode Image:</td>
                    <td><label id="format"><input class="form-control" type="file" id="user_img" name="user_uplode" onchange="checkImg();">
                            The allowed formats here are (jpg,png,svg,jpeg)</label></td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input class="btn btn-primary" type="submit" value="Register" name="ok">
                    </td>
                </tr>
            </table>
        </form>
        
    </div>
    <div class="col-md-2"></div>
</div>

